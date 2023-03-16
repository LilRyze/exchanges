<?php

namespace App\Services;

use App\Repositories\ExchangeRepository;
use App\Repositories\WalletRepository;
use App\Repositories\FeeRepository;
use Exception;

class ExchangeService
{
    /**
     * @var $exchangeRepository
     */
    protected $exchangeRepository;

    /**
     * @var $walletRepository
     */
    protected $walletRepository;

    /**
     * @var $feeRepository
     */
    protected $feeRepository;

    /**
     * Repository constructor
     * 
     * @param ExchangeRepository $exchangeRepository
     * @param WalletRepository $walletRepository
     * @param FeeRepository $feeRepository
     */
    public function __construct(
        ExchangeRepository $exchangeRepository,
        WalletRepository $walletRepository,
        FeeRepository $feeRepository
    ) {
        $this->exchangeRepository = $exchangeRepository;
        $this->walletRepository = $walletRepository;
        $this->feeRepository = $feeRepository;
    }

    public function createExchange(array $data)
    {
        $enoughMoney = $this->walletRepository->enoughMoney($data['seller_id'], $data['currency_sell_id'], $data['sell_sum']);

        if ($enoughMoney) {
            try {
                $data['fee'] = $data['buy_sum'] * 0.02;
                $data['price_with_fee'] = $data['fee'] + $data['buy_sum'];
    
                return $this->exchangeRepository->createExchange($data);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        return response()->json('Not enough money in your wallet', 200);
    }

    public function getExchanges(int $userId)
    {
        try {
            $exchanges = $this->exchangeRepository->getExchanges($userId);

            if (sizeof($exchanges) > 0) {
                for ($i = 0; $i < sizeof($exchanges); $i++) {
                    $data[] = [
                        'sell_sum' => $exchanges[$i]->sell_sum,
                        'price_with_fee' => $exchanges[$i]->price_with_fee,
                        'buyer_currency' => $exchanges[$i]->buyerCurrency->short_name,
                        'seller_currency' => $exchanges[$i]->sellerCurrency->short_name,
                        'seller_fname' => $exchanges[$i]->user->first_name,
                        'seller_lname' => $exchanges[$i]->user->last_name
                    ];
                }

                return $data;
            }

            return response()->json('Not found exchanges', 204);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function applyExchange(array $data)
    {
        try {
            $exchange = $this->exchangeRepository->find($data['id']);
            
            if ($exchange->status != 'completed') {
                $enoughMoney = $this->walletRepository->enoughMoney($data['buyer_id'], $exchange->currency_buy_id, $exchange->price_with_fee);
                if ($enoughMoney) {
    
                    $response = $this->walletRepository->exchange($data, $exchange->toArray());
                    if ($response->getData()->status == 200) {
                        $fees = $this->feeRepository->addFee($exchange->currency_buy_id, $exchange->fee, $exchange->id);
                        $status = $this->exchangeRepository->applyExchange($exchange);
        
                        return $status;
                    }
    
                    return response()->json([
                        'message' => 'Exchange failed',
                        'status' => 501
                    ]);
                }

                return response()->json([
                    'message' => 'Not enough money in your wallet',
                    'status' => 200
                ]);
            }

            return response()->json([
                'message' => 'Exchange already completed! Try with another one.',
                'status' => 200
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
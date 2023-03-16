<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;


class WalletRepository
{
    /**
     * @var Wallet
     */
    protected $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;    
    }

    public function enoughMoney(int $userId, int $currencyId, float $amount)
    {
        $walletAmount = $this->wallet->where('user_id', $userId)->where('currency_id', $currencyId)->first()->amount;

        return $amount <= $walletAmount;
    }

    public function exchange(array $data, array $exchange)
    {
        $this->wallet
            ->where('user_id', $exchange['seller_id'])
            ->where('currency_id', $exchange['currency_sell_id'])
            ->update([
                'amount' => DB::raw('amount - ' . $exchange['sell_sum'])
            ]);

        $this->wallet
        ->where('user_id', $exchange['seller_id'])
        ->where('currency_id', $exchange['currency_buy_id'])
        ->update([
            'amount' => DB::raw('amount + ' . $exchange['buy_sum'])
        ]);

        $this->wallet
            ->where('user_id', $data['buyer_id'])
            ->where('currency_id', $exchange['currency_buy_id'])
            ->update([
                'amount' => DB::raw('amount - ' . $exchange['price_with_fee'])
            ]);

        $this->wallet
        ->where('user_id', $data['buyer_id'])
        ->where('currency_id', $exchange['currency_sell_id'])
        ->update([
            'amount' => DB::raw('amount + ' . $exchange['sell_sum'])
        ]);

        return response()->json([
            'message' => 'Exchange completed',
            'status' => 200
        ]);
    }
}
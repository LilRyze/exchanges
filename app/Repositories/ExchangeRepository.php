<?php

namespace App\Repositories;

use App\Models\Exchange;
use Illuminate\Support\Facades\DB;


class ExchangeRepository
{
    /**
     * @var Exchange
     */
    protected $exchange;

    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;    
    }

    public function createExchange(array $data)
    {
        $exchange = new $this->exchange;

        $exchange->seller_id = $data['seller_id'];
        $exchange->currency_sell_id = $data['currency_sell_id'];
        $exchange->currency_buy_id = $data['currency_buy_id'];
        $exchange->sell_sum = $data['sell_sum'];
        $exchange->buy_sum = $data['buy_sum'];
        $exchange->fee = $data['fee'];
        $exchange->price_with_fee = $data['price_with_fee'];

        return $exchange->save();
    }

    public function getExchanges(int $userId)
    {
        return $this->exchange
            ->where('seller_id', '!=', $userId)
            ->where('status', 'opened')
            ->with('buyerCurrency')
            ->with('sellerCurrency')
            ->with('user')
            ->get();
    }

    public function find(int $id)
    {
        return $this->exchange->findOrFail($id);
    }

    public function applyExchange(Exchange $exchange)
    {
        $exchange->status = 'completed';

        return $exchange->save();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExchangeService;

class ExchangeController extends Controller
{
    /**
     * @var ExchangeService
     */
    protected $exchangeService;

    /**
     * ExchangeService constructor
     * 
     * @param ExchangeService $exchangeService
     */
    public function __construct(
        ExchangeService $exchangeService
    ) {
        $this->exchangeService = $exchangeService;
    }

    public function createExchange(Request $request)
    {
        $validated = $request->validate([
            'seller_id' => 'required|integer',
            'currency_sell_id' => 'required|integer',
            'currency_buy_id' => 'required|integer',
            'sell_sum' => 'required|decimal:1,4',
            'buy_sum' => 'required|decimal:1,4'

        ]);

        return $this->exchangeService->createExchange($validated);
    }

    public function getExchanges(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer'
        ]);

        return $this->exchangeService->getExchanges($validated['user_id']);
    }

    public function applyExchange(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'buyer_id' => 'required|integer'
        ]);

        return $this->exchangeService->applyExchange($validated);
    }
}

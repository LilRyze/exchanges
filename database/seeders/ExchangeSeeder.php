<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exchange;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exchange::create([
            'seller_id' => '1',
            'currency_sell_id' => '1',
            'currency_buy_id' => '2',
            'sell_sum' => 100.0,
            'buy_sum' => 2.0,
            'fee' => 2.0 * 0.02,
            'price_with_fee' => 2.0 + 2.0 * 0.02
        ]);

        Exchange::create([
            'seller_id' => '1',
            'currency_sell_id' => '2',
            'currency_buy_id' => '3',
            'sell_sum' => 50.0,
            'buy_sum' => 45,
            'fee' => 45 * 0.02,
            'price_with_fee' => 45 + 45 * 0.02
        ]);

        Exchange::create([
            'seller_id' => '2',
            'currency_sell_id' => '3',
            'currency_buy_id' => '1',
            'sell_sum' => 30.0,
            'buy_sum' => 1200.0,
            'fee' => 1200 * 0.02,
            'price_with_fee' => 1200 + 1200 * 0.02
        ]);
    }
}

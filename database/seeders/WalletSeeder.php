<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::create([
            'user_id' => '1',
            'currency_id' => '1',
            'amount' => 4000,
        ]);

        Wallet::create([
            'user_id' => '1',
            'currency_id' => '2',
            'amount' => 100,
        ]);

        Wallet::create([
            'user_id' => '1',
            'currency_id' => '3',
            'amount' => 70,
        ]);

        Wallet::create([
            'user_id' => '2',
            'currency_id' => '1',
            'amount' => 8700,
        ]);

        Wallet::create([
            'user_id' => '2',
            'currency_id' => '2',
            'amount' => 225,
        ]);

        Wallet::create([
            'user_id' => '2',
            'currency_id' => '3',
            'amount' => 190,
        ]);
    }
}

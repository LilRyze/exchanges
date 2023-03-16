<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\WalletSeeder;
use Database\Seeders\ExchangeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            WalletSeeder::class,
            CurrencySeeder::class,
            ExchangeSeeder::class
        ]);
    }
}

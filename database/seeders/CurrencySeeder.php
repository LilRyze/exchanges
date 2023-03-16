<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'short_name' => 'UAH',
        ]);

        Currency::create([
            'short_name' => 'EUR',
        ]);

        Currency::create([
            'short_name' => 'USD',
        ]);
    }
}

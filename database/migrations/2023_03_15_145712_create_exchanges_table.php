<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('buyer_id')->nullable();
            $table->integer('currency_sell_id');
            $table->integer('currency_buy_id');
            $table->float('sell_sum');
            $table->float('buy_sum');
            $table->string('status')->default('opened');
            $table->float('fee')->nullable();
            $table->float('price_with_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};

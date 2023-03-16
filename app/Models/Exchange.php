<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Currency;
use App\Models\User;

class Exchange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seller_id',
        'buyer_id',
        'currency_sell_id',
        'currency_buy_id',
        'sell_sum',
        'buy_sum',
        'fee',
        'price_with_fee'
    ];

    public function buyerCurrency(): HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_buy_id');
    }

    public function sellerCurrency(): HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_sell_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }
}

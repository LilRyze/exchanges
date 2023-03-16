<?php

namespace App\Repositories;

use App\Models\Fee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FeeRepository
{
    /**
     * @var Fee
     */
    protected $fee;

    public function __construct(Fee $fee)
    {
        $this->fee = $fee;    
    }

    public function addFee(int $currencyId, float $amount, int $exchangeId)
    {
        return $this->fee->create([
            'exchange_id' => $exchangeId,
            'currency_id' => $currencyId,
            'amount' => $amount,
        ]);
    }

    public function getFees(array $data)
    {
        return $this->fee
            ->where('created_at', '>=', $data['date_from'])
            ->where('created_at', '<=', $data['date_to'])
            ->with('currency')
            ->get();
    }
}
<?php

namespace App\Services;

use App\Repositories\FeeRepository;
use Exception;

class FeeService
{
    /**
     * @var $feeRepository
     */
    protected $feeRepository;

    /**
     * Repository constructor
     * 
     * @param FeeRepository $feeRepository
     */
    public function __construct(
        FeeRepository $feeRepository
    ) {
        $this->feeRepository = $feeRepository;
    }

    public function getFees(array $data)
    {
        try {
            $fees = $this->feeRepository->getFees($data);
            $feesByCurrency = $fees->groupBy('currency.short_name');
            $result = [];

            foreach ($feesByCurrency as $currency => $fees) {
                $sum = $fees->sum('amount');
                $result[] = [
                    'currency' => $currency,
                    'amount' => $sum
                ];
            }

            return response()->json([
                'data' => $result,
                'status' => 200
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
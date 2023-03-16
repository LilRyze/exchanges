<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FeeService;

class FeeController extends Controller
{
    /**
     * @var FeeService
     */
    protected $feeService;

    /**
     * FeeService constructor
     * 
     * @param FeeService $feeService
     */
    public function __construct(
        FeeService $feeService
    ) {
        $this->feeService = $feeService;
    }

    public function getFees(Request $request)
    {
        $validated = $request->validate([
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d'
        ]);

        return $this->feeService->getFees($validated);
    }
}

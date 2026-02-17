<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RevenueSheet;
use App\Services\RevenueCalculationService;

class CalculatorController extends Controller
{
    public function calculate(RevenueSheet $sheet, RevenueCalculationService $service)
    {
        $result = $service->calculateForSheet($sheet);

        return redirect()
            ->route('sheets.results', $sheet)
            ->with('success', 'Calculated. Lines: '.$result['calculated_count'])
            ->with('unmatched', $result['unmatched']);
    }

    public function results(RevenueSheet $sheet)
    {
        $sheet->load('operator');

        $lines = $sheet->calculations()
            ->with(['content', 'owner'])
            ->latest()
            ->get();
        
        return view('sheets.results', compact('sheet', 'lines'));
    }
}

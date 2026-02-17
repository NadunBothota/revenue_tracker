<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\RevenueSheet;

class DashboardController extends Controller
{
    public function index()
    {
        $recentSheets = RevenueSheet::with('operator')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('recentSheets'));
    }
}

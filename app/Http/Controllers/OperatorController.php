<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;

class OperatorController extends Controller
{
    public function index()
    {
        $operators = Operator::orderBy('name')->get();
        return view('operators.index', compact('operators'));
    }

    public function show(Operator $operator)
    {
        $sheets = $operator->revenueSheets()->latest()->get();
        return view('operators.show', compact('operator', 'sheets'));
    }
}

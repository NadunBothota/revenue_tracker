<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\RevenueSheet;
use App\Imports\RevenueRowsImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RevenueSheetController extends Controller
{
    public function create(Operator $operator)
    {
        return view('sheets.create', compact('operator'));
    }

    public function store(Request $request, Operator $operator)
    {
        $data = $request->validate([
            'period_month' => ['required', 'regex:/^\d{4}-\d{2}$/'],
            'file' => ['required', 'file', 'mimes:xlsx,csv'],
        ]);

        $path = $request->file('file')->store('revenue_sheets', 'public');

        $sheet = RevenueSheet::create([
            'operator_id' => $operator->id,
            'period_month' => $data['period_month'],
            'file_path' => $path,
            'status' => 'draft',
            'uploaded_by' => Auth::id(),
        ]);

        Excel::import(new RevenueRowsImport($sheet->id), Storage::disk('public')->path($path));

        return redirect()
            ->route('operators.show', $operator)
            ->with('success', 'Revenue sheet uploaded and imported successfully.');
    }
}

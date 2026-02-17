<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\Content;
use App\Models\Owner;
use Illuminate\Support\Facades\DB;

class AgreementController extends Controller
{
    public function create()
    {
        return view('agreements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'agreement_number' => ['required', 'string', 'max:255'],
            'subcategory' => ['nullable', 'string', 'max:255'],
            'payment_term' => ['required', 'in:Revenue Share,Advance Recovered'],
            'artist_revenue_percentage' => ['required', 'numeric', 'min:0', 'max:100'],

            'song_id' => ['required', 'string', 'max:255'],
            'content_title' => ['required', 'string', 'max:255'],
            'artist_name' => ['nullable', 'string', 'max;255'],

            'owners' => ['required', 'array', 'min:1'],
            'owners.*' => ['required', 'string', 'max:255'],
            'splits' => ['required', 'array', 'min:1'],
            'splits.*' => ['required', 'numeric', 'min:0', 'max:100'],

            'remarks' => ['nullable', 'string'],
        ]);

        $sum = array_sum($data['splits']);

        if (abs($sum - 100) > 0.01) {
            return back()->withInput()->withErrors([
                'splits' => 'Owner split percentages must total 100%. Current total: ' . $sum
            ]);
        }

        return DB::transaction(function() use ($data){

        $agreement = Agreement::updateOrCreate(
            ['agreement_number' => $data['agreemnt_number']],
            [
                'subcategory' => $data['subcategory'] ?? null,
                'payment_term' => $data['payment_term'],
                'artist_revenue_percentage' => $data['artist_revenue_percentage'],
                'remarks' => $data['remarks'] ?? null, 

            ]
        );

        $content = Content::updateOrCreate(
            ['song_id' => $data['song_id']],
            [
                'content_title' => $data['content_title'],
                'artist_name' => $data['artist_name'] ?? null,
                'agreement_id' => $agreement->id,
            ]
        );

        $sync = [];
        foreach ($data['owners'] as $i => $ownerName){
            $owner = Owner::firstOrCreate(['name' => trim($ownerName)]);
            $sync[$owner->id] = ['split_percentage' => (float)$data['splits'][$i]];
        }
        $content->owners()->sync($sync);
        return redirect()->route('agreements.create')->with('success', 'Agreement + content + splits saved!');

        });
        
    }
}

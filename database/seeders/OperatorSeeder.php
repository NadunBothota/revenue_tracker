<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operator;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['hutch','Dialog','Mobitel'] as $name){
            Operator::firstOrCreate(['name' => $name]);
        }
    }
}

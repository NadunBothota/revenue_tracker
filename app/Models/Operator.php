<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operator extends Model
{
    protected $fillable = ['name'];

    public function revenueSheets(): HasMany
    {
        return $this->hasMany(RevenueSheet::class);
    }
}

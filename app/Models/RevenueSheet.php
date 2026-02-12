<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RevenueSheet extends Model
{
    Protected $fillable = ['operator_id', 'period_month', 'file_path', 'status', 'uploaded_by'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function rows(): HasMany
    {
        return $this->hasMany(RevenueRow::class);
    }

    public function calculations(): HasMany
    {
        return $this->hasMany(RevenueCalculation::class);
    }
}

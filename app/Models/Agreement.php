<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agreement extends Model
{
    protected $fillable = [
        'agreement_number', 'subcategory', 'payment_term',
        'artist_revenue_percentage', 'remarks', 'effective_from', 'effective_to'
    ];

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}

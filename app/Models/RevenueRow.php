<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueRow extends Model
{
    protected $fillable = ['revenue_sheet_id', 'song_id', 'content_title', 'artist_name', 'net_revenue'];

    public function sheet(): BelongsTo
    {
        return $this->belongsTo(RevenueSheet::class, 'revenue_sheet_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\relations\BelongsToMany;

class Content extends Model
{
    protected $fillable = ['song_id', 'content_title', 'artist_name', 'agreement_id'];

    public function agreement():BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class, 'content_owners')
            ->withPivot('split_percentage')
            ->withTimestamps();
    }
}

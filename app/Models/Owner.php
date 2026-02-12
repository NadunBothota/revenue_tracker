<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Owner extends Model
{
    protected $fillable = ['name'];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'content_owners')
            ->withPivot('split_percentage')
            ->withTimestamps();
    }
}

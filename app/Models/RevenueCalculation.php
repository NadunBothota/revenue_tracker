<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueCalculation extends Model
{
    protected $fillable = ['revenue_sheet_id', 'content_id', 'owner_id', 'gross_net_revenue', 'agreement_percentage', 'owner_split_percentage', 'owner_amonut', 'company_amount'];

    public function sheet(): BelongsTo {return $this->belongsTo(RevenueSheet::class);}
    public function content(): BelongsTo {return $this->belongsTo(Content::class);}
    public function owner(): BelongsTo {return $this->belongsTo(Owner::class);}
}

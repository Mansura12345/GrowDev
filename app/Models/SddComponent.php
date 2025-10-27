<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SddComponent extends Model
{
    protected $fillable = [
        'sdd_document_id',
        'component_name',
        'description',
        'responsibility',
        'interfaces',
        'diagram_data',
        'diagram_type',
        'order',
    ];

    protected $casts = [
        'diagram_data' => 'array',
    ];

    public function sddDocument(): BelongsTo
    {
        return $this->belongsTo(SddDocument::class);
    }
}

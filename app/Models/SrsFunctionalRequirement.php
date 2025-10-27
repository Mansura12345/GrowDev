<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SrsFunctionalRequirement extends Model
{
    protected $fillable = [
        'srs_document_id',
        'requirement_id',
        'title',
        'description',
        'priority',
        'ux_considerations',
        'order',
    ];

    protected $casts = [
        'ux_considerations' => 'array',
    ];

    public function srsDocument(): BelongsTo
    {
        return $this->belongsTo(SrsDocument::class);
    }
}

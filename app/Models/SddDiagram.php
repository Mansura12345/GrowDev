<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SddDiagram extends Model
{
    protected $fillable = [
        'sdd_document_id',
        'diagram_name',
        'diagram_type',
        'diagram_content',
        'text_description',
    ];

    public function sddDocument(): BelongsTo
    {
        return $this->belongsTo(SddDocument::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SrsDocument extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'project_overview',
        'scope',
        'constraints',
        'assumptions',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function functionalRequirements(): HasMany
    {
        return $this->hasMany(SrsFunctionalRequirement::class)->orderBy('order');
    }
}

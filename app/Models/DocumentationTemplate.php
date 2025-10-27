<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentationTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'structure',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'structure' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the documentations that use this template.
     */
    public function documentations(): HasMany
    {
        return $this->hasMany(Documentation::class, 'template_id');
    }
}

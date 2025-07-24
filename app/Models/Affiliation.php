<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Affiliation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Affiliation::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Affiliation::class, 'parent_id');
    }
}

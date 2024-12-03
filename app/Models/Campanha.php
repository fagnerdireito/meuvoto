<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campanha extends Model
{
    /** @use HasFactory<\Database\Factories\CampanhaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function votos(): HasMany
    {
        return $this->hasMany(Voto::class);
    }

    public function enquetes(): HasMany
    {
        return $this->hasMany(Enquete::class);
    }
}

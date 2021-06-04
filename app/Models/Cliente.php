<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends User
{
    /*use HasFactory, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }*/

    public function encomendas() : HasMany
    {
        return $this->hasMany(Encomenda::class);
    }

    public function estampas() : HasMany
    {
        return $this->hasMany(Estampa::class);
    }
}

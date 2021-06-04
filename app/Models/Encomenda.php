<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encomenda extends Model
{
    use HasFactory;

    public function client(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirts(): HasMany
    {
        return $this->hasMany(TShirt::class);
    }
}

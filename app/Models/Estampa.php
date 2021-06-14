<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static select(string...$args)
 * @property int cliente_id
 * @property string img
 * @property string imagem_url
 */
class Estampa extends Model
{
    use HasFactory, SoftDeletes;

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirts(): HasMany
    {
        return $this->hasMany(TShirt::class);
    }
}

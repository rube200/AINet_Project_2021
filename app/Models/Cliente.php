<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail(int $id)
 * @property int id
 */
class Cliente extends Model
{
    protected $fillable = [
        'nif',
    ];

    public function encomendas(): HasMany
    {
        return $this->hasMany(Encomenda::class);
    }

    public function estampas(): HasMany
    {
        return $this->hasMany(Estampa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

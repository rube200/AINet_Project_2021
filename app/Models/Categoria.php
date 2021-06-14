<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static select(string...$args)
 * @method static pluck(string...$args)
 */
class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    public function estampas(): HasMany
    {
        return $this->hasMany(Estampa::class);
    }
}

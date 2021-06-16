<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static select(string...$args)
 * @method static pluck(string...$args)
 * @method static get()
 * @method static create(Categoria|Categoria[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|\Illuminate\Database\Query\Builder|\Illuminate\Database\Query\Builder[]|mixed|null $category)
 * @method static findOrFail(int $id)
 * @property string nome
 */
class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'nome'
    ];

    public function estampas(): HasMany
    {
        return $this->hasMany(Estampa::class);
    }
}

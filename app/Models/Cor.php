<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static get()
 * @method static create(array $colorData)
 * @property string nome
 */
class Cor extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'codigo',
        'nome'
    ];

    protected $table = 'cores';
    protected $primaryKey = 'codigo';
    protected $keyType = "string";

    public function tshirts(): HasMany
    {
        return $this->hasMany(TShirt::class);//'cor_codigo'
    }
}

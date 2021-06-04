<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cores';
    protected $primaryKey = 'codigo';

    public function tshirts(): HasMany
    {
        return $this->hasMany(TShirt::class);//'cor_codigo'
    }
}

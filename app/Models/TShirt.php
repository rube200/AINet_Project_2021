<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TShirt extends Model
{
    use HasFactory;

    public function estampa(): hasOne
    {
        return $this->hasOne(Estampa::class, 'estampa_id');
    }

    public function cor(): hasOne
    {
        return $this->hasOne(Cor::class, 'cor_codigo');
    }
}

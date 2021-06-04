<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TShirt extends Model
{
    use HasFactory;

    public function client(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cor(): BelongsTo
    {
        return $this->belongsTo(Cor::class);
    }

    public function estampa(): BelongsTo
    {
        return $this->belongsTo(Estampa::class);
    }
}

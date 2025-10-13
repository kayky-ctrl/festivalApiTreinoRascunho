<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organizadores extends Model
{

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'localizacao',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Festivais extends Model
{
    protected $fillable = [
        'name',
        'local',
        'data_horario',
        'capacidade',
        'artistas',
        'imagem_path',
    ];

    protected $casts = [
        'artistas' => 'array',
        'data_horario' => 'datetime',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'endereco',
        'endereco_alternativo',
        'perfil_id', 
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class, 'endereco_usuario', 'usuario_id', 'endereco_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoUsuario extends Model
{
    protected $table = 'endereco_usuario';

    protected $fillable = [
        'endereco_id',
        'usuario_id',
    ];
}
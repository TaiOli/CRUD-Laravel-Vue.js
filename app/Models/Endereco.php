<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'endereco',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'endereco_usuario', 'endereco_id', 'usuario_id');
    }
}
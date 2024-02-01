<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';
    protected $fillable = ['perfil'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'perfil_id');
    }
}
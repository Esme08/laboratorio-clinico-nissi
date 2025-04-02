<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $table = 'Administradores'; // Nombre exacto de la tabla en la BD
    protected $primaryKey = 'id_admin';
    protected $fillable = ['nombre', 'correo', 'contraseña'];
    protected $hidden = ['contraseña'];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}


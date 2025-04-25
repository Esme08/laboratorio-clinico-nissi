<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Administrador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administradores'; // Nombre de la tabla en la BD
    protected $primaryKey = 'id_admin';   // Clave primaria

    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'estado'
    ];

    public $timestamps = false; // Desactivar timestamps
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'Citas';
    protected $primaryKey = 'id_cita';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'fecha',
        'hora',
        'estado',
        'enviar_resultados',
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'Citas_Servicios', 'id_cita', 'id_servicio');
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'Citas_Servicios', 'id_cita', 'id_combo');
    }

    public function resultado()
    {
        return $this->hasOne(Resultado::class, 'id_cita');
    }
}

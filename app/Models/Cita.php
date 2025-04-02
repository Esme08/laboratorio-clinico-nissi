<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $incrementing = true; // Auto-incremental

    // Especificar el tipo de la clave primaria
    protected $keyType = 'int';
    protected $fillable = [
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'fecha',
        'hora',
        'estado'
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'citas_servicios', 'id_cita', 'id_servicio');
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'citas_servicios', 'id_cita', 'id_combo');
    }

    public function resultado()
    {
        return $this->hasOne(Resultado::class, 'id_cita');
    }
    // Activar marcas de tiempo
    public $timestamps = false; // Esto crea 'created_at' y 'updated_at'
}



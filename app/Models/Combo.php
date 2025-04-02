<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $table = 'combos';
    protected $primaryKey = 'id_combo';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'combos_servicios', 'id_combo', 'id_servicio');
    }

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'citas_servicios', 'id_combo', 'id_cita');
    }
}

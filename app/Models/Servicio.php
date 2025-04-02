<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $primaryKey = 'id_servicio';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'id_categoria'
    ];

    // Relación con categorías
    public function categoria()
    {
        return $this->belongsTo(CategoriaServicio::class, 'id_categoria');
    }

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'citas_servicios', 'id_servicio', 'id_cita');
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combos_servicios', 'id_servicio', 'id_combo');
    }
    public $timestamps = false;
}


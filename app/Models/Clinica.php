<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    use HasFactory;

    protected $table = 'clinica';
    protected $primaryKey = 'id_clinica';
    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion_google_maps',
        'contacto'
    ];

    public function imagenes()
    {
        return $this->hasMany(ImagenClinica::class, 'id_clinica');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinica extends Model
{
    use HasFactory;

    protected $table = 'clinica'; // Asegúrate de que el nombre de tu tabla sea 'clinicas'
    protected $primaryKey = 'id_clinica';
    public $timestamps = false; // Si no tienes campos de timestamps

    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion_google_maps',
        'contacto',
    ];

    /**
     * Relación con las imágenes de la clínica.
     */
    public function imagenes(): HasMany
    {
        return $this->hasMany(ImagenClinica::class, 'id_clinica', 'id_clinica');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImagenClinica extends Model
{
    use HasFactory;

    protected $table = 'imagenes_clinica'; // Asegúrate de que el nombre de tu tabla sea 'imagenes_clinica'
    protected $primaryKey = 'id_imagen';
    public $timestamps = false; // Si no tienes campos de timestamps

    protected $fillable = [
        'id_clinica',
        'url_imagen',
    ];

    /**
     * Relación con la clínica a la que pertenece la imagen.
     */
    public function clinica(): BelongsTo
    {
        return $this->belongsTo(Clinica::class, 'id_clinica', 'id_clinica');
    }
}

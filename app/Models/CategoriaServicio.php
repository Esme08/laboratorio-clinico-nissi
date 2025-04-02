<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    use HasFactory;

    protected $table = 'categorias_servicios';

    protected $fillable = [
        'nombre',
        'id_categoria_padre',
    ];

    // Relación con la misma tabla para manejar categorías padre e hijas
    public function subcategorias()
    {
        return $this->hasMany(CategoriaServicio::class, 'id_categoria_padre');
    }

    public function categoriaPadre()
    {
        return $this->belongsTo(CategoriaServicio::class, 'id_categoria_padre');
    }

    // Relación con servicios
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_categoria');
    }
}

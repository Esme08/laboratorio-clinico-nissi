<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{

    protected $table = 'categorias_servicios';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_categoria');
    }
}

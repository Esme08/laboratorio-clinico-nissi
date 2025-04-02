<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenClinica extends Model
{
    use HasFactory;

    protected $table = 'imagenes_clinica';
    protected $primaryKey = 'id_imagen';
    protected $fillable = [
        'id_clinica',
        'url_imagen'
    ];

    public function clinica()
    {
        return $this->belongsTo(Clinica::class, 'id_clinica');
    }
}

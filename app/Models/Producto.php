<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Empresa;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'id_producto',
        'producto',
        'cantidad',
        'precio_c',
        'precio_v',
        'imagePath',
        'puntaje',
        'num_votos',
        'descripcion'
       

    ];

    public function id_empresa()
    {
        return $this->hasOne(Empresa::class, 'id_empresa', 'id_empresa');
    }

    
}

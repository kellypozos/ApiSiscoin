<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Producto;
use App\Models\Compras;

class Venta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_venta',
        'id_compras',


    ];

    public function id_compras()
    {
        return $this->hasOne(Compras::class, 'id_compras', 'id_compras');
    }
   
}

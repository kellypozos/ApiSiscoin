<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserMovil;
use App\Models\Producto;
class Compras extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'compras';
    protected $primaryKey = 'id_compras';
    protected $fillable = [

        'id_compras',
        'id_producto',
        'fecha',
        'metodopago',
        'pagototal',
        'num_visitas'

    ];
    public function id_producto()
    {
        return $this->hasOne(Producto::class, 'id_producto', 'id_producto');
    }
    public function id_clientesmovil()
    {
        return $this->hasOne(UserMovil::class, 'id_clientesmovil', 'id_clientesmovil');
    }
}

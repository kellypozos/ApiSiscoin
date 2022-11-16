<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistas extends Model
{
    use HasFactory;
    protected $table = 'vistas';
    protected $primaryKey = 'id_vista';
    public $timestamps = false;
    protected $fillable = [
        'id_vista',
        'id_producto',
        'fecha',
        'num_visitas'
    ];
}

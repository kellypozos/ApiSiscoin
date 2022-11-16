<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMovil extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table='clientesmovil';
    protected $primaryKey = 'id_clientesmovil';
    protected $fillable = [
        'id_clientesmovil',
        'usuario',
        'correo',
        'contrasena',
        'telefono',
        'id_direccion'
    ];

    protected $hidden = [
        'contrasena',
    ];

   
}
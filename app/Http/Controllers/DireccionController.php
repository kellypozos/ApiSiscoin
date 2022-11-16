<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Http\Requests\GuardarDireccion; 

class DireccionController extends Controller
{
    //LISTAR TODOS LOS REGISTROS 
    public function list()
    {
        $direcciones = Direccion::all();
        return $direcciones->toArray();
    }


    //LISTAR UN REGISTRO EN ESPECIDFICO
    public function show(Direccion $direccion)
    {
        return response()->json([
            'res' => true,
            'Direccion' => $direccion
        ], 200);
    }

    //CREAR UN NUEVO REGISTRO
    public function store(GuardarDireccion $request)
    {
        Direccion::create($request->all());
        return response()->json([
            'res' => true,
            'msg' => 'Direccion creado correctamente'
        ], 200);
    }

    //ACTUALIZAR UN REGISTRO 
    public function update(GuardarDireccion $request, Direccion $direccion)
    {
        $direccion->update($request->all());
        return response()->json([
            'res' => 'true',
            'mensaje' => 'Direccion actualizada correctamente'
        ], 200);
    }

    public function destroy(Direccion $direccion)
    {
        $direccion->delete();
        return response()->json([
            'res' => 'true',
            'mensaje' => 'Direccion eliminada correctamente'
        ], 200);
    }
}

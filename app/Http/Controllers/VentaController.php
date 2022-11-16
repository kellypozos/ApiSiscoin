<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Requests\GuardarVenta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    //LISTAR TODOS LOS REGISTROS 
    public function list()
    {
        $productos = Venta::with('id_compras')->get();
        return $productos->toArray();
    }

    //LISTAR UN REGISTRO ESPECÍFICO 
    public function show(Venta $venta)
    {
        return response()->json($venta);
    }

    //CREAR UN NUEVO REGISTRO
    public function store(GuardarVenta $request)
    {
        Venta::create($request->all());
        return response()->json([
            'res' => true,
            'msg' => 'Venta registrada correctamente'
        ], 200);
    }

    //ACTUALIZAR UN REGISTRO 
    public function update(GuardarVenta $request, Venta $venta)
    {
        $venta->update($request->all());
        return response()->json([
            'res' => true,
            'mensaje' => 'Venta actualizada correctamente'
        ], 200);
    }

    //ELIMINAR UN REGISTRO DE MANERA LÓGICA 
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return response()->json([
            'res' => true,
            'mensaje' => 'Venta eliminada correctamente'
        ], 200);
    }
}

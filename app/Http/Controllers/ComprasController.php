<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Producto;
use App\Http\Requests\GuardarCompras;

class ComprasController extends Controller
{
    //LISTAR TODOS LOS REGISTROS 
    //agregar un nuevo campo a compras y ahi meter el valor de
    public function list()
    {
        $compras = Compras::all();
        $productos = Producto::all();
        for ($i = 0; $i < count($compras); $i++) {

            for ($c = 0; $c < count($productos); $c++) {
                if ($productos[$c]['id_producto'] == $compras[$i]['id_producto']) {
                    $compras[$i]['producto'] = $productos[$c]['producto'];
                    $compras[$i]['descripcion'] = $productos[$c]['descripcion'];
                    $compras[$i]['imagePath'] = $productos[$c]['imagePath'];
                }
            }
        }

        return $compras->toArray();
    }


    //LISTAR UN REGISTRO EN ESPECIDFICO
    public function show(Compras $compra)
    {
        return response()->json([
            'res' => true,
            'Compra' => $compra
        ], 200);
    }

    //CREAR UN NUEVO REGISTRO
    public function store(Request $request)
    {
        $vista = Compras::where (
            array (
                'fecha' => $request->get('fecha'),

                'id_producto' => $request->get('id_producto')
            ))->first();
            if ($vista) {

                $vista->num_visitas = $vista->num_visitas + 1;
                $vista->update();
                return array(
                    'status' => 'Success',
                'message' => 'Actualización realizada con éxito'
                );
            }

        Compras::create($request->all());
        return response()->json([
            'res' => true,
            'msg' => 'Compra creada correctamente'
        ], 200);

      
    }

    //ACTUALIZAR UN REGISTRO 
    public function update(GuardarCompras $request, Compras $compra)
    {
        $vista = new Compras();
        $vista['id_producto'] = $request->get('id_producto');
        $vista['num_visitas'] = 1;
        $vista['fecha'] = $request->get('fecha');
        $vista->save();
        return array(
            'status' => 'Success',
            'message' => 'Creación realizada con éxito'
        );
        $compra->update($request->all());
        return response()->json([
            'res' => 'true',
            'mensaje' => 'compras actualizada correctamente'
        ], 200);
    }

    public function destroy(Compras $compra)
    {
        $compra->delete();
        return response()->json([
            'res' => 'true',
            'mensaje' => 'compra eliminada correctamente'
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\GuardarProductoRequest;
use Illuminate\Http\Request;


class ProductosController extends Controller
{
    //LISTAR TODOS LOS REGISTROS 
    public function list()
    {
        $productos = Producto::all();
        return $productos->toArray();
    }

    //LISTAR UN REGISTRO ESPECÍFICO 
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    //CREAR UN NUEVO REGISTRO
    public function store(GuardarProductoRequest $request)
    
    {
        if (strncasecmp ($request['imagePath'] , 'https://res.cloudinary.com/siscoin/image/upload/', 48)){
            return response()->json([
                'res' => false,
                'msg' => 'Enlace no valido'
            ], 500);
        }else{
            if ($request['precio_v'] > $request['precio_c']){
                if($request['cantidad'] < 1){
                    return response()->json([
                        'res' => false,
                        'msg' => 'cantidad no valida'
                    ], 500);
                }else{
                    Producto::create($request->all());
                    return response()->json([
                        'res' => true,
                        'msg' => 'Producto registrado correctamente'
                    ], 200);
                }
            }else{
                return response()->json([
                    'res' => false,
                    'msg' => 'Precio no valido'
                ], 500);
            }
        }
        
    }

    //ACTUALIZAR UN REGISTRO 
    public function update(GuardarProductoRequest $request, Producto $producto)
    {
        $producto->update($request->all());
        return response()->json([
            'res' => true,
            'mensaje' => 'Producto actualizado correctamente'
        ], 200);
    }

        //INSERTAR NUM_VISITAS
        public function insertarNumVisitas($id)
        {
            $producto = Producto::where('id_producto', "=", $id)->first();
            $producto['num_visitas'] = $id_producto->num_visitas + 1;;
            $producto->update();
            return $user;
        }

        public function insertarCalificacion(Request $request, $id)
        {
            $producto = Producto::where('id_producto', "=", $id)->first();
            $producto['puntaje'] = $producto->puntaje + $request->puntaje;
            $producto['num_votos'] = $producto->num_votos + 1;
            $producto->update();
            return $producto;
        }
    
    
  

    //ELIMINAR UN REGISTRO DE MANERA LÓGICA 
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json([
            'res' => true,
            'mensaje' => 'Producto eliminado correctamente'
        ], 200);
    }
}
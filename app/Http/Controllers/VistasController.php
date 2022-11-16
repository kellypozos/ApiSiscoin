<?php

namespace App\Http\Controllers;

use App\Models\Vistas;
use Illuminate\Http\Request;

class VistasController extends Controller
{
    public function store(Request $request)
    {
        $vista = Vistas::where(
            array(
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

        $vista = new Vistas();
        $vista['id_producto'] = $request->get('id_producto');
        $vista['fecha'] = $request->get('fecha');
        $vista['num_visitas'] = 1;
        $vista->save();
        return array(
            'status' => 'Success',
            'message' => 'Creación realizada con éxito'
        );
    }

    public function list(Request $request)
    {
        $vistas = Vistas::where(
            array(
                'id_producto' => $request->get('id_producto'),
                'fecha' => $request->get('fecha')

            ))->first();

        return response()->json($vistas);
    }
}

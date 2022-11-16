<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMovil;
use Illuminate\Support\Facades\Validator;
use App\Models\Vistas;

class ClienteController extends Controller
{
    
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'usuario' => 'required|alpha',
            'correo' => 'required|email|unique:clientesmovil',
            'contrasena' => 'required',
            //'empresa' => 'required|unique:clientesmovil'
        ]);

        if($validate->fails()) {
            $data = array (
                'code' => 404, //cambiar
                'status' => 'ERROR',
                'message' => 'El usuario no se ha creado',
                'errors' => $validate->errors()
            );
            return response()->json($data, $data['code']);
        }

        $user = new UserMovil();
        $user->usuario = $request->get('usuario');
        $user->correo = $request->get('correo');
        $user->contrasena = hash('sha256',$request->get('contrasena'));
        $user->telefono = $request->get('telefono');
        $user->save();
        $data = array(
            'code' => 200,  //cambiar
            'status' => 'SUCCESS',
            'message' => 'El usuario se ha creado correctamente',
            'user' => $user
        );

        return response()->json($data, $data['code']);
    }
    public function list()
    {
        $user = UserMovil::get();
        return  $user->toArray();
    }

    public function find($id)
    {
        return UserMovil::where('id_clientesmovil', '=', $id)->first();
    }


    /*   //INSERTAR NUM_VISITAS
      public function insertarNumVisitas($id)
      {
          $user = UserMovil::where('id_clientesmovil', "=", $id)->first();
          $user['num_visitas'] = $id_clientesmovil->num_visitas + 1;;
          $user->update();
          return $user;
      }
   */

    public function login(Request $request)
    {
        $jwtAuth = new \JwtAuth();

        $validate = Validator::make($request->all(), [
            'correo'     => 'required|email',
            'contrasena'  => 'required'
        ]);

        if($validate->fails()) {
            $signup = array (
                'code'      => 404,
                'status'    => 'ERROR',
                'message'   => 'El usuario no se ha podido loguear',
                'errors'    => $validate->errors()
            );

            return response()->json($signup, $signup['code']);
        }

        $signup = $jwtAuth->signupcliente($request->get('correo'), hash('sha256', $request->get('contrasena')));

        return $signup;
    }
}
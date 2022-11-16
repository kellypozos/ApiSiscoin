<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\GuardarUsuario;

class UserController extends Controller
{
    public function register(Request $request)
    {
        
        // //RECOGER LOS DATOS DEL USUARIO POR POST
        // $json = $request->input('json', null);
        // $params = json_decode($json); //SACA UNOBJETO
        // $params_array = json_decode($json, true); //SACA UN ARRAY
        $datos = $request->all();
      
       
        // //LIMPIAR LOS DATOS
         //$params_array = array_map('trim', $params_array);

        //VALIDAR LOS DATOS
        
        $validate = \Validator::make($datos, [
            'usuario'  => 'required',
            'correo'     => 'required|email',
            'contrasena'  => 'required'
        ]);
        \Log::info($datos);
        if($validate->fails()) {
            //LA VALIDACION HA FALLADO
            $data = array (
                'code'      => 404,
                'status'    => 'ERROR',
                'message'   => 'El usuario no se ha creado',
                'errors'    => $validate->errors()
            );
        }else{
            //VALIDACION PASADA CORRECTAMENTE

            //CIFRAR CONTRASEÑA
            $pwd = hash('sha256', $datos['contrasena']);

            //CREAR AL USUARIO
            $user = new User();
            $user->usuario = $datos['usuario'];
            $user->correo = $datos['correo'];
            $user->contrasena = $pwd;
            //GUARDAR EL USUARIO
            $user->save();

            $data = array (
                'code'      => 200,
                'status'    => true,
                'message'   => 'El usuario se ha creado correctamente',
                'user'      => $user
            );
            \Log::info($user);
            return response()->json($data, $data['code']);
        }
    

        return response()->json($data, $data['code']);
    }

    public function login(Request $request)
    {

        \Log::info($request->all());
        
        $jwtAuth = new \JwtAuth();

        //RECIBIR DATOS POR POST
        //$json = $request->input('json', null);
        //$params = json_decode($json);
        //$params_array = json_decode($json, true);

        $datos = $request->all();
        //\Log::info($datos['contrasena']);
        //VALIDAR DATOS
        $validate = \Validator::make($datos, [
            'correo'     => 'required|email',
            'contrasena'  => 'required'
        ]);

        if($validate->fails()) {
            //LA VALIDACION HA FALLADO
            $signup = array (
                'code'      => 404,
                'status'    => 'ERROR',
                'message'   => 'El usuario no se ha podido loguear',
                'errors'    => $validate->errors()
            );
        }else{
            //CIFRAR CONTRASEÑA
            $pwd = hash('sha256', $datos['contrasena']);

            //DEVOLVER TOKEN O DATOS
            $signup = $jwtAuth->signup($datos['correo'], $pwd);

            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($datos['correo'], $pwd, true);
            }
        }
        \Log::info($signup);

        return response()->json($signup, 200);

    }

    public function update(GuardarUsuario $request, User $user)
    {
        $user->update($request->all());
        return response()->json([
            'res' => true,
            'mensaje' => 'Usuario actualizado correctamente'
        ], 200);
    }

    // public function upload(Request $request)
    // {

    //     //RECOGER LA PETICIÓN
    //     $image = $request->file('file0');

    //     //VALIDACION DE LA IMAGEN
    //     $validate = \Validator::make($request->all(), [
    //         'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
    //     ]);

    //     //GUARDAR LA IMAGEN
    //     if(!$image || $validate->fails()){
    //         $data = array(
    //             'code' => 400,
    //             'status' => 'ERROR',
    //             'message' =>  'Error de al subir imagen'
    //         );
    //     }else{
    //         $image_name = time().$image->getClientOriginalName();
    //         \Storage::disk('users')->put($image_name, \File::get($image));

    //         $data = array(
    //             'code' => 200,
    //             'status' => 'SUCCESS',
    //             'image' => $image_name
    //         );
    //     }
    //     return response()->json($data, $data['code']);
    // }

    // public function getImage($filename)
    // {
    //     $isset = \Storage::disk('users')->exists($filename);

    //     if($isset){
    //         $file = \Storage::disk('users')->get($filename);
    //         return new Response($file, 200);
    //     }else{
    //         $data = array(
    //             'code' => 404,
    //             'status' => 'ERROR',
    //             'message' =>  'La imagen no existe'
    //         );
    //         return response()->json($data, $data['code']);
    //     }
    // }

    public function detail($id)
    {
       
        $user = User::find($id);

        return $user->toArray();
    }
}

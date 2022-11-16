<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserMovil;
use Illuminate\Support\Facades\Validator;

class JwtAuth
{
    public $key;

    public function __construct()
    {
        $this->key = 'esto_es_una_clave_super_secreta-998877';
    }

    public function signup($correo, $contrasena, $gettoken = null)
    {
        //BUSCAR SI EXISTE EL USUARIO CON SUS CREDENCIALES
        $user = User::where([
            'correo' => $correo,
            'contrasena' => $contrasena
        ])->first();

        //COMPROBAR SI SON CORRECTAS
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }

        //GENERAR EL TOKEN CON LOS DATOS DEL USUARIO
        if($signup){
            $token = array(
                'sub'       => $user->id,
                'email'     => $user->email,
                'name'      => $user->name,
                'surname'   => $user->surname,
                'image'   => $user->image,
                'username'  => $user->username,
                'iat'       => time(),
                'exp'       => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
            //DEVOLVER LOS DATOS DECODIFICADOS O EL TOKEN EN FUNCIÓN DE UN PARÁMETRO
            if(is_null($gettoken)){
               // $data = $jwt;
               $data = array(
                'status' => true,
                'message' => 'Login correcto',
                'token' => $jwt,
                'usuario' => $user->usuario,
                'correo' => $user->correo,
                'id' => $user->id_usuario

            );
                
            }else{
                $data = $decoded;
            }

        }else{
            $data = array(
                'status' => 'Error',
                'message' => 'Login incorrecto'
            );
        }
        return $data;
    }

    

    public function signupcliente($email, $password)
    {
        $data = UserMovil::where(
            array(
                'correo' => $email,
                'contrasena' => $password
            ))->first();
            
        $signup = false;
        if (is_object($data)) {
            $signup = true;
        }

        if ($signup) {
            $user = array(
                'id_clientesmovil' => $data->id_clientesmovil,
                'correo' => $data->correo,
                'usuario' => $data->usuario,
                'telefono' => $data->telefono,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            $token = JWT::encode($user, $this->key, 'HS256');  //creacion del token

            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Los datos son correctos',
                'user' => $user,
                'token' => $token
            );

            return response()->json($data, $data['code']);
        }
        
        $data = array(
            'status' => 'error',
            'code' => 400,
            'message' => 'Datos proporcionados incorrectos'
        );

        return response()->json($data, $data['code']);
    }

    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;

        try{
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decoded;
        }

        return $auth;
    }

}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\VistasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas registrar y login movil
Route::post('/register-movil', [ClienteController::class, 'register']);
Route::post('/login-movil', [ClienteController::class, 'login']);
Route::get('/clientes', [ClienteController::class, 'list']);


Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::post('/user/upload',[UserController::class, 'upload'])->middleware(ApiAuthMiddleware::class);
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage']);
Route::get('/user/detail/{id}', [UserController::class, 'detail']);

//RUTAS DE EMPRESAS 
Route::get('empresas', [EmpresaController::class, 'list']);
Route::get('empresas/{empresa}', [EmpresaController::class, 'show']);
Route::post('empresas', [EmpresaController::class, 'store']);
Route::put('empresas/{empresa}', [EmpresaController::class, 'update']);
Route::delete('empresas/{empresa}', [EmpresaController::class, 'destroy']);


//RUTAS DE PRODUCTOS 
Route::get('productos', [ProductosController::class, 'list']);
Route::get('productos/{producto}', [ProductosController::class, 'show']);
Route::post('productos', [ProductosController::class, 'store']);
Route::put('productos/{producto}', [ProductosController::class, 'update']);
Route::delete('productos/{producto}', [ProductosController::class, 'destroy']);

//Route::get('productos', 'App\Http\Controllers\ProductosController@list');
//Route::post('productos', 'App\Http\Controllers\ProductosController@store');

//RUTAS DE EMPLEADOS 
Route::get('empleados', [EmpleadoController::class, 'list']);
Route::get('empleados/{empleado}', [EmpleadoController::class, 'show']);
Route::post('empleados', [EmpleadoController::class, 'store']);
Route::put('empleados/{empleado}', [EmpleadoController::class, 'update']);
Route::delete('empleados/{empleado}', [EmpleadoController::class, 'destroy']);

//RUTAS DE VENTAS 
Route::get('ventas', [VentaController::class, 'list']);
Route::get('ventas/{venta}', [VentaController::class, 'show']);
Route::post('ventas', [VentaController::class, 'store']);
Route::put('ventas/{venta}', [VentaController::class, 'update']);
Route::delete('ventas/{venta}', [VentaController::class, 'destroy']);

//RUTAS DE COMPRAS 
Route::get('compras', [ComprasController::class, 'list']);
Route::get('compras/{compra}', [ComprasController::class, 'show']);
Route::post('compras', [ComprasController::class, 'store']);
Route::put('compras/{compra}', [ComprasController::class, 'update']);
Route::delete('compras/{compra}', [ComprasController::class, 'destroy']);


//RUTAS DE DIRECCION
Route::get('direcciones', [DireccionController::class, 'list']);
Route::get('direcciones/{direccion}', [DireccionController::class, 'show']);
Route::post('direcciones', [DireccionController::class, 'store']);
Route::put('direcciones/{direccion}', [DireccionController::class, 'update']);
Route::delete('direcciones/{direccion}', [DireccionController::class, 'destroy']);


//ruta vista 
Route::post('vista', [VistasController::class,'store']);
Route::get('vistas', [VistasController::class,'list']);

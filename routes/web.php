<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/producto', function () {
    return view('producto.index');
});

/*
Route::get('empleado/create',[EmpleadoController::class,'create'] );//aqui solo accede al create
                                                                            //estos 2 comandos toman en cuenta los metodos de la clase EmpleadoController*/
Route::resource('producto', ProductoController::class)->middleware('auth');//se puede acceder a todas las URL y trabajar comodamente

Auth::routes(['register'=>true,'reset'=>true]);

Route::get('/home', [ProductoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
   
    Route::get('/', [ProductoController::class, 'index'])->name('home');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;

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

/* Route::get('/empleado', function () {
    return view('empleado.index');
});

                            // Accedemos a la clase,       a que metodo queremos acceder
Route::get('/empleado/create', [EmpleadoController::class, 'create']);
*/
                                                        // respeta la autenticación
                                                // si no esta autenticado no podrá acceder a esa sección
Route::resource('empleado', EmpleadoController::class)->middleware('auth');
// opciones que queremos desaparecer
// Auth::routes(); // Descomentar esta y comentar la linea de abajo para registrarse
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

// Cuando el usuario utilice la autenticación e inicia sesión
Route::group(['middleware' => 'auth'], function () {
    // redirección al metodo index de la clase EmpleadoControlador
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
    
});

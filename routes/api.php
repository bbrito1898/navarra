<?php
use App\Http\Controllers\FilaEsperaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('index',[FilaEsperaController::class,'index']);
Route::get('/lista',[FilaEsperaController::class,'lista']);
Route::get('/sempre200', function () {
    return response()->json(['message' => 'OK'], 200);
});
Route::post('/contagem',[FilaEsperaController::class,'contagem']);
Route::post('/listagem',[FilaEsperaController::class,'listagemFiltrada']);


Route::get('/dadosApi', [FilaEsperaController::class, 'getDadosApi']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

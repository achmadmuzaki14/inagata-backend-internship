<?php

// use App\Http\Controllers\API\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\PemasukanController;
use App\Http\Controllers\API\PengeluaranController;
use App\Http\Controllers\API\LaporanController;

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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

    //API Profile
    // Route::get('/profile', function(Request $request) {
    //     return auth()->user();
    // });
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'store']);
    Route::put('/profile/{id}', [ProfileController::class, 'update']);
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy']);
    // Route::resource('/profile', ProfileController::class);
    // Route::post('/profile', [ProfileController::class, 'store']);

    Route::get('/pemasukan', [PemasukanController::class, 'index']);
    Route::post('/pemasukan', [PemasukanController::class, 'store']);
    Route::put('/pemasukan/{id}', [PemasukanController::class, 'update']);
    Route::get('/pemasukan/{id}', [PemasukanController::class, 'show']);
    Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy']);

    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update']);
    Route::get('/pengeluaran/{id}', [PengeluaranController::class, 'show']);
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan', [LaporanController::class, 'store']);
    Route::put('/laporan/{id}', [LaporanController::class, 'update']);
    Route::get('/laporan/{id}', [LaporanController::class, 'show']);
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy']);

});

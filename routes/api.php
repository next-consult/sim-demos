<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Auth\FlutterLoginController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/storeclient', [ImportController::class, 'store']);
Route::get('/conges', [CongeController::class, 'getConges']);
Route::post('/storeConges', [CongeController::class, 'storeConges']);
Route::post('/login', [FlutterLoginController::class, 'login']);
Route::post('/refreshToken', [FlutterLoginController::class, 'refreshToken']);
Route::put('/update', [CongeController::class, 'change_status']);
//Intervention
Route::get('/interventionsF', [InterventionController::class, 'indexF']);
Route::get('/addintervention', [InterventionController::class, 'addF']);
Route::get('/newintervention/{date?}', [InterventionController::class, 'createF']);
Route::post('/storeintervention', [InterventionController::class, 'storeF']);
Route::post('/updateintervention/{id}', [InterventionController::class, 'updateF']);
Route::get('/clotureintervention/{id}/{status}', [InterventionController::class, 'cloture']);
Route::post('/updatestoreintervention/{id}', [InterventionController::class, 'store_updateF']);
Route::get('/deleteintervention/{id}', [InterventionController::class, 'deleteF']);
Route::get('/printintervention/{id}', [InterventionController::class, 'printF']);
Route::post('/interventions/{id}/upload-image', [InterventionController::class, 'uploadImage']);

//Client
Route::get('/getClient', [ClientController::class, 'indexF']);


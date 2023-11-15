<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

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


Route::post('depot-prod',[ApiController::class,'addProduct']);
Route::post('update-depot-prod',[ApiController::class,'updateExistsingQte']);
Route::get('check-prod/{id}',[ApiController::class,'checkProdExists']);

<?php

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

Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    return auth()->user();
});


Route::middleware('jwt.auth')->group( function() {
    Route::resource('/books', 'App\Http\Controllers\API\BookController');
});

Route::post('/user/register', ['App\Http\Controllers\APIRegisterController'::class, 'register']);
Route::post('/user/login', ['App\Http\Controllers\APILoginController'::class, 'login']);
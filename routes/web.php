<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::get('/add-user', function () {
    return view('create-user');
});

Route::post('add-user', [ApiController::class, 'register_new_user']);
Route::get('/', function () {
    return view('welcome');
});

<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth','as'=>'admin.', 'prefix' => 'admin' ,'namespace' => 'App\Http\Controllers'] , function(){
    Route::resource('users',UserController::class);
    Route::resource('stores',StoreController::class);
    Route::resource('store.orders',OrderController::class);
});
//hook for listening on stores orders

Route::post('/stores/{store}/orders/import-order/',[OrderController::class,'hookPostOrder']);

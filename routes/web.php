<?php

use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Client\ShopController;

use App\Http\Controllers\SafirClickController;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SessionCookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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




Route::group(['prefix'=>'/',"as"=>'client.',"middleware"=>"web","namespace"=>"App\Http\Controllers\Client"] ,function(){
    Route::get('/shop',[ShopController::class,'shop']);
    Route::get('/',[ShopController::class,'home']);
    Route::get('categories/{category}',[ShopController::class,'category'])->name('categories.show');
    Route::resource('products',ProductController::class);
    Route::get('products/catalog/download',[App\Http\Controllers\Client\ProductController::class,'downloadCatalog'])->name('products.catalog.download');
    Route::get('products/posts/download',[App\Http\Controllers\Client\ProductController::class,'downloadPosts'])->name('products.posts.download');
    Route::post('{product}/quick-order',[ShopController::class ,"quickOrder"] )->name('quick-order');
    Route::get('/thank-you/{order?}',[ShopController::class ,"thankYou"] )->name('thank-you');
});

Auth::routes(['register'=>false]);


Route::group(['middleware' => 'auth','as'=>'admin.', 'prefix' => 'admin' ,'namespace' => 'App\Http\Controllers\Admin'] , function(){
    
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');    
    Route::resource('users',UserController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('products',ProductController::class);
    Route::resource('categories',CategoryController::class);
    Route::post('products/storeMedia',[ProductController::class,'storeMedia'])->name('products.storeMedia');
    Route::get('crowler',[SafirClickController::class,'show'])->name('crowler.show');
    Route::post('crowler',[SafirClickController::class,'crowl'])->name('crowler.store');
    Route::post('media/upload',[MediaController::class,'upload'])->name('media.upload');
    Route::post('media/ckUpload',[MediaController::class,'upload'])->name('media.ckUpload');
});
//hook for listening on stores orders

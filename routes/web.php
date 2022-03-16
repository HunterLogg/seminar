<?php

use GuzzleHttp\Middleware;
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

// Route::get('/', function () {
//     return view('app.welcome');
// });


Auth::routes();
// mainpage
Route::get('/', 'Home\WelcomeController@index');
Route::get('/home', 'Home\WelcomeController@index');
Route::get('/detail/{id}', 'Home\WelcomeController@detailProduct');
Route::get('/cart', 'Home\CartController@index');
Route::get('/product', 'Home\ProductController@index');
Route::get('/product/{id}', 'Home\ProductController@show');
Route::middleware(['auth'])->group(function () {
    Route::post('/cart', 'Home\CartController@create');
    Route::put('/cart/{id}', 'Home\CartController@update');
    Route::delete('/cart/{id}', 'Home\CartController@destroy');
    Route::get('/checkout', 'Home\CheckoutController@checkout');
    Route::post('/checkout', 'Home\CheckoutController@store');
    Route::get('/payment', 'Home\CheckoutController@payment');
    Route::post('/payment', 'Home\CheckoutController@order_place');
    Route::get('/wishlist', 'Home\WishlistController@index' );
    Route::post('/wishlist', 'Home\WishlistController@update' );
    Route::get('/wishlist/{id}', 'Home\WishlistController@store' );
    Route::get('/wishlist/destroy/{id}', 'Home\WishlistController@destroy' );
    Route::get('/order', 'Home\OrderController@index' );
    Route::get('/vieworder/{id}', 'Home\OrderController@listOrder');
});

// admin

Route::post('/admin/login','Admin\AccountController@login');
Route::get('/admin/login','Admin\AccountController@loginpage');
Route::get('/admin/register','Admin\AccountController@registerpage');
Route::post('/admin/register','Admin\AccountController@register');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin','Admin\AccountController@index');
    Route::resource('/admin/category','Admin\CategoryController');
    Route::resource('/admin/brand','Admin\BrandController');
    Route::resource('/admin/product','Admin\ProductController');
    Route::resource('/admin/cart', 'Admin\CartController' );
    Route::resource('/admin/order', 'Admin\OrderController' );
    Route::resource('/admin/user', 'Admin\UserController' );
    Route::get('/admin/vieworder/{id}', 'Admin\OrderController@listOrder');
    Route::get('/admin/order/shipping/{id}', 'Admin\OrderController@shipping');
    Route::post('/admin/order/pdf', 'Admin\OrderController@createPDF');

});

// api 
Route::get('/oauth/redirect', 'API\OAuthController@redirect')->name('redirect');
Route::get('/oauth/callback', 'API\OAuthController@callback');
Route::get('/oauth/refresh', 'API\OAuthController@refresh');


Route::get('product/image/{filename}', function ($filename)
{
    $path = public_path('upload/products/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});



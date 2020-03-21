<?php

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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', 'Admin\AdminController@index')->name('admin.home.index');

    Route::get('/admin/pizza/create', 'Admin\PizzaController@create')->name('admin.pizza.create');
    Route::post('/admin/pizza', 'Admin\PizzaController@store')->name('admin.pizza.store');
    Route::get('/admin/pizza', 'Admin\PizzaController@index')->name('admin.pizza.index');
    Route::get('/admin/pizza/{id}', 'Admin\PizzaController@show')->name('admin.pizza.show');
    Route::get('/admin/pizza/{id}/edit', 'Admin\PizzaController@edit')->name('admin.pizza.edit');
    Route::put('/admin/pizza/{id}', 'Admin\PizzaController@update')->name('admin.pizza.update');
    Route::delete('/admin/pizza/{id}','Admin\PizzaController@destroy')->name('admin.pizza.destroy');
    Route::get('/admin/pizza/{pizza}/upload', 'Admin\PizzaController@upload')->name('admin.pizza.upload');
    Route::post('/admin/pizza/{pizza}/save-upload', 'Admin\PizzaController@saveUpload')->name('admin.pizza.saveUpload');
    Route::get('admin/pizza/delete/{id}',['as' => 'admin.pizza.delete', 'uses' => 'Admin\PizzaController@destroy']);

    Route::get('/admin/order', 'Admin\OrderController@index')->name('admin.order.index');
    Route::get('/admin/order/{id}', 'Admin\OrderController@show')->name('admin.order.show');

    Route::get('/admin/user/create', 'Admin\UserController@create')->name('admin.user.create');
    Route::post('/admin/user', 'Admin\UserController@store')->name('admin.user.store');
    Route::get('/admin/user', 'Admin\UserController@index')->name('admin.user.index');
    Route::get('/admin/user/{id}/edit', 'Admin\UserController@edit')->name('admin.user.edit');
    Route::put('/admin/user/{id}', 'Admin\UserController@update')->name('admin.user.update');

    Route::get('/admin/change_password', 'Admin\ChangePasswordController@resetForm')->name('auth.change_password');
    Route::patch('/admin/change_password', 'Admin\ChangePasswordController@changePassword')->name('auth.change_password');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'User\PizzaController@index')->name('user.pizza.index');
    Route::get('/add-to-cart/{id}', 'User\PizzaController@add')->name('user.pizza.add');
    Route::get('/reduce/{id}', 'User\PizzaController@reduce')->name('user.pizza.reduce');
    Route::get('/increase/{id}', 'User\PizzaController@increase')->name('user.pizza.increase');
    Route::get('/shoppingCart', 'User\PizzaController@cart')->name('user.pizza.cart');
    Route::get('/clear', 'User\PizzaController@clear')->name('user.pizza.clear');
    Route::post('/home', 'User\PizzaController@store')->name('user.pizza.store');
    Route::get('/profile', 'User\PizzaController@profile')->name('user.pizza.profile');
});

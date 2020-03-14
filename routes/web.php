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
Route::get('/admin', 'AdminController@index')->name('admin.home.index');

Route::get('/admin/pizza/create', 'PizzaController@create')->name('admin.pizza.create');
Route::post('/admin/pizza', 'PizzaController@store')->name('admin.pizza.store');
Route::get('/admin/pizza', 'PizzaController@index')->name('admin.pizza.index');
Route::get('/admin/pizza/{id}', 'PizzaController@show')->name('admin.pizza.show');
Route::get('/admin/pizza/{id}/edit', 'PizzaController@edit')->name('admin.pizza.edit');
Route::put('/admin/pizza/{id}', 'PizzaController@update')->name('admin.pizza.update');
Route::delete('/admin/pizza/{id}','PizzaController@destroy')->name('admin.pizza.destroy');
Route::get('/admin/pizza/{pizza}/upload', 'PizzaController@upload')->name('admin.pizza.upload');
Route::post('/admin/pizza/{pizza}/save-upload', 'PizzaController@saveUpload')->name('admin.pizza.saveUpload');
Route::get('admin/pizza/delete/{id}',['as' => 'admin.pizza.delete', 'uses' => 'PizzaController@destroy']);

Route::get('/admin/size/create', 'SizeController@create')->name('admin.size.create');
Route::post('/admin/size', 'SizeController@store')->name('admin.size.store');
Route::get('/admin/size', 'SizeController@index')->name('admin.size.index');
Route::get('/admin/size/{id}/edit', 'SizeController@edit')->name('admin.size.edit');
Route::put('/admin/size/{id}', 'SizeController@update')->name('admin.size.update');
Route::get('admin/size/delete/{id}',['as' => 'admin.size.delete', 'uses' => 'SizeController@destroy']);

Route::get('/admin/order', 'OrderController@index')->name('admin.order.index');
Route::get('/admin/order/{id}', 'OrderController@show')->name('admin.order.show');
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

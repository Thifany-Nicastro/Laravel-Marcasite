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

Route::group(['middleware' => 'auth'], function () {

    //Route::get('/', 'ClienteController@index');
    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'PropostaController@search');
    Route::get('propostas/export/', 'PropostaController@export');
    Route::resource('clientes', 'ClienteController');
    Route::resource('propostas', 'PropostaController');

});

//Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('clientes', 'ClienteController')->middleware('auth');

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

/*
|--------------------------------------------------------------------------
| Route pour gérer tous les utilisateurs dans la page superAdmin
|--------------------------------------------------------------------------
*/

Route::get('/SuperAdmin','SuperAdminController@index')->name('SuperAdmin.index');
/*
|--------------------------------------------------------------------------
| Presenter un formulaire pour pouvoir creer des clients
|--------------------------------------------------------------------------
*/
Route::get('/SuperAdmin/create','SuperAdminController@create')->name('SuperAdmin.create');
/*
|--------------------------------------------------------------------------
| Route pour gérer l'affichage des informations d'un utilisateur
|--------------------------------------------------------------------------
*/
Route::get('/SuperAdmin/{user}','SuperAdminController@show')->name('SuperAdmin.show');
/*
|--------------------------------------------------------------------------
| Stocker des clients dans la base de donnees via la fonction store
|--------------------------------------------------------------------------
*/
Route::post('/SuperAdmin','SuperAdminController@store')->name('SuperAdmin.store');

/*
|--------------------------------------------------------------------------
|editer son profil via la fonction edit
|--------------------------------------------------------------------------
*/
Route::get('/SuperAdmin/{user}/edit','SuperAdminController@edit')->name('SuperAdmin.edit');

/*
|--------------------------------------------------------------------------
|udate son profil via la fonction edit
|--------------------------------------------------------------------------
*/
Route::PATCH('/SuperAdmin/{user}','SuperAdminController@update')->name('SuperAdmin.update');
/*
|--------------------------------------------------------------------------
|delete client
|--------------------------------------------------------------------------
*/
Route::delete('/SuperAdmin/{user}','SuperAdminController@destroy')->name('SuperAdmin.destroy');










/*
|--------------------------------------------------------------------------
| Cote Utilisateur Simple
|--------------------------------------------------------------------------
*/

Route::get('/AdminUsers', function () {
    return view('AdminUsers.index');
});

<?php
/* Route pour la page racine de mon site web */
Route::view('/','welcome');

/* ################## Partie Super Administrateur ######################## */

/* Route pour le Crud page super Administrateur */

Route::resource('SuperAdmin', 'SuperAdminController')->middleware('auth');;



/* Route pour gérer l'affichage des cryptomannaie et leurs cours */
Route::get('SuperAdmin.crypto_monnaie','AdminCryptoCurrencesController@monnaie');








/* ###################### Partie Utilisateurateur ########################## */

Route::get('/AdminUsers','UtilisateurController@list')->name('el')->middleware('auth');













/* ###################### Partie Authentification ########################## */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login.custom','LoginController@index')->name('login.custom');

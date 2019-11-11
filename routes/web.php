<?php
/* Route pour la page racine de mon site web */
Route::view('/','welcome');



/* ################## Partie Super Administrateur ######################## */


/* Route pour gérer l'affichage des donnees personnelles du super admin */
Route::get('SuperAdmin/personaldata', 'PersonalDataController@personaldata')->name('personaldata')->middleware('auth');


/* Route pour le Crud page super Administrateur */
Route::resource('SuperAdmin', 'SuperAdminController')->middleware('auth');


/* Route pour gérer l'affichage des cryptomannaie et leurs cours */
Route::get('SuperAdmin.crypto_monnaie','AdminCryptoCurrencesController@monnaie');



/* ##################Partie Utilisateurateur ######################## */

/* Route pour l'authentification partie utilisateur */
Route::get('/AdminUsers','UtilisateurController@list')->name('index')->middleware('auth');


/*Route pour affichage des donnees personnel utilisateur */
Route::get('AdminUsers/personaldatauser', 'PersonalDataUserController@personaldata')->name('personaldatauser')->middleware('auth');

Route::get('/AdminUsers/{id}/edit','PersonalDataUserController@edit')->name('AdminUsers.edit');

Route::PATCH('/AdminUsers/{id}','PersonalDataUserController@update')->name('AdminUsers.update');

/*Route pour affichager le portefeuille client*/












/* ################## Partie Authentification ######################## */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login.custom','LoginController@index')->name('login.custom');

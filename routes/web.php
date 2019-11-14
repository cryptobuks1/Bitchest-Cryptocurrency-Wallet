<?php
/* Route pour la page racine de mon site web */
Route::view('/','welcome');



/* ************ Partie Super Administrateur ****************** */


/* Route pour gérer l'affichage des donnees personnelles de Admin */
Route::get('SuperAdmin/personaldata', 'PersonalDataController@personaldata')->name('personaldata')->middleware('auth');


/* Route pour le Crud page super Administrateur */
Route::resource('SuperAdmin', 'SuperAdminController')->middleware('auth');


/* Route pour gérer l'affichage des cryptomannaie et leurs cours */
Route::get('SuperAdmin.crypto_monnaie','AdminCryptoCurrencesController@monnaie');



/* ##################Partie Utilisateurateur ######################## */

/* Route pour l'authentification partie utilisateur */
Route::get('/AdminUsers','UtilisateurController@list')->name('index');

/* Route pour afficher la liste des crypto monnaie  */
Route::get('cours_cryptos', 'CoursCryptosController@index')->name('cours_cryptos')->middleware('auth');

/*Route pour affichager des donnees personnel utilisateur */
Route::get('AdminUsers/personaldatauser','PersonalDataUserController@personaldata')->name('personaldatauser');

Route::get('/AdminUsers/{id}/edit','PersonalDataUserController@edit')->name('AdminUsers.edit');


Route::PATCH('/AdminUsers/{id}','PersonalDataUserController@update')->name('AdminUsers.update');



/*Route pour affichager le portefeuille client*/
Route::get('wallet', 'WalletController@index')->name('wallet');

Route::resource('buy', 'BuyController');


/* route pour afficher le details d'un portefeuile */
Route::get('wallet_cryptomoney/{crypto_id}', 'WalletCryptoMoneyController@index')->name('wallet_cryptomoney')->middleware('auth');











/* ################## Partie Authentification ######################## */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login.custom','LoginController@index')->name('login.custom');

<?php
/* Route pour la page racine de mon site web */
Route::view('/','welcome');



/* ************ Partie  Administrateur ****************** */


/* Route pour gérer l'affichage des donnees personnelles de Admin */
Route::get('Admin/personaldata', 'PersonalDataController@personaldata')->name('personaldata');

/* Route pour le Crud page Administrateur */
Route::resource('Admin','SuperAdminController');

/* Route pour gérer l'affichage des cryptomannaie et leurs cours */
Route::get('Admin.crypto_monnaie','AdminCryptoCurrencesController@monnaie');



/* ################# Partie Clients ######################## */

/* Route pour l'authentification partie utilisateur */
Route::get('/Clients','UtilisateurController@list')->name('index');

/* Route pour afficher la liste des crypto monnaie  */
Route::get('cours_cryptos', 'CoursCryptoController@index')->name('cours_cryptos');
/* Route pour afficher le graph  */
Route::get('graph/{crypto_id}', 'GraphController@index')->name('graph');

/*Route pour affichager des donnees personnel utilisateur */
Route::get('Clients/personaldatauser','PersonalDataUserController@personaldata')->name('personaldatauser');

/*Route pour editer les donnees personnelles de  l'utilisateur */
Route::get('/Clients/{id}/edit','PersonalDataUserController@edit')->name('AdminUsers.edit');

/*Route pour afficher les donnees personnelles de  l'utilisateur */
Route::PATCH('/Clients/{id}','PersonalDataUserController@update')->name('AdminUsers.update');

/*Route pour affichager le portefeuille client*/
Route::get('wallet', 'WalletController@index')->name('wallet');

/*Route pour acheter des crypto monnaies */
Route::resource('buy', 'BuyController');

/*Route pour vendre des crypto monnaies */
Route::get('sell', 'SellController@index')->name('sell');

/* route pour afficher le details d'un portefeuile */
Route::get('wallet_cryptomoney/{crypto_id}', 'WalletCryptoMoneyController@index')->name('wallet_cryptomoney');

Route::get('destroy/{crypto_id}','WalletCryptoMoneyController@destroy')->name('destroy');


/* ################## Partie Authentification ######################## */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login.custom','LoginController@index')->name('login.custom');

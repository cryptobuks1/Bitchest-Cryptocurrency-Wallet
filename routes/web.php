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
| page index du SuperAdmin
|--------------------------------------------------------------------------
*/

Route::get('/SuperAdmin', function () {
    return view('SuperAdmin.index');
});


/*
|--------------------------------------------------------------------------
| page index du AdminUsers
|--------------------------------------------------------------------------
*/

Route::get('/AdminUsers', function () {
    return view('AdminUsers.index');
});

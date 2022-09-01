<?php

use Illuminate\Support\Facades\Route;

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

//route acceuil
Route::get('/', function () {
    return view('accueil');
});

//route vers la page à propos
Route::get('/apropos', function () {
    return view('apropos');
});

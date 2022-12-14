<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
})->name('accueil');

//route vers la page à propos
Route::get('/apropos', function () {
    return view('apropos');
})->name('apropos');

//route vers la page à propos
Route::get('/nosoffres', function () {
    return view('nosoffres');
})->name('nosoffres');


// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

});

require __DIR__.'/auth.php';


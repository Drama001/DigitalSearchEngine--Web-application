<?php

use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch;
//use Elastic\Elasticsearch\ClientBuilder;

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



Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('login');
});

Route::get('/register', function (){
    return view('register');
});

Route::get('/home', function (){
    return view('index');
})->name('home');

Route::get('/search', 'App\Http\Controllers\MainController@searchEngine');

Route::get('/viewSearch', 'App\Http\Controllers\MainController@viewSearchEngine');

Route::get('/dissertationView/{id}', 'App\Http\Controllers\MainController@openDissertation');

Route::get('/viewPDF/{pdf}', 'App\Http\Controllers\MainController@openPDF');







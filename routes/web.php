<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/cards', function () {
    return view('cards');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/tables', function () {
    return view('tables');
});

Route::get('/person', 'App\Http\Controllers\PersonController@index');

//Route::get('/insertperson','App\Http\Controllers\PersonController@insert');

Route::get('/createperson','App\Http\Controllers\PersonController@createPersonController');

Route::post('/submitPerson','App\Http\Controllers\PersonController@submitPersonController');

Route::get('/blank', function () {
    return view('blank');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/createperson', function () {
    return view('createperson');
});

Route::get('/buttons', function () {
    return view('buttons');
});


Route::get('/multistepform', function () {
    return view('multistepform');
});

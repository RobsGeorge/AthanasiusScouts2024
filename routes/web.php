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

//General UI Routes
Route::get('/', function () {return view('index');});
Route::get('/welcome', function () {return view('welcome');});
Route::get('/cards', function () {return view('cards');});
Route::get('/charts', function () {return view('charts');});
Route::get('/blank', function () {return view('blank');});
Route::get('/index', function () {return view('index');});
Route::get('/buttons', function () {return view('buttons');});

//General Registration and Login Routes
Route::get('/login', function () {return view('login');});
Route::get('/register', function () {return view('register');});
Route::get('/forgot-password', function () {return view('forgot-password');});

//Person Tables Routes
Route::get('/tables', function () {return view('tables');});

//Routes for Person Information
//Route::get('/createperson', function () {return view('createperson');});
Route::get('/person', 'App\Http\Controllers\PersonController@index');
//Route::get('/insertperson','App\Http\Controllers\PersonController@insert');
Route::get('/createperson','App\Http\Controllers\PersonController@createPersonController');
Route::post('/submitPerson','App\Http\Controllers\PersonController@submitPersonController');

//New Routes for Person Information
Route::get('/person', array('as'=> 'person.index', 'uses'=>'App\Http\Controllers\PersonNewController@index'));
Route::get('/person/{id}', array('as'=> 'person.show', 'uses'=>'App\Http\Controllers\PersonNewController@show'));
Route::get('/person/add', array('as' => 'person.create', 'uses' =>'App\Http\Controllers\PersonNewController@create'));
Route::post('/person/insert', array('as' => 'person.insert', 'uses' => 'App\Http\Controllers\PersonNewController@insert'));
Route::get('/person/edit/{id}', array('as' => 'person.edit', 'uses' => 'App\Http\Controllers\PersonNewController@edit'));
Route::patch('/person/update/{id}', array('as'=> 'person.update', 'uses'=> 'App\Http\Controllers\PersonNewController@updates'));
Route::get('/person/delete/{id}', array('as'=> 'person.delete', 'uses'=>'App\Http\Controllers\PersonNewController@deletes'));
Route::delete('/person/destroy/{id}', array('as'=> 'person.destroy', 'uses'=>'App\Http\Controllers\PersonNewController@destroy'));
Route::get('/person/entry-questions/{id}', array('as'=> 'person-entry-questions.insert', 'App\Http\Controllers\PersonNewController@insertQuestions'));


//Routes for Rotab Kashfeyya
Route::get('/rotab', array('as' => 'rotab.index', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@index'));
Route::get('/rotab/add', array('as' => 'rotab.create', 'uses' =>'App\Http\Controllers\RotbaKashfeyaController@create'));
Route::post('/rotab/insert', array('as' => 'rotab.insert', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@insert'));
Route::get('/rotab/edit/{id}', array('as' => 'rotab.edit', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@edit'));
Route::patch('/rotab/update/{id}', array('as'=> 'rotab.update', 'uses'=> 'App\Http\Controllers\RotbaKashfeyaController@updates'));
Route::get('/rotab/delete/{id}', array('as'=> 'rotab.delete', 'uses'=>'App\Http\Controllers\RotbaKashfeyaController@deletes'));
Route::delete('/rotab/destroy/{id}', array('as'=> 'rotab.destroy', 'uses'=>'App\Http\Controllers\RotbaKashfeyaController@destroy'));


//Routes for Blood Types
Route::get('/blood', array('as'=> 'blood.index', 'uses'=> 'App\Http\Controllers\BloodTypeController@index'));
Route::get('/blood/add', array('as' => 'blood.create', 'uses' =>'App\Http\Controllers\BloodTypeController@create'));
Route::post('/blood/insert', array('as' => 'blood.insert', 'uses' => 'App\Http\Controllers\BloodTypeController@insert'));
Route::get('/blood/edit/{id}', array('as' => 'blood.edit', 'uses' => 'App\Http\Controllers\BloodTypeController@edit'));
Route::patch('/blood/update/{id}', array('as'=> 'blood.update', 'uses'=> 'App\Http\Controllers\BloodTypeController@updates'));
Route::get('/blood/delete/{id}', array('as'=> 'blood.delete', 'uses'=>'App\Http\Controllers\BloodTypeController@deletes'));
Route::delete('/blood/destroy/{id}', array('as'=> 'blood.destroy', 'uses'=>'App\Http\Controllers\BloodTypeController@destroy'));

//Routes for Marhala Deraseyya
Route::get('/marhala', array('as'=> 'marhala.index', 'uses'=> 'App\Http\Controllers\MarhalaDeraseyyaController@index'));
Route::get('/marhala/add', array('as' => 'marhala.create', 'uses' =>'App\Http\Controllers\MarhalaDeraseyyaController@create'));
Route::post('/marhala/insert', array('as' => 'marhala.insert', 'uses' => 'App\Http\Controllers\MarhalaDeraseyyaController@insert'));
Route::get('/marhala/edit/{id}', array('as' => 'marhala.edit', 'uses' => 'App\Http\Controllers\MarhalaDeraseyyaController@edit'));
Route::patch('/marhala/update/{id}', array('as'=> 'marhala.update', 'uses'=> 'App\Http\Controllers\MarhalaDeraseyyaController@updates'));
Route::get('/marhala/delete/{id}', array('as'=> 'marhala.delete', 'uses'=>'App\Http\Controllers\MarhalaDeraseyyaController@deletes'));
Route::delete('/marhala/destroy/{id}', array('as'=> 'marhala.destroy', 'uses'=>'App\Http\Controllers\MarhalaDeraseyyaController@destroy'));

//Routes for Sana Marhala
Route::get('/marhala-sana', array('as'=> 'marhala-sana.index', 'uses'=> 'App\Http\Controllers\MarhalaSanaDeraseyyaController@index'));

//Routes for Entry Questions
Route::get('/entry-questions', array('as'=> 'entry-questions.index', 'uses'=>'App\Http\Controllers\MarhalaEntryQuestionsController@index'));
Route::get('/entry-questions/add', array('as' => 'entry-questions.create', 'uses' =>'App\Http\Controllers\MarhalaEntryQuestionsController@create'));
Route::post('/entry-questions/insert', array('as' => 'entry-questions.insert', 'uses' => 'App\Http\Controllers\MarhalaEntryQuestionsController@insert'));
Route::get('/entry-questions/edit/{id}', array('as' => 'entry-questions.edit', 'uses' => 'App\Http\Controllers\MarhalaEntryQuestionsController@edit'));
Route::patch('/entry-questions/update/{id}', array('as'=> 'entry-questions.update', 'uses'=> 'App\Http\Controllers\MarhalaEntryQuestionsController@updates'));
Route::get('/entry-questions/delete/{id}', array('as'=> 'entry-questions.delete', 'uses'=>'App\Http\Controllers\MarhalaEntryQuestionsController@deletes'));
Route::delete('/entry-questions/destroy/{id}', array('as'=> 'entry-questions.destroy', 'uses'=>'App\Http\Controllers\MarhalaEntryQuestionsController@destroy'));

//No Title
Route::get('/multistepform', function () {return view('multistepform');});



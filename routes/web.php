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
//Route::get('/tables', function () {return view('tables');});

//Routes for Person Information
//Route::get('/createperson', function () {return view('createperson');});
//Route::get('/person', 'App\Http\Controllers\PersonController@index');
//Route::get('/insertperson','App\Http\Controllers\PersonController@insert');
//Route::get('/createperson','App\Http\Controllers\PersonController@createPersonController');
//Route::post('/submitPerson','App\Http\Controllers\PersonController@submitPersonController');

//New Routes for Person Information
Route::get('/person', array('as'=> 'person.index', 'uses'=>'App\Http\Controllers\PersonNewController@index'));
Route::get('/person/show/{id}', array('as'=> 'person.show', 'uses'=>'App\Http\Controllers\PersonNewController@show'));
Route::get('/person/add', array('as' => 'person.create', 'uses' =>'App\Http\Controllers\PersonNewController@create'));
Route::post('/person/insert', array('as' => 'person.insert', 'uses' => 'App\Http\Controllers\PersonNewController@insert'));
Route::get('/person/edit/{id}', array('as' => 'person.edit', 'uses' => 'App\Http\Controllers\PersonNewController@edit'));
Route::patch('/person/update/{id}', array('as'=> 'person.update', 'uses'=> 'App\Http\Controllers\PersonNewController@updates'));
Route::get('/person/delete/{id}', array('as'=> 'person.delete', 'uses'=>'App\Http\Controllers\PersonNewController@deletes'));
Route::delete('/person/destroy/{id}', array('as'=> 'person.destroy', 'uses'=>'App\Http\Controllers\PersonNewController@destroy'));
Route::get('/person/entry-questions/insert/{id}', array('as'=> 'person.entry-questions', 'uses'=>'App\Http\Controllers\PersonNewController@getQuestions'));
Route::post('/person/entry-questions/submit', array('as'=> 'person.entry-questions-submit', 'uses'=>'App\Http\Controllers\PersonNewController@submitQuestions'));

//Routes for Rotab Kashfeyya
Route::get('/rotab', array('as' => 'rotab.index', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@index'));
Route::get('/rotab/add', array('as' => 'rotab.create', 'uses' =>'App\Http\Controllers\RotbaKashfeyaController@create'));
Route::post('/rotab/insert', array('as' => 'rotab.insert', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@insert'));
Route::get('/rotab/edit/{id}', array('as' => 'rotab.edit', 'uses' => 'App\Http\Controllers\RotbaKashfeyaController@edit'));
Route::patch('/rotab/update/{id}', array('as'=> 'rotab.update', 'uses'=> 'App\Http\Controllers\RotbaKashfeyaController@updates'));
Route::get('/rotab/delete/{id}', array('as'=> 'rotab.delete', 'uses'=>'App\Http\Controllers\RotbaKashfeyaController@deletes'));
Route::delete('/rotab/destroy/{id}', array('as'=> 'rotab.destroy', 'uses'=>'App\Http\Controllers\RotbaKashfeyaController@destroy'));

//Routes for Betakat Takaddom
Route::get('/betaka', array('as' => 'betaka.index', 'uses' => 'App\Http\Controllers\BetakaTakaddomController@index'));
Route::get('/betaka/add', array('as' => 'betaka.create', 'uses' =>'App\Http\Controllers\BetakaTakaddomController@create'));
Route::post('/betaka/insert', array('as' => 'betaka.insert', 'uses' => 'App\Http\Controllers\BetakaTakaddomController@insert'));
Route::get('/betaka/edit/{id}', array('as' => 'betaka.edit', 'uses' => 'App\Http\Controllers\BetakaTakaddomController@edit'));
Route::patch('/betaka/update/{id}', array('as'=> 'betaka.update', 'uses'=> 'App\Http\Controllers\BetakaTakaddomController@updates'));
Route::get('/betaka/delete/{id}', array('as'=> 'betaka.delete', 'uses'=>'App\Http\Controllers\BetakaTakaddomController@deletes'));
Route::delete('/betaka/destroy/{id}', array('as'=> 'betaka.destroy', 'uses'=>'App\Http\Controllers\BetakaTakaddomController@destroy'));


//Routes for Blood Types
Route::get('/blood', array('as'=> 'blood.index', 'uses'=> 'App\Http\Controllers\BloodTypeController@index'));
Route::get('/blood/add', array('as' => 'blood.create', 'uses' =>'App\Http\Controllers\BloodTypeController@create'));
Route::post('/blood/insert', array('as' => 'blood.insert', 'uses' => 'App\Http\Controllers\BloodTypeController@insert'));
Route::get('/blood/edit/{id}', array('as' => 'blood.edit', 'uses' => 'App\Http\Controllers\BloodTypeController@edit'));
Route::patch('/blood/update/{id}', array('as'=> 'blood.update', 'uses'=> 'App\Http\Controllers\BloodTypeController@updates'));
Route::get('/blood/delete/{id}', array('as'=> 'blood.delete', 'uses'=>'App\Http\Controllers\BloodTypeController@deletes'));
Route::delete('/blood/destroy/{id}', array('as'=> 'blood.destroy', 'uses'=>'App\Http\Controllers\BloodTypeController@destroy'));

//Routes for Manateq
Route::get('/manteqa', array('as'=> 'manteqa.index', 'uses'=> 'App\Http\Controllers\ManteqaController@index'));
Route::get('/manteqa/add', array('as' => 'manetqa.create', 'uses' =>'App\Http\Controllers\ManteqaController@create'));
Route::post('/manteqa/insert', array('as' => 'manteqa.insert', 'uses' => 'App\Http\Controllers\ManteqaController@insert'));
Route::get('/manteqa/edit/{id}', array('as' => 'manteqa.edit', 'uses' => 'App\Http\Controllers\ManteqaController@edit'));
Route::patch('/manteqa/update/{id}', array('as'=> 'manteqa.update', 'uses'=> 'App\Http\Controllers\ManteqaController@updates'));
Route::get('/manteqa/delete/{id}', array('as'=> 'manteqa.delete', 'uses'=>'App\Http\Controllers\ManteqaController@deletes'));
Route::delete('/manteqa/destroy/{id}', array('as'=> 'manteqa.destroy', 'uses'=>'App\Http\Controllers\ManteqaController@destroy'));

//Routes for Districts
Route::get('/district', array('as'=> 'district.index', 'uses'=> 'App\Http\Controllers\DistrictController@index'));
Route::get('/district/add', array('as' => 'district.create', 'uses' =>'App\Http\Controllers\DistrictController@create'));
Route::post('/district/insert', array('as' => 'district.insert', 'uses' => 'App\Http\Controllers\DistrictController@insert'));
Route::get('/district/edit/{id}', array('as' => 'district.edit', 'uses' => 'App\Http\Controllers\DistrictController@edit'));
Route::patch('/district/update/{id}', array('as'=> 'district.update', 'uses'=> 'App\Http\Controllers\DistrictController@updates'));
Route::get('/district/delete/{id}', array('as'=> 'district.delete', 'uses'=>'App\Http\Controllers\DistrictController@deletes'));
Route::delete('/district/destroy/{id}', array('as'=> 'district.destroy', 'uses'=>'App\Http\Controllers\DistrictController@destroy'));

//Routes for Qetaat
Route::get('/qetaa', array('as'=> 'qetaa.index', 'uses'=> 'App\Http\Controllers\QetaaController@index'));
Route::get('/qetaa/add', array('as' => 'qetaa.create', 'uses' =>'App\Http\Controllers\QetaaController@create'));
Route::post('/qetaa/insert', array('as' => 'qetaa.insert', 'uses' => 'App\Http\Controllers\QetaaController@insert'));
Route::get('/qetaa/edit/{id}', array('as' => 'qetaa.edit', 'uses' => 'App\Http\Controllers\QetaaController@edit'));
Route::patch('/qetaa/update/{id}', array('as'=> 'qetaa.update', 'uses'=> 'App\Http\Controllers\QetaaController@updates'));
Route::get('/qetaa/delete/{id}', array('as'=> 'qetaa.delete', 'uses'=>'App\Http\Controllers\QetaaController@deletes'));
Route::delete('/qetaa/destroy/{id}', array('as'=> 'qetaa.destroy', 'uses'=>'App\Http\Controllers\QetaaController@destroy'));

//Routes for Faculty
Route::get('/faculty', array('as'=> 'faculty.index', 'uses'=> 'App\Http\Controllers\FacultyController@index'));
Route::get('/faculty/add', array('as' => 'faculty.create', 'uses' =>'App\Http\Controllers\FacultyController@create'));
Route::post('/faculty/insert', array('as' => 'faculty.insert', 'uses' => 'App\Http\Controllers\FacultyController@insert'));
Route::get('/faculty/edit/{id}', array('as' => 'faculty.edit', 'uses' => 'App\Http\Controllers\FacultyController@edit'));
Route::patch('/faculty/update/{id}', array('as'=> 'faculty.update', 'uses'=> 'App\Http\Controllers\FacultyController@updates'));
Route::get('/faculty/delete/{id}', array('as'=> 'faculty.delete', 'uses'=>'App\Http\Controllers\FacultyController@deletes'));
Route::delete('/faculty/destroy/{id}', array('as'=> 'faculty.destroy', 'uses'=>'App\Http\Controllers\FacultyController@destroy'));

//Routes for University
Route::get('/university', array('as'=> 'university.index', 'uses'=> 'App\Http\Controllers\UniversityController@index'));
Route::get('/university/add', array('as' => 'university.create', 'uses' =>'App\Http\Controllers\UniversityController@create'));
Route::post('/university/insert', array('as' => 'university.insert', 'uses' => 'App\Http\Controllers\UniversityController@insert'));
Route::get('/university/edit/{id}', array('as' => 'university.edit', 'uses' => 'App\Http\Controllers\UniversityController@edit'));
Route::patch('/university/update/{id}', array('as'=> 'university.update', 'uses'=> 'App\Http\Controllers\UniversityController@updates'));
Route::get('/university/delete/{id}', array('as'=> 'university.delete', 'uses'=>'App\Http\Controllers\UniversityController@deletes'));
Route::delete('/university/destroy/{id}', array('as'=> 'university.destroy', 'uses'=>'App\Http\Controllers\UniversityController@destroy'));

//Routes for Marhala Deraseyya
Route::get('/marhala', array('as'=> 'marhala.index', 'uses'=> 'App\Http\Controllers\MarhalaDeraseyyaController@index'));
Route::get('/marhala/add', array('as' => 'marhala.create', 'uses' =>'App\Http\Controllers\MarhalaDeraseyyaController@create'));
Route::post('/marhala/insert', array('as' => 'marhala.insert', 'uses' => 'App\Http\Controllers\MarhalaDeraseyyaController@insert'));
Route::get('/marhala/edit/{id}', array('as' => 'marhala.edit', 'uses' => 'App\Http\Controllers\MarhalaDeraseyyaController@edit'));
Route::patch('/marhala/update/{id}', array('as'=> 'marhala.update', 'uses'=> 'App\Http\Controllers\MarhalaDeraseyyaController@updates'));
Route::get('/marhala/delete/{id}', array('as'=> 'marhala.delete', 'uses'=>'App\Http\Controllers\MarhalaDeraseyyaController@deletes'));
Route::delete('/marhala/destroy/{id}', array('as'=> 'marhala.destroy', 'uses'=>'App\Http\Controllers\MarhalaDeraseyyaController@destroy'));

//Routes for Sana Marhala
Route::get('/sana-marhala', array('as'=> 'sana-marhala.index', 'uses'=> 'App\Http\Controllers\SanaMarhalaDeraseyyaController@index'));
Route::get('/sana-marhala/add', array('as' => 'sana-marhala.create', 'uses' =>'App\Http\Controllers\SanaMarhalaDeraseyyaController@create'));
Route::post('/sana-marhala/insert', array('as' => 'sana-marhala.insert', 'uses' => 'App\Http\Controllers\SanaMarhalaDeraseyyaController@insert'));
Route::get('/sana-marhala/edit/{id}', array('as' => 'sana-marhala.edit', 'uses' => 'App\Http\Controllers\SanaMarhalaDeraseyyaController@edit'));
Route::patch('/sana-marhala/update/{id}', array('as'=> 'sana-marhala.update', 'uses'=> 'App\Http\Controllers\SanaMarhalaDeraseyyaController@updates'));
Route::get('/sana-marhala/delete/{id}', array('as'=> 'sana-marhala.delete', 'uses'=>'App\Http\Controllers\SanaMarhalaDeraseyyaController@deletes'));
Route::delete('/sana-marhala/destroy/{id}', array('as'=> 'sana-marhala.destroy', 'uses'=>'App\Http\Controllers\SanaMarhalaDeraseyyaController@destroy'));

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



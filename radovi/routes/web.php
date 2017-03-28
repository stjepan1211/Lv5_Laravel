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

Route::post('/applies/confirmstudent', 'UserController@confirmstudent');

Route::post('/editUser', 'UserController@editUser');

Route::post('/addTask', 'TasksController@addTask');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/english', 'HomeController@changeToEnglishLang');

Route::post('/croatian', 'HomeController@changeToCroatianLang');

Route::post('/apply', 'UserController@apply');

Route::get('/applies/{task_id}', 'TasksController@applies');


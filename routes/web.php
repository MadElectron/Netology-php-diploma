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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/index/{id}', 'IndexController@indexCategory')->name('index.category');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('user', 'UserController', ['except' => ['show']])->middleware('auth');
Route::resource('category', 'CategoryController', ['except' => ['show']])->middleware('auth');
Route::resource('question', 'QuestionController', ['except' => ['show']]);
Route::resource('answer', 'AnswerController', ['except' => [
    'index', 'show', 'edit', 'update',
]])->middleware('auth');


Route::get('/question/category/{id}', 'QuestionController@indexByCategory')->name('question.index_by_category')->middleware('auth');

Route::get('/question/hide/{id}', 'QuestionController@hide')->name('question.hide')->middleware('auth');
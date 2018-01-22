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

Route::resource('user', 'UserController', ['except' => [
    'store', 'show', 'update',
]]);
Route::resource('category', 'CategoryController', ['except' => [
    'store', 'show', 'update',
]]);
Route::resource('question', 'QuestionController', ['except' => [
    'store', 'show', 'update',
]]);
Route::resource('answer', 'AnswerController', ['except' => [
    'store', 'show', 'edit', 'update',
]]);

Route::get('/question/category/{id}', 'QuestionController@indexByCategory')->name('question.index_by_category');

Route::get('/question/hide/{id}', 'QuestionController@hide')->name('question.hide');
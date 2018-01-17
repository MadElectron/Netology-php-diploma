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
    return view('index');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'user' => 'UserController',
    'category' => 'CategoryController',
    'question' => 'QuestionController',
    'answer' => 'AnswerController',
]);

Route::get('/question/category/{id}', 'QuestionController@indexByCategory')->name('question.index_by_category');

Route::get('/question/hide/{id}', 'QuestionController@hide')->name('question.hide');
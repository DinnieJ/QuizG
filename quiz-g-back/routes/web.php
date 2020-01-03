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

Auth::routes();

Route::get('/login', function () {
    return view('login');
});

Route::get('/users', 'Admin\AdminController@allUser');

Route::get('/users/{id}','Admin\AdminController@detailUser');

Route::get('/collections','Admin\AdminController@allCollection');

Route::get('/collections/{id}', 'Admin\AdminController@detailCollection');

Route::get('/quizzes','Admin\AdminController@allQuiz');

Route::get('/quizzes/{id}', 'Admin\AdminController@detailQuiz');

Route::get('/history', 'Admin\AdminController@allHistory');
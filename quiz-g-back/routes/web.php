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

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/users/{id}', function () {
    return view('users.item');
});

Route::get('/collections', function () {
    return view('collections.index');
});

Route::get('/collections/{id}', function () {
    return view('collections.item');
});

Route::get('/quizzes', function () {
    return view('quizzes.index');
});

Route::get('/quizzes/{id}', function () {
    return view('quizzes.item');
});


Route::get('/history', function () {
    return view('history.index');
});
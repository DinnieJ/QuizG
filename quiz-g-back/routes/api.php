<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
Route::prefix('collections')->group(function () {
    Route::group(['middleware'=> 'auth:api'],function(){
        Route::post('/add','CollectionController@store');
        Route::delete('/{id}','CollectionController@destroy');
        Route::put('/{id}','CollectionController@update');
        Route::put('/add/{id}','CollectionController@addQuizToCollection');
        Route::put('/remove/{id}/{quiz_id}','CollectionController@removeQuiz');
    });
    Route::get('/','CollectionController@all');
    Route::get('/{id}','CollectionController@show');
    Route::get('/user/{user}','CollectionController@getCollectionByUser');
});

Route::prefix('quizzes')->group(function () {
    Route::group(['middleware'=>'auth:api'], function () {
        Route::post('/add','QuizController@store');
        Route::delete('/{id}','QuizController@destroy');
        Route::get('/{id}','QuizController@show');
        Route::put('/{id}','QuizController@update');
    });
});

Route::prefix('game')->group(function () {
    Route::post('/grading', 'GameController@gradingQuiz');
    Route::get('/{id}','GameController@getGameData');
    Route::post('/submit','GameController@submitGame');
});

Route::prefix('test')->group(function () {
    Route::get('/test/{id}','TestController@getTestData');
    Route::post('/submit','TestController@submitTest');
});

Route::prefix('history')->group(function () {
    Route::get('/','HistoryController@getHistory')->middleware('auth:api');
});
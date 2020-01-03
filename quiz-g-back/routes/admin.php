<?php
Route::namespace('Admin')->group(function (){
    Route::get('login','LoginController@showLoginForm');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::group(['middleware' => ['authadmin:admin']], function () {
        Route::get('/users', 'AdminController@allUser');
        Route::get('/users/{id}','AdminController@detailUser');
        Route::get('/collections','AdminController@allCollection');
        Route::get('/collections/{id}', 'AdminController@detailCollection');
        Route::get('/quizzes','AdminController@allQuiz');
        Route::get('/quizzes/{id}', 'AdminController@detailQuiz');
        Route::get('/history', 'AdminController@allHistory');
        Route::post('/logout','LoginController@logoutAdmin');
    });
});



?>
<?php

// 共通処理 : Urlの先頭にusersが付与 、認証済みかどうかを判定
Route::group(['prefix'=>'users', 'middleware'=>'auth'], function() {
    // プロフィール画面
    Route::get('/show/{id}', 'UserController@show')->name('users.show');    // http://localhost:8000/users/show/1
    // 編集画面
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
    // 編集処理
    Route::post('/update/{id}', 'UserController@update')->name('users.update');
});

// トップ画面
Route::get('/', function () {
    return view('top');
});

// 認証画面
Auth::routes();

// home画面 home画面に遷移する前に、MiddlewareのRedirectIfAuthenticatedが呼ばれている
Route::get('/home', 'HomeController@index')->name('home');

// マッチング画面
Route::get('/matching', 'MatchingController@index')->name('matching');

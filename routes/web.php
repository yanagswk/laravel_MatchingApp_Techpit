<?php

// Route::groupで共通の処理をグルーピング化
//             Urlの先頭にusersが付与  認証済みかどうかを判定
Route::group(['prefix'=>'users', 'middleware'=>'auth'], function() {
    // プロフィール画面 : http://localhost:8000/users/show/1
    Route::get('/show/{id}', 'UserController@show')->name('users.show');
});

// トップ画面
Route::get('/', function () {
    return view('top');
});

// 認証画面
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

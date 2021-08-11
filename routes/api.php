<?php

/**
 * api用のファイル
 * 
 * route/api.phpファイルにルーティングを記載すると自動的に 
 * /apiというURLが付与されます。
 */

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Ajax使用 like, dislikeを取得
Route::post('/like', 'ReactionController@create');

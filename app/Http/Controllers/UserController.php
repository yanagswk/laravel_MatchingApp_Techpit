<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * userごとのプロフィール画面表示
     */
    // public function show($id)
    public function show($id)
    {   
        // ユーザー情報取得
        $user = User::findorFail($id);
        // dd($user);
        return view('users.show', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


/**
 * ホーム画面用のコントローラー
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 認証済みであれば表示、認証していなければ/loginにリダイレクト
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 全てのユーザーテーブルの全ての情報を取得
        $users = User::all();

        $userCount = $users->count();   // 全ユーザー数取得
        $from_user_id = Auth::id();     // 現在のログインユーザーのID取得
        // dd($from_user_id);
        return view('home', compact('users', 'userCount', 'from_user_id'));
    }
}

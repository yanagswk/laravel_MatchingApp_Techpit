<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reaction;
use App\User;
use Auth;
use App\Constants\Status;

class MatchingController extends Controller
{
    /**
     * マッチング画面
     * マッチングした人を取得
     */
    public static function index()
    {   
        // 自分(to_user_id)へLIKEしてくれた人のID(from_user_id)を取得
        $got_reaction_ids = Reaction::where([
            ['to_user_id', Auth::id()],     // to_user_idが自分になる
            ['status', Status::LIKE]
        ])->pluck('from_user_id');          // pluckを使うことで、LIKEしてくれた人のID情報のみを取得

        // LIKEしてくれた人のidだけを検索しつつ、自分(この場合はfrom_user_id)がLIKEしている人を取得
        $matching_ids = Reaction::whereIn('to_user_id', $got_reaction_ids)
                        ->where('status', Status::LIKE)
                        ->where('from_user_id', Auth::id())     // ログインユーザー(自分)
                        ->pluck('to_user_id');
        
        // WhereInで、LIKEしてくれた人のidだけを検索
        $matching_users = User::whereIn('id', $matching_ids)->get();

        // 人数
        $match_users_count = count($matching_users);

        return view('users.index', compact('matching_users', 'match_users_count'));

    }
}

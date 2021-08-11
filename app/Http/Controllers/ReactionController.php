<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;                    // ログ用クラス
use App\User;               // Userモデル
use App\Reaction;           // Reactionモデル
use App\Constants\Status;   // statusカラム用の定数クラス

/**
 * リレーション用コントローラー
 * route/api.phpから
 */
class ReactionController extends Controller
{
    /**
     * Ajax使用 like, dislikeを取得
     */
    public function create(Request $request)
    {
        // Post通信で渡ってきた内容をログに出力
        Log::debug($request);

        $to_user_id = $request->to_user_id;
        $like_status = $request->reaction;
        $from_user_id = $request->from_user_id;

        // likeかdislikeか判定
        if ($like_status === 'like') {
            $status = Status::LIKE;
        } else {
            $status = Status::DISLIKE;
        }

        // Reactionテーブルから取得
        $checkReaction = Reaction::where([
            ['to_user_id', $to_user_id],
            ['from_user_id', $from_user_id]
        ])->get();
        
        // to_user_idとfrom_user_idの組み合わせがない場合、DBへ保存
        if ($checkReaction->isEmpty()) {
            $reaction = new Reaction();
            $reaction->to_user_id = $to_user_id;
            $reaction->from_user_id = $from_user_id; 
            $reaction->status = $status;
            $reaction->save();
        }
    }
}

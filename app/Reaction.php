<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * reactionsテーブル用クラス
 */
class Reaction extends Model
{
    // インクリメントIDを無効化
    public $incrementing = false;
     // update_at, created_at を無効化
    public $timestamps = false;

    // protected $fillable = [
    //     'to_user_id', 'from_user_id', 'status'
    // ];

    /**
     * Userテーブルとのリレーションを設定
     * to_user_idカラム いいねされた人
     * 
     * 主キー: User:id
     * 外部キー: Reaction:to_user_id
     */
    public function toUserId()
    {
                    // belongsTo(相手のモデル名, 自モデルのID, 相手のID名)
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }


    /**
     * Userテーブルとのリレーションを設定
     * from_user_idカラム いいねした人(ログインしているユーザー)
     * 
     * 主キー: User:id
     * 外部キー: Reaction:from_user_id
     */
    public function fromUserId()
    {
                    // belongsTo(相手のモデル名, 自モデルのID, 相手のID名)
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }

}

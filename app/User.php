<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * userテーブル用クラス
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 新規登録できるカラム設定
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'self_introduction', 'sex', 'img_name'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Reactionテーブルとのリレーションを設定
     * to_user_idカラム いいねされた人
     * 
     * 主キー: User
     * 外部キー: Reaction
     */
    public function toUserId()
    {
                    // hasMany(相手のモデル名, 相手モデルのID, 自モデルのID)
        return $this->hasMany('App\Reaction', 'to_user_id', 'id');
    }


    /**
     * Reactionテーブルとのリレーションを設定
     * from_user_idカラム いいねした人(ログインしているユーザー)
     * 
     * 主キー: User
     * 外部キー: Reaction
     */
    public function fromUserId()
    {
                    // hasMany(相手のモデル名, 相手モデルのID, 自モデルのID)
        return $this->hasMany('App\Reaction', 'from_user_id', 'id');
    }
}

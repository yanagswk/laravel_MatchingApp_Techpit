<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

/**
 * プロフィール情報 リクエストクラス
 */
class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザーがデータを更新するための権限を持っているかどうかを確認
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * ユニークなメールアドレスがすでに登録されている状態のため、
     * 自分のメールアドレスはチェック対象外する
     *
     * @return array
     */
    public function rules()
    {   
        // ログイン済みユーザーのメールアドレス取得
        $myEmail = Auth::user()->email;

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 
                        'string', 
                        'email', 
                        'max:255', 
                        // Rule::uniqueでユーザー情報のメールアドレスがユニークであるか確認
                        Rule::unique('users', 'email')->whereNot('email', $myEmail)] // whereNotでログイン済みユーザーのメールアドレスは除外
        ];
    }
}

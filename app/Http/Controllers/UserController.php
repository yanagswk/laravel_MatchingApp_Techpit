<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;       // プロフィール用のリクエストクラス
use App\User;                               // ユーザー用のクラス
use Intervention\Image\Facades\Image;       // 画像用のクラス

use App\Services\CheckExtensionServices;    // 拡張子エンコードサービス
use App\Services\FileUploadServices;        // ファイル名分割サービス


class UserController extends Controller
{
    /**
     * userごとのプロフィール画面表示
     * @method get
     * @param int $id ユーザーid
     */
    public function show($id)
    {   
        // ユーザー情報取得
        $user = User::findorFail($id);
        return view('users.show', compact('user'));
    }


    /**
     * userごとの編集画面表示
     * @method get
     * @param int $id ユーザーid
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('users.edit', compact('user'));
    }


    /**
     * プロフィール編集処理
     * @method post
     * @param App\Http\Requests\ProfileRequest $request users.editからpostで取得
     * @param int $id ユーザーid
     * @return redirect: home
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = User::findorFail($id);

        // 画像がアップロードされているか判定
        if (!is_null($request['img_namne'])) {
            $imageFile = $request['img_namne'];
            // ファイル名分割
            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;
            // 拡張子エンコード
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            //画像アップロード(Imageクラス makeメソッドを使用)
            $image->Image::make($data_url);
            $image->resize(400, 400)->save(storage_path() . '/app/public/images/' . $fileNameToStore);
            
            $user->img_name = $fileNameToStore;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->self_introduction = $request->self_introduction;

        $user->save();

        return redirect('home');
    }
}

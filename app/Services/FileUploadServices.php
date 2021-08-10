<?php

namespace App\Services;

/**
 * ファイルアップロード用クラス
 * // 画像ファイル名が被らないように、時間を入れてユニークなファイル名を生成
 */
class FileUploadServices
{
    // ファイルアップロード用にファイル名を分割
    public static function fileUpload($imageFile){
        // ファイル名取得
        $fileNameWithExt = $imageFile->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //拡張子取得
        $extension = $imageFile->getClientOriginalExtension();
        // ユニークなファイル名を生成
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        $fileData = file_get_contents($imageFile->getRealPath());
        $list = [$extension, $fileNameToStore, $fileData];
        return $list;
    }
}


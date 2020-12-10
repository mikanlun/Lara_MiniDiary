<?php

namespace App\Library;

use Illuminate\Http\Request;

class FunctionClass
{

    /**
     * Display the specified resource.
     *
     * @return backdate, backuserid
     */
    public static function getBackdateAndBackUserId()
    {
        // 戻り時の表示日付を取得
        if (session()->exists('nowDate')) {
            $backDate = session('nowDate');

        } else {
            $backDate = date('Y-m-d');
        }

        // 戻り時の表示ユーザーIDを取得
        if (session()->exists('searchUserId')) {
            $backUserId = session('searchUserId');

        } else {
            $backUserId = 0;
        }

        return ['backDate' => $backDate, 'backUserId' => $backUserId];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;

class Diary extends Model
{
    protected $guarded = ['id'];


    /**
     * バリデーション
     *
     * ルール
     */

    // 登録用のルール
    public static $rulesStore = [
        'title' => ['required', 'string', 'max:20'],
        'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'comment' => ['required', 'string', 'max:255'],
        'release_date' => ['required', 'date', 'after_or_equal:today'],
    ];

    // 更新用のルール
    public static $rulesUpdate = [
        'title' => ['required', 'string', 'max:20'],
        'image' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'comment' => ['required', 'string', 'max:255'],
        'release_date' => ['required', 'date'],
    ];


    /**
     * リレーション
     *
     * User has many Diaries
     */

     public function user()
     {
         return $this->belongsTo('App\User');
     }


    /**
    * ダイアリー情報取得
    *
    * @return ダイアリー情報
    */
    static public function  getDiariesWithMessage($nowDate, $searchUserId)
    {
        $user = null;
        $caption = null;
        $comment =  null;
        $btn_label =  null;
        $register_url =  null;
        $RegisteredFlg = null;
        $searchUsers = [];

        $sql = "";
        // 認可中のユーザーか
        if (Auth::check()) {
            // 認可中のユーザーのダイアリー
            $user = Auth::user();
            $diaries = self::where('user_id', $user->id)->where('release_date', $nowDate)->orderBy('updated_at', 'desc')->get();
            if (count($diaries)) {
                // 表示日付の認可中のユーザーのダイアリーは登録済み
                $RegisteredFlg = true;

            } else {
                // 表示日付の認証済みのユーザーのダイアリーは未登録
                $caption =  __('messages.wwllcome.caption');
                $comment =  $user->name . __('messages.wwllcome.comment');
                $btn_label = __('messages.btn_label.diaryRegister');
                $register_url = '/diary/create';
                $RegisteredFlg = false;
            }

            $searchUser['id'] = $user->id;
            $searchUser['name'] = $user->name;
            $searchUsers[] = $searchUser;

        } else {
            // 一般ユーザーのダイアリー
            if ($searchUserId == 0) {
                // ユーザー全員
                $diaries = self::where('release_date', $nowDate)->orderBy('updated_at', 'desc')->get();

            } else {
                // ユーザー指定
                $diaries = self::where('user_id', $searchUserId)->where('release_date', $nowDate)->orderBy('updated_at', 'desc')->get();
            }

            // 一般ユーザーのダイアリーは登録済みか
            $users = User::has('diaries')->get();
            if (count($users)) {
                // 一般ユーザーのダイアリーは登録済み
                foreach ($users as $user) {
                    $searchUser['id'] = $user->id;
                    $searchUser['name'] = $user->name;
                    $searchUsers[] = $searchUser;
                }
                $top['id'] = 0;
                $top['name'] = '全員';
                array_unshift($searchUsers, $top);

            } else {
                // 一般ユーザーのダイアリーは未登録
                $top['id'] = 0;
                $top['name'] = 'ユーザー未投稿';
                $searchUsers[] = $top;
            }

            if (count($diaries)) {
                // 表示日付の一般ユーザーのダイアリーは登録済み
                $RegisteredFlg = true;

            } else {
                // 表示日付の一般ユーザーのダイアリーは未登録
                $caption =  __('messages.unregister.caption');
                $comment =  __('messages.unregister.comment');
                $btn_label = __('messages.btn_label.userRegister');
                $register_url = '/register';
                $RegisteredFlg = false;
            }

        }

        return [
            'diaries' => $diaries,
            'user' => $user,
            'caption' => $caption,
            'comment' =>  $comment,
            'btn_label' => $btn_label,
            'register_url' =>  $register_url,
            'RegisteredFlg' => $RegisteredFlg,
            'searchUsers' => $searchUsers,
            'searchUserId' => $searchUserId,
            'nowDate' => $nowDate,
        ];
    }


    /**
    * 指定された日付を元にダイアリーが登録されいる直近の日付を調べる
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  mixed  $key, $changeDate
    * @return \Illuminate\Database\Eloquent\Builder
    */
    static public function scopeCheckDisplayDate($query, $key, $changeDate)
    {
        if ($key == 'prev') {
            // 表示日付より前
            $ope = '<=';
            $sort = 'desc';
        } else {
            // 表示日付より後
            $ope = '>=';
            $sort = 'asc';
        }

        // 認可中のユーザーか
        if (Auth::check()) {
            // 認可中のユーザーのダイアリー
            $user = Auth::user();
            return $query->where('user_id', $user->id)->where('release_date', $ope, $changeDate)->orderBy('release_date', $sort);

        } else {
            // 一般のユーザーのダイアリー
            return $query->where('release_date', $ope, $changeDate)->orderBy('release_date', $sort);

        }
    }
}

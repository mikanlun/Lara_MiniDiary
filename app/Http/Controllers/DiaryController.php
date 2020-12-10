<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

use App\Diary;
use App\User;

use App\Library\FunctionClass;

class DiaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->changeDate)) {
            // ダイアリーの表示日の変更
            $nowDate = $request->changeDate;
            if(Auth::check()) {
                $searchUserId = Auth::user()->id;
            } else {
                $searchUserId = 0;
            }

        } elseif (isset($request->searchDate) && isset($request->searchUserId)) {
            // ダイアリーの検索（ユーザーと表示日）
            $nowDate = $request->searchDate;
            $searchUserId = $request->searchUserId;

        } elseif (isset($request->backDate) && isset($request->backUserId)) {
            // トップページへの戻りボタンを押された時
            $nowDate = $request->backDate;
            $searchUserId = $request->backUserId;

        } else {
            // ダイアリーの表示日は今日
            $nowDate = date('Y-m-d');
            if(Auth::check()) {
                $searchUserId = Auth::user()->id;
            } else {
                $searchUserId = 0;
            }
        }

        // ダイアリーの表示日とユーザーIDを保存
        session(['nowDate' => $nowDate]);
        session(['searchUserId' => $searchUserId]);
        // 曜日一覧取得
        $nowWeek = config('diary.week')[date('w', strtotime($nowDate))];
        // 昨日・翌日の日付を取得
        $preDate = date("Y-m-d", strtotime("$nowDate-1 day"  ));
        $nextDate = date("Y-m-d", strtotime("$nowDate+1 day"  ));

        // ダイアリーを取得
        $diaries = Diary::getDiariesWithMessage($nowDate, $searchUserId);

        return view('diary.index', compact('nowDate', 'nowWeek', 'preDate', 'nextDate'), $diaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 公開日の初期値
        $release_date = date('Y-m-d');
        // 戻り時の表示日付と表示ユーザーIDを取得
        extract(FunctionClass::getBackdateAndBackUserId());

        return view('diary.create', compact('release_date', 'backDate', 'backUserId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator =Validator::make($request->all(), Diary::$rulesStore);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // ユーザー情報を取得
        $user_id = Auth::user()->id;
        // 画像パス生成
        $path = 'images' . sprintf('%04d', $user_id);

        // アップロードファイルの存在チェック
        $file_name = $request->file('image')->getClientOriginalName();
        if (Storage::disk('public')->exists($path . '/' . $file_name)) {
            $validator->errors()->add('image', $file_name . __('messages.file.exists'));

            return back()->withInput()->withErrors($validator);

        }

        // アップロードファイルを保存
        $request->file('image')->storeAs('public/' . $path . '/' ,$file_name);
        // ダイアリーを登録
        $form = $request->all();
        unset($form['_token']);
        $form['user_id'] = $user_id;
        $form['path'] = $path;
        $form['image'] = $file_name;
        // ダイアリーインスタンス生成
        $diary = new Diary;
        $diary->fill($form)->save();

        // ダイアリー表示日付は公開日
        $changeDate = $form['release_date'];

        return redirect("/diary?changeDate=$changeDate");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 戻り時の表示日付と表示ユーザーIDを取得
        extract(FunctionClass::getBackdateAndBackUserId());

        $diary = Diary::find($id);
        if (is_null($diary)) {
            // ダイアリーが無い時はトップページに戻る
            return redirect("/diary?backDate=$backDate&backUserId=$backUserId");
        }

        return view('diary.show', compact('diary', 'backDate', 'backUserId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diary = Diary::find($id);
        if (is_null($diary) || ($diary->user_id != Auth::user()->id)) {
            // ダイアリー無い時又は認可中のユーザーのダイアリーで無い時トップページに戻る
            // 戻り時の表示日付と表示ユーザーIDを取得
            extract(FunctionClass::getBackdateAndBackUserId());
            return redirect("/diary?backDate=$backDate&backUserId=$backUserId");
        }

        return view('diary.edit', compact('diary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator =Validator::make($request->all(), Diary::$rulesUpdate);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // ダイアリー情報を取得
        $diary = Diary::find($id);
        // ユーザー情報を取得
        $user_id = Auth::user()->id;
        // 画像パス取得
        $path = $diary->path;
        // 既存のアップロードファイル名を取得
        $now_image = $diary->image;

        // アップロードファイルを選択したか
        if (!is_null($request->file('image'))) {
            // アップロードファイルを選択
            // アップロードファイルの既存チェック
            $file_name = $request->file('image')->getClientOriginalName();
            if (Storage::disk('public')->exists($path . '/' . $file_name)) {
                $validator->errors()->add('image', $file_name .  __('messages.file.exists'));

                return back()->withInput()->withErrors($validator);

            }

            // 既存のアップロードファイルを削除
            if (Storage::disk('public')->exists($path . '/' . $now_image)) {
                Storage::delete('public/' . $path . "/" . $now_image);
            }

            // アップロードファイルを更新
            $request->file('image')->storeAs('public/' . $path . '/' ,$file_name);

        } else {
            // アップロードファイルを未選択
            $file_name = $now_image;
        }
        $form = $request->all();
        unset($form['_token']);
        $form['user_id'] = $user_id;
        $form['path'] = $path;
        $form['image'] = $file_name;
        $diary->fill($form)->save();

        // ダイアリー表示日付は公開日
        $changeDate = $form['release_date'];

        return redirect("/diary?changeDate=$changeDate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ダイアリー情報を取得
        $diary = Diary::find($id);
        // 画像パス取得
        $path = $diary->path;
        // 既存のアップロードファイル名を取得
        $now_image = $diary->image;
        // 既存のアップロードファイルを削除
        if (Storage::disk('public')->exists($path . '/' . $now_image)) {
            Storage::delete('public/' . $path . "/" . $now_image);
        }

        // ダイアリー情報を削除
        Diary::destroy($id);

        // 戻り時の表示日付と表示ユーザーIDを取得
        extract(FunctionClass::getBackdateAndBackUserId());

        return redirect("/diary?backDate=$backDate&backUserId=$backUserId");

    }

    /**
     * Get Calendar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCalendar(Request $request)
    {
        $changeMonth = $request->changeMonth;
        list($y, $m) = explode('-', $changeMonth);
        $preMonth = date('Y-m', strtotime($y .'-' . $m . ' -1 month'));
        $nextMonth = date('Y-m', strtotime($y .'-' . $m . ' +1 month'));

        // 当月にダイアリーが登録済みか調べる
        $fromRelease = date('Y-m-d', strtotime('first day of ' . $changeMonth));
        $toRelease = date('Y-m-d', strtotime('last day of ' . $changeMonth));
        // 認可中のユーザーか
        if (Auth::check()) {
            // 認可中のユーザーのダイアリー
            $user = Auth::user();
            $diaries = Diary::where('user_id', $user->id)->where('release_date', '>=', $fromRelease)->where('release_date', '<=', $toRelease)->orderBy('release_date', 'asc')->get();

        } else {
            // 一般ユーザー
            $diaries = Diary::where('release_date', '>=', $fromRelease)->where('release_date', '<=', $toRelease)->orderBy('release_date', 'asc')->get();
        }

        // 登録されいるダイアリー情報を日付毎にまとめる
        $displayDates = [];
        foreach ($diaries as $diary) {
            list($y, $m, $d) = explode('-', $diary->release_date);
            $displayDay = sprintf('%d', $d);    // 01 -> 1
            $displayDates[$displayDay] = $diary->release_date;
        }
        // カレンダーレンダリング
        $returnHTML = view('diary.calendar')->with(compact('y', 'm', 'preMonth', 'nextMonth', 'displayDates'))->render();
        return response()->json( ['html'=> $returnHTML] );

    }

    /**
     * Get DisplayDate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDisplayDate(Request $request)
    {
        // 過去・未来のフラグ
        $key = $request->key;
        // 指定された日付
        $changeDate = $request->changeDate;

        // 指定された日付を元にダイアリーが登録されいる直近の日付を調べる
        $existedDiary = Diary::checkDisplayDate($key, $changeDate)->first();
        if ($existedDiary) {

            $displayDate = $existedDiary->release_date;

        } else {

            $displayDate = false;
        }

        return response()->json(['displayDate'=> $displayDate] );

    }

    /**
     * Search Diary
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchDiary(Request $request)
    {
        // 過去・未来のフラグ
        $searchUserId = $request->searchUserId;
        // 指定された日付
        $searchDate = $request->searchDate;

        return redirect('/diary?searchUserId=' . $searchUserId . '&searchDate=' . $searchDate);

    }
}

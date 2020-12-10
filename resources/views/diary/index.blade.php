@extends('layouts.diary')

@section('title', __('messages.label.welcome'))

@section('content')
<div class="border-top border-bottom border-dark mb-3 rounded bg-light form-inline">
    <div class="ml-3">
        <div class="slide my-3">
            <a class="prev mx-3" data-change="{{ $preDate }}" data-now="{{ $nowDate }}"></a>
            <h3 class="headerDate">{{ $nowDate }} ({{ $nowWeek }})</h3>
            <a class="next mx-3" data-change="{{ $nextDate }}" data-now="{{ $nowDate }}"></a>
        </div>
        <div class="form-group ml-3 mb-3 py-1 border border-primary rounded bg-white" id="datepicker-default">
            <form action="/diary/searchdiary" method="post">
                <div class="form-inline">
                    <select name="searchUserId" class="form-control mx-3" id="searchUserId">
                    {{-- 検索ユーザー一覧 --}}
                    @foreach ($searchUsers as  $searchUser)
                        <option value="{{ $searchUser['id'] }}" {{ $searchUser['id'] == $searchUserId ? ' selected' : '' }}>{{ $searchUser['name'] }}</option>
                    @endforeach
                    </select>
                    {{-- 検索日付 --}}
                    <div class="input-group date">
                        <input type="text" name="searchDate" class="form-control form-control-sm rounded" value="{{ $nowDate }}" readonly>
                        <div class="input-group-addon mt-4 ml-2">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mx-3" role="button">{{ __('messages.btn_label.search') }}</button>
                </div>

                {{-- CSRF対策 --}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <div class="m-5">
        <a class="btn btn-info btn-sm" href="/" role="button">{{ __('messages.btn_label.backToday') }}</a>
    </div>
    {{-- カレンダー --}}
    <div id="calender" class="m-3">
    </div>
</div>
<div class="usersDiary p-2 clearfix">
    @if ($RegisteredFlg === false)
        {{-- ユーザーのダイアリーは未登録 --}}

        @include('diary/index_unregister')

    @else
        {{-- ユーザーのダイアリーは登録済み --}}

        @foreach($diaries as $diary)

            @include('diary/index_registered')

        @endforeach
    @endif
</div>
@endsection

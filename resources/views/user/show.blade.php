@extends('layouts.diary')

@section('title', __('messages.label.account'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('編集') }}</div>

                <div class="card-body">
                    <form method="">
                        <fieldset disabled>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="非表示">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('プロフィール') }}</label>

                            <div class="col-md-6">
                                <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="new-profile">{{ $user->profile }}</textarea>

                                @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </fieldset>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <a class="btn btn-primary btn-mg mr-3" href="/user/{{ $user->id }}/edit" role="button">{{ __('messages.btn_label.edit') }}</a>
                                <a class="btn btn-warning btn-mg mr-3" href="/diary?backDate={{ $backDate }}&backUserId={{ $backUserId }}" role="button">{{ __('messages.btn_label.back') }}</a>
                                <a class="btn btn-danger btn-mg" id="delete_account" data-user_name="{{ $user->name }}" role="button">{{ __('messages.btn_label.resign') }}</a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- 退会 --}}
                <form action="/user/{{ $user->id }}" method="post" id="delete_resign">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

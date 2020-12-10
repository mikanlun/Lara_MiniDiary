@extends('layouts.diary')

@section('title', __('messages.label.editAccount'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('編集') }}</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{ $user->id }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-7">
                                <small class="text-muted">( 30文字以内)</small><br>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-7">
                                <small class="text-muted">( 8文字以上)</small><br>
                                <small class="text-muted">(未入力の時は登録済のパスワードを流用)</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード(確認)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('プロフィール') }}</label>

                            <div class="col-md-6">
                                <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="new-profile">{{ old('profile', $user->profile) }}</textarea>

                                @error('profile')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.btn_label.update') }}
                                </button>
                                <a class="btn btn-warning btn-mg mr-3" href="/user/{{ $user->id }}" role="button">{{ __('messages.btn_label.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

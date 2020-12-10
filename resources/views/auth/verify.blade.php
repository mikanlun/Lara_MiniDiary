@extends('layouts.gallery')

@section('title', __('messages.label.veverifyMailaddress1'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.label.veverifyMailaddress2') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('メールが送信されました。') }}
                        </div>
                    @endif

                    {{ __('メールを送信しました。メールからメールアドレスの認証をお願いします。') }}
                    {{ __('メールが届いていない場合は、') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('messages.btn_label.click') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.diary')

@section('title', 'お問い合わせ')

@section('content')

<section class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">お問い合わせ</div>
        <div class="card-body text-dark mx-3">

            <form action="/support/contact" method="post">
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label bg-info text-white rounded">氏名</label>
                    <div class="col-md-9">
                        <input type="text" name="name"  value="{{ old('name', $name) }}" autofocus class="form-control col-md-5 @error('name') is-invalid @enderror" id="name">
                        <small class="text-muted">( 30文字以内)</small><br>

                        @error('name')
                            <span class="invalid-feedback bg-warning" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label bg-info text-white rounded">メールアドレス</label>
                    <div class="form-row col-md-9">
                        <div class="col-md-5">
                            <input type="text" name="email"  value="{{ old('email', $email) }}" class="form-control @error('email') is-invalid @enderror" id="email">

                            @error('email')
                                <span class="invalid-feedback bg-warning" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="email_confirmation"  value="{{ old('email_confirmation', $email) }}" class="form-control" id="email_confirmation">
                            <small class="text-muted">(確認)</small>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contact" class="col-md-3 col-form-label bg-info text-white rounded">お問い合わせ内容</label>
                    <div class="col-md-9">
                        <textarea name="contact" class="form-control ccol-md-9 @error('contact') is-invalid @enderror" id="contact" row="3">{{ old('contact', $contact) }}</textarea>

                        @error('contact')
                            <span class="invalid-feedback bg-warning" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <a class="btn btn-success btn-lg mr-3" href="/diary?backDate={{ $backDate }}&backUserId={{ $backUserId }}" role="button">{{ __('messages.btn_label.rootRedirect') }}</a>
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.btn_label.confirm') }}</button>
                    </div>
                </div>

               {{-- CSRF対策 --}}
                {{ csrf_field() }}

            </form>
        </div><!-- .card-body -->
    </div><!-- .card -->
</section>

@endsection

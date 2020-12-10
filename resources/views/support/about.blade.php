@extends('layouts.diary')

@section('title', __('messages.about.caption'))

@section('content')

<section  class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">{{ __('messages.about.caption') }}</div>
        <div class="card-body text-dark">
            <p class="text-left">{!! nl2br(__('messages.about.comment1')) !!}</p>
        </div><!-- .card-body -->
        @if(!Auth::check())
            <div class="card-footer border-light">
                <p class="text-left">{!! nl2br(__('messages.about.comment2')) !!}</p>
                        <a class="btn btn-primary btn-lg" href="/register" role="button">新規登録</a>
            </div>
        @endif
    </div><!-- .card -->
    <div class="form-group row">
        <div class="col-sm-12 text-center">
            <a class="btn btn-success btn-lg mr-3" href="/diary?backDate={{ $backDate }}&backUserId={{ $backUserId }}" role="button">{{ __('messages.btn_label.rootRedirect') }}</a>
        </div>
    </div>
</section>

@endsection

@extends('layouts.diary')

@section('title', __('messages.label.profile'))

@section('content')

<section  class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">
            <div class="float-left">プロフィール</div>
            <div class="text-info float-right">{{ $user->name }}</div>
        </div>
        <div class="card-body text-dark">
            <p class="text-left">{!! nl2br(e($user->profile)) !!}</p>
        </div><!-- .card-body -->
    </div><!-- .card -->
    <div class="form-group row">
        <div class="col-sm-12 text-center">
            <a class="btn btn-warning btn-lg mr-3" href="{{ $backUrl }}" role="button">{{ __('messages.btn_label.back') }}</a>
        </div>
    </div>
</section>
@endsection

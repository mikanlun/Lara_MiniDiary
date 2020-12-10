@extends('layouts.diary')

@section('title', __('messages.label.resign'))

@section('content')
<section  class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">退会</div>
        <div class="card-body text-dark">
            <p class="text-left">{{ __('messages.resign.msg01') }}{{ $user_name }}{{ __('messages.resign.msg02') }}</p>
        </div><!-- .card-body -->
        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <a class="btn btn-success btn-lg mr-3" href="/" role="button">{{ __('messages.btn_label.rootRedirect') }}</a>
            </div>
        </div>
    </div><!-- .card -->
</section>
@endsection

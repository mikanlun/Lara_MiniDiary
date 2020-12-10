@extends('layouts.diary')

@section('title', __('messages.label.registerDiary'))

@section('content')
<section class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">{{ __('messages.label.registerDiary') }}</div>
        <div class="card-body text-dark mx-3">

            <form action="/diary" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label bg-info text-white rounded">タイトル</label>
                    <div class="col-sm-10">
                        <input type="text" name="title"  value="{{ old('title') }}" autofocus class="form-control col-sm-10 @error('title') is-invalid @enderror" id="title">
                        <small class="text-muted">(20桁以下)</small>

                        @error('title')
                            <span class="invalid-feedback bg-warning" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label bg-info text-white rounded">画像</label>
                    <div class="col-sm-10">
                       <input type="file" name="image"  class="form-control-file @error('image') is-invalid @enderror" id="image">
                       <small class="text-muted">(GIF, PNG, JPEG, JPG) 2MB以下</small>

                       @error('image')
                           <span class="invalid-feedback bg-warning" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label bg-info text-white rounded">コメント</label>
                    <div class="col-sm-10">
                        <textarea name="comment" class="form-control ccol-sm-10 @error('comment') is-invalid @enderror" id="comment" row="3">{{ old('comment') }}</textarea>

                        @error('comment')
                        <span class="invalid-feedback bg-warning" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row"  id="datepicker-default">
                    <label for="comment" class="col-sm-2 col-form-label bg-info text-white rounded">公開日</label>
                    <div class="input-group date col-sm-5">
                        <input type="text" name="release_date" class="form-control form-control-sm rounded col-sm-7 @error('release_date') is-invalid @enderror" value="{{ old('release_date', $release_date) }}" readonly>
                        <div class="input-group-addon mt-4 ml-2">
                            <i class="fa fa-calendar"></i>
                        </div>

                        @error('release_date')
                        <span class="invalid-feedback bg-warning" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-warning btn-lg mr-3" href="/diary?backDate={{ $backDate }}&backUserId={{ $backUserId }}">{{ __('messages.btn_label.back') }}</a>
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.btn_label.register') }}</button>
                    </div>
                </div>

               {{-- CSRF対策 --}}
               {{ csrf_field() }}

            </form>
        </div><!-- .card-body -->
    </div><!-- .card -->
</section>
@endsection

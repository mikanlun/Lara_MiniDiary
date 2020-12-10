@extends('layouts.diary')

@section('title', __('messages.label.editDiary'))

@section('content')

<section class="container-fluid">
    <div class="card  border border-dark mb-3">
        <div class="card-header font-weight-bold">{{ __('messages.label.editDiary') }}</div>
        <div class="card-body text-dark mx-3">

            <form action="/diary/{{ $diary->id }}" method="post" enctype="multipart/form-data">
                {{ method_field('put') }}

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label bg-info text-white rounded">タイトル</label>
                    <div class="col-sm-10">
                        <input type="text" name="title"  value="{{ old('title', $diary->title) }}" autofocus class="form-control @error('title') is-invalid @enderror" id="title">
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
                       <small class="text-muted">（未選択の時は登録済の画像を流用）</small>

                      @error('image')
                          <span class="invalid-feedback bg-warning" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                   <label class="text-muted">[ 登録済みの画像名 : {{ $diary->image }} ]</label>
                        <img class="card-img-bottom"
                              src="/storage/{{ $diary->path }}/{{ $diary->image }}"
                              alt="{{ $diary->image }}">
                </div>
                <div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label bg-info text-white rounded">コメント</label>
                    <div class="col-sm-10">
                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" row="3">{{ old('comment', $diary->comment) }}</textarea>

                       @error('comment')
                           <span class="invalid-feedback bg-warning" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                    </div>
                </div>
                <div class="form-group row"  id="datepicker-default">
                    <label for="comment" class="col-sm-2 col-form-label bg-info text-white rounded">公開日</label>
                    <div class="input-group date col-sm-3">
                        <input type="text" name="release_date" class="form-control form-control-sm rounded" value="{{ old('release_date', $diary->release_date) }}" readonly>
                        <div class="input-group-addon mt-4 ml-2">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-warning btn-lg mr-3" href="/diary/{{ $diary->id }}" role="button">{{ __('messages.btn_label.back') }}</a>
                        <button type="submit" class="btn btn-primary btn-lg mr-3">{{ __('messages.btn_label.update') }}</button>
                        <a class="btn btn-danger btn-lg" id="delete_image" role="button">{{ __('messages.btn_label.delete') }}</a>
                    </div>
                </div>

               {{-- CSRF対策 --}}
               {{ csrf_field() }}

            </form>

            {{-- アルバム削除 --}}
            <form action="/diary/{{ $diary->id }}" method="post" id="delete_submit">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            </form>

        </div><!-- .card-body -->
    </div><!-- .card -->
</section>

@endsection

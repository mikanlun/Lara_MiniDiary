@extends('layouts.diary')

@section('title', __('messages.label.showDiary'))

@section('content')
<section class="container-fluid">
        <div class="card  border border-dark mb-3">
            <div class="card-header font-weight-bold">ダイアリー : {{ Session('nowDate') }}</div>
            <div class="card-body text-dark mx-3">
                    <div class="userDiary m-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><small>Image</small></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment" role="tab" aria-controls="comment" aria-selected="false"><small>Comment</small></a>
                              </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card">
                                    <img class="card-img-top" src="/storage/{{ $diary->path }}/{{ $diary->image }}" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text"><h5>{{ $diary->title }}</h5></p>
                                        <small class="text-muted float-right">({{ $diary->updated_at }})</small>
                                    </div>
                                    <div class="card-footer text-muted">
                                      {{ $diary->user->name }}
                                        <a class="btn btn-info btn-sm ml-3 float-right" href="/profile/{{ $diary->user_id }}?diary_id={{ $diary->id }}" role="button">プロフィール</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                              <div class="card">
                                  <div class="card-body">
                                      <p class="card-text">{!! nl2br(e($diary->comment)) !!}</p>
                                  </div>
                                  <div class="card-footer text-muted">
                                      {{ $diary->user->name }}
                                  </div>

                              </div>
                            </div>
                        </div>
                    </div>

            </div><!-- .card-body -->
            <div class="card-footer text-muted">
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <a class="btn btn-warning btn-lg mr-3" href="/diary?backDate={{ $backDate }}&backUserId={{ $backUserId }}" role="button">{{ __('messages.btn_label.back') }}</a>
                        @if(Auth::check() && (Auth::user()->id == $diary->user_id))
                            <a class="btn btn-primary btn-lg mr-3" href="/diary/{{ $diary->id }}/edit" role="button">{{ __('messages.btn_label.edit') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- .card -->

</section>
@endsection

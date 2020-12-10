                <div class="userDiary m-2 float-left">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-{{ $diary->id }}" role="tab" aria-controls="home" aria-selected="true"><small>Image</small></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment-{{ $diary->id }}" role="tab" aria-controls="comment" aria-selected="false"><small>Comment</small></a>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-{{ $diary->id }}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card">
                                <a href="/diary/{{  $diary->id }}">
                                    <img class="card-img-top" src="/storage/{{ $diary->path }}/{{ $diary->image }}" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <p class="card-text"><h5>{{ $diary->title }}</h5></p>
                                    <small class="text-muted float-right">({{ $diary->updated_at }})</small>
                                </div>
                                <div class="card-footer text-muted">
                                  {{ $diary->user->name }}
                                    <a class="btn btn-info btn-sm ml-3 float-right" href="/profile/{{ $diary->user_id }}" role="button">プロフィール</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="comment-{{ $diary->id }}" role="tabpanel" aria-labelledby="comment-tab">
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

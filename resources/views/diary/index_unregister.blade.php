
            <div class="unregister">
                <div class="card border-light mb-3">
                    <div class="card-header border-light card-title">
                        <h5>{{ $caption }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! nl2br(e($comment)) !!}</p>
                    </div>
                    <div class="card-footer border-light">
                        <div class="form-group">
                            <div class="text-center">
                                <a class="btn btn-primary btn-lg" href="{{ $register_url }}" role="button">{{ $btn_label }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

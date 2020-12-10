<nav class="navbar navbar-light bg-light border border-dark my-3 rounded fixedmenu">
    <a class="navbar-brand" href="/">
        <img src="/asset/brand.svg" width="30" height="30" class="d-inline-block align-top" alt="{{ config('app.name') }}"> {{ config('app.name') }}</a>
    <ul class="nav justify-content-end">
        @if(Auth::check())
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/diary/create">アルバム登録</a>
                    <a class="dropdown-item" href="/user/{{ Auth::user()->id }}">アカウント</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('ログアウト') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="/login">ログイン</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">新規登録</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="/support/about">{{ config('app.name') }} ?</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/support/contact">お問い合わせ</a>
        </li>
    </ul>
</nav>

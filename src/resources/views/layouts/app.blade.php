<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/reset/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="https://kit.fontawesome.com/37622b1137.js" crossorigin="anonymous"></script>
    @yield('css')
</head>

@livewireScripts

<body>
    <header class="header">
        <div class="header__inner">
            <div class="nav">
                <input class="drawer__hidden" id="drawer__input" type="checkbox">
                <label class="drawer__open" for="drawer__input"><span></span></label>
                <nav class="nav__content">
                    <ul class="nav__list">
                        <li class="nav__item">
                            @if (Auth::check() && Auth::user()->hasVerifiedEmail())
                                <a class="nav__item--href" href="{{ route('shop.all.private') }}">Home</a>
                            @else
                                <a class="nav__item--href" href="{{ route('shop.all') }}">Home</a>
                            @endif
                        </li>
                        @if (Auth::check() && Auth::user()->hasVerifiedEmail())
                            <li class="nav__item">
                                <form class="nav__item--logout" action="/logout" method="post">
                                    @csrf
                                    <button class="logout__btn">Logout</button>
                                </form>
                            </li>
                            <li class="nav__item"><a class="nav__item--href" href="{{ route('mypage') }}">Mypage</a>
                            </li>
                            @if (Auth::user()->hasRole('店舗代表者'))
                                <li class="nav__item"><a class="nav__item--href"
                                        href="{{ route('reservation.confirmation') }}">Reservation</a>
                                </li>
                                <li class="nav__item"><a class="nav__item--href"
                                        href="{{ route('create.shop.manager') }}">CreateShop</a>
                                </li>
                                <li class="nav__item"><a class="nav__item--href"
                                        href="{{ route('shop.list') }}">EditShop</a>
                                </li>
                                <li class="nav__item"><a class="nav__item--href"
                                        href="{{ route('send.mail') }}">SendMail</a>
                                </li>
                            @endif
                            @if (Auth::user()->hasRole('管理者'))
                                <li class="nav__item"><a class="nav__item--href"
                                        href="{{ route('admin.index') }}">Admin</a></li>
                            @endif
                        @else
                            <li class="nav__item"><a class="nav__item--href"
                                    href="{{ route('register') }}">Registration</a></li>
                            <li class="nav__item"><a class="nav__item--href" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <h1 class="header__title">Rese</h1>
        </div>
        @yield('link')
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>

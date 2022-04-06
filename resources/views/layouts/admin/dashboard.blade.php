<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>


<body>



    <header class="page-header">
        <nav class="d-flex justify-content-between overflow-hidden">
            {{-- <a href="#0" aria-label="forecastr logo" class="logo">
        <svg width="140" height="49">
          <use xlink:href="#logo"></use>
        </svg>
      </a> --}}
            <div class=" logo-container d-flex justify-content-center align-items-center d-md-flex d-none">
                <img class="" src="{{ asset('/storage/default_images/my-deliveboo.gif') }}"
                    alt="DeliveBoo Logo">
            </div>

            <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
                <i class="burger-menu fa-solid fa-bars"></i>
            </button>
            <div class="mobile-logo-container d-md-none">
                <img class="mobile-logo" src="{{ asset('/storage/default_images/my-deliveboo.gif') }}"
                    alt="DeliveBoo Logo">
            </div>
            <ul class="admin-menu">
                <li class="menu-heading">
                    <h3>Dashboard</h3>
                </li>
                <li>
                    <a class="{{ 'admin.home' === Route::currentRouteName() ? 'selected-link' : '' }}"
                        href="{{ route('admin.home') }}">
                        <i class="fa-solid fa-chart-column"></i>
                        <span>Statistiche</span>
                    </a>

                </li>
                <li>
                    <a class="{{ 'admin.orders.index' === Route::currentRouteName() ? 'selected-link' : '' }}"
                        href="{{ route('admin.orders.index') }}">

                        <i class="fa-solid fa-list"></i>
                        <span>Lista Ordini</span>
                    </a>
                </li>
                <li>
                    <a class="{{ 'admin.dishes.index' === Route::currentRouteName() ? 'selected-link' : '' }}"
                        href="{{ route('admin.dishes.index') }}">

                        <i class="fa-solid fa-utensils"></i>
                        <span>Lista Piatti</span>
                    </a>
                </li>
                <li>
                    <a class="{{ 'admin.dishes.create' === Route::currentRouteName() ? 'selected-link' : '' }}"
                        href="{{ route('admin.dishes.create') }}">

                        <i class="fa-solid fa-plus"></i>
                        <span>Crea Piatto</span>
                    </a>
                </li>
                <li>
                    <a class="logout-a ms-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        {{-- {{ __('Logout') }} --}}
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <button class="collapse-btn" aria-expanded="true" aria-label="collapse menu">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span>Collapse</span>
                    </button>
                    <div class="switch">
                        <input type="checkbox" id="mode" checked>
                        <label for="mode">
                            <span></span>
                            <span>Dark</span>
                        </label>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <section class="page-content">

        <section class="container">
            <div>{{ Auth::user()->restaurant_name }}</div>
            <article class="row">
                <div class="col"> @yield('content') </div>
            </article>
        </section>

    </section>
</body>

</html>

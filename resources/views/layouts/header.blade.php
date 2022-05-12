<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <div class="container">
        {{-- <span class="navbar-brand mb-0 h1" href="/">Alaska/span> --}}
        <a class="navbar-brand p-0" href="/"">
            <img src=" {{ asset('img/logo.png') }}" alt="Karya Jasa" width="50" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-start align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link @yield('menuHome')" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('menuProduct')" href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('menuPopularity')" href="/popularity">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('menuCategory')" href="/category">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('menuAbout')" href="/about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-start align-items-lg-center">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    {{-- <a class="nav-link" href="#">{{ __('Login') }}</a> --}}
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    {{-- <a class="nav-link" href="#">{{ __('Register') }}</a> --}}
                </li>
                @endif
                @else

                @php
                if (Auth::check()) {
                $notifications = Auth::user()->unreadNotifications->take(3);
                }
                @endphp

                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="notif-icon nav-link" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false" v-pre>
                        <i class="bi bi-bell-fill"></i>
                        @if (count($notifications) > 0)
                        <div class="notif-text"></div>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow-sm" style="border-radius: 10px"
                        aria-labelledby="navbarDropdown">
                        @forelse($notifications as $notification)

                        <div class="py-2 dropdown-item">
                            <p style="margin: 0; font-size: 12px">
                                {{ \Carbon\Carbon::parse($notification->created_at)->format('d F Y h:i')  }}</p>
                            <a class="text-header mark-as-read" href="#" data-id="{{ $notification->id }}"
                                data-navigate="{{$notification->data['navigate']}}">
                                {{ $notification->data['message'] }}
                            </a>
                        </div>

                        {{-- @if($loop->last)
                        <a href="{{ route('user.notification') }}" class="text-end dropdown-item"
                        style="font-size: 12px">
                        View all notifications <i class="ms-1 bi bi-arrow-right"></i>
                        </a>
                        @endif --}}

                        @empty
                        <div class="py-2 dropdown-item">
                            <p class="text-center mb-2"><i class="bi bi-info-circle"></i></p>
                            <p class="text-header mb-0">
                                Tidak ada notifikasi baru</p>
                            </a>
                        </div>
                        @endforelse
                        <a href="{{ route('user.notification') }}" class="text-end dropdown-item"
                            style="font-size: 12px">
                            View all notifications <i class="ms-1 bi bi-arrow-right"></i>
                        </a>

                    </div>
                </li>
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link  dropdown-toggle d-none d-lg-block" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                        <img src="{{ asset('img/profile/'.(Auth::user()->photo_profile ?? 'default_profile.png')) }}"
                            alt=""
                            style="height: 30px; width: 30px; border-radius: 100px; object-fit: cover; object-position: center; background-color: lightgray">
                        <span class="ms-2">{{ Auth::user()->name }}</span>
                    </a>

                    <a id="navbarDropdown" class="text-header nav-link dropdown-toggle d-lg-none" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow-sm" style="border-radius: 10px"
                        aria-labelledby="navbarDropdown">

                        <a class="text-header dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-circle me-3" style="color: #F38630"></i>{{ __('Profile') }}
                        </a>

                        @if (Auth::user()->user_type == "Seller")
                        <a href="{{ route('myStore.index') }}" class="text-header dropdown-item">
                            <i class="bi bi-shop me-3" style="color: #F38630"></i>My Store
                        </a>
                        @else
                        <a href="{{ route('seller.registration') }}" class="text-header dropdown-item"
                            style="color: #F38630">
                            <i class="bi bi-arrow-up-circle me-3" style="color: #F38630"></i><b>Become a Seller</b>
                        </a>
                        @endif

                        <a class="text-header dropdown-item" href="{{ route('order.index') }}">
                            <i class="bi bi-clipboard me-3" style="color: #F38630"></i>My Order
                        </a>

                        <a class="text-header dropdown-item" href="{{ route('user.history') }}">
                            <i class="bi bi-clock-history me-3" style="color: #F38630"></i>Transaction History
                        </a>

                        <a class="text-header dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left me-3" style="color: #F38630"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
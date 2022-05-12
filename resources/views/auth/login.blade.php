<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <title>Sign In</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div style="border-radius: 15px" class="card def-shadow p-4">

                    <div class="card-body">

                        <h2 class="text-center" style="color: #f4473e">Sign In</h2>
                        <p class="text-center text-muted mb-4">Welcome to Alaska!</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="mb-3 d-flex">
                                <div class="py-2 pe-1 me-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                @if (Route::has('password.request'))
                                <a style="text-decoration: none" class="btn btn-link px-0 py-2 text-end"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>

                            <div class="d-grid gap-1 mt-4 justify-content-center">
                                <button type="submit" class="btn def-button py-2">
                                    {{ __('Login') }}
                                </button>

                                <a style="text-decoration: none; text-align: center; margin-top: 10px"
                                    href="{{ route('register') }}">
                                    Don't Have an Account? Sign Up here!
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
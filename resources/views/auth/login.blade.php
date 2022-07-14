<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>eShop - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('frontend/css/login/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 pt-4 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row"> <a href="{{ route('user.dashboard') }}"><img
                                    src="{{ asset('frontend/images/logo.png') }}" class="logo"></a></div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHK-xjw_9xvJNuMpHNRtt9vG9ei4j1SKVDfQ&usqp=CAU"
                                class="image"> </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
                            <div class="facebook text-center mr-3">
                                <div class="fa fa-facebook"></div>
                            </div>
                            <div class="twitter text-center mr-3">
                                <div class="fa fa-twitter"></div>
                            </div>
                            <div class="linkedin text-center mr-3">
                                <div class="fa fa-linkedin"></div>
                            </div>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div> <small class="or text-center">Or</small>
                            <div class="line"></div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row px-3">
                                <label for="email" class="mb-1">
                                    <h6 class="mb-0 text-sm">Email Address</h6>
                                </label>
                                <input id="email" class="mb-4 @error('email') is-invalid @enderror" type="email"
                                    name="email" placeholder="Enter a valid email address" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>
                                @error('email')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row px-3">
                                <label for="password" class="mb-1">
                                    <h6 class="mb-0 text-sm">Password</h6>
                                </label>
                                <input id="password" type="password" name="password"
                                    class="@error('password') is-invalid @enderror" placeholder="Enter password"
                                    required autocomplete="current-password">
                                @error('password')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline"> <input
                                        type="checkbox" class="custom-control-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}> <label for="remember"
                                        class="custom-control-label text-sm">Remember me</label> </div>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="ml-auto mb-0 text-sm">Forgot
                                    Password?</a>
                                @endif
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit"
                                    class="btn btn-blue text-center">Login</button> </div>
                        </form>
                        <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a href="{{ route('register') }}" class="text-danger ">Register</a></small> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>

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
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-4 mx-auto">
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
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row px-3">
                                <label for="name" class="mb-1">
                                    <h6 class="mb-0 mr-1 text-sm">Name </h6>
                                </label>
                                @error('name')
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color: red">{{ $message }}</h6>
                                </label>
                                @enderror
                                <input id="name" class="mb-4 @error('name') is-invalid @enderror" type="text"
                                    name="name" placeholder="Enter Your Name" value="{{ old('name') }}"
                                    autocomplete="name" autofocus>
                            </div>
                            <div class="row px-3">
                                <label for="email" class="mb-1">
                                    <h6 class="mb-0 mr-1 text-sm">Email Address </h6>
                                </label>
                                @error('email')
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color: red">{{ $message }}</h6>
                                </label>
                                @enderror
                                <input id="email" class="mb-4 @error('email') is-invalid @enderror" type="email"
                                    name="email" placeholder="Enter a valid email address" value="{{ old('email') }}"
                                    autocomplete="email" autofocus>
                            </div>
                            <div class="row px-3">
                                <label for="phone" class="mb-1">
                                    <h6 class="mb-0 text-sm mr-1">Phone </h6>
                                </label>
                                @error('phone')
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color: red">{{ $message }}</h6>
                                </label>
                                @enderror
                                <input id="phone" class="mb-4 @error('phone') is-invalid @enderror" type="number"
                                    name="phone" placeholder="Enter Your Number" value="{{ old('phone') }}"
                                    autocomplete="phone" autofocus>
                            </div>
                            <div class="row px-3 pb-3">
                                <label for="password" class="mb-1">
                                    <h6 class="mb-0 mr-1 text-sm">Password </h6>
                                </label>
                                @error('password')
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm" style="color: red">{{ $message }}</h6>
                                </label>
                                @enderror
                                <input id="password" type="password" name="password"
                                    class="@error('password') is-invalid @enderror" placeholder="Enter password"
                                    autocomplete="current-password">
                            </div>
                            <div class="row px-3">
                                <label for="password-confirm" class="mb-1">
                                    <h6 class="mb-0 text-sm">Confirm Password</h6>
                                </label>
                                <input type="password" name="password_confirmation" id="password-confirm" class="mb-4" placeholder="Please re-type again password" autocomplete="new-password">
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit"
                                    class="btn btn-blue text-center">Register</button> </div>
                        </form>
                        <div class="row mb-4 px-3"> <small class="font-weight-bold">Have an account? <a
                                    href="{{ route('login') }}" class="text-danger ">Login</a></small> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>

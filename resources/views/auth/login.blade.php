<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Netflixify | Login</title>

    <!--bootstrap-->
    <link rel="stylesheet" href="{{asset('frontend_files/css/bootstrap.min.css')}}">

    <!--font awesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <!--vendor css-->
    <link rel="stylesheet" href="{{asset('frontend_files/css/vendor.min.css')}}">

    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700&display=swap" rel="stylesheet">

    <!--main styles -->
    <link rel="stylesheet" href="{{asset('frontend_files/css/main.min.css')}}">
</head>
<body>

<div class="login">

    <div class="login__bg"></div>

    <div class="container">

        <div class="row">

            <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>

                <form method="POST" action="{{ route('login') }}">
                @csrf
                <!--email-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" autocomplete="email" autofocus id="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <!--password-->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="current-password" id="password">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <!--remember me-->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck1">Remember Me</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Login</button>
                    </div>

                    <p class="text-center">Create new account<a href="register.html"> Register</a></p>

                    <hr>
                    <a href="/login/facebook" class="btn btn-block btn-primary" style="background:#3b5998;">Login by
                        Facebook</a>
                    <a href="/login/google" class="btn btn-block btn-primary" style="background:#ea4335;">Login by
                        Gmail</a>

                </form><!-- end of form -->
            </div><!-- end of col -->

        </div><!-- end of row -->

    </div><!-- end of container -->
</div><!-- end of login -->

<!--jquery-->
<script src="{{asset('frontend_files/js/jquery-3.4.0.min.js')}}"></script>

<!--bootstrap-->
<script src="{{asset('frontend_files/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend_files/js/popper.min.js')}}"></script>

<!--vendor js-->
<script src="{{asset('frontend_files/js/vendor.min.js')}}"></script>

<!--main scripts-->
<script src="{{asset('frontend_files/js/main.min.js')}}"></script>
</body>
</html>

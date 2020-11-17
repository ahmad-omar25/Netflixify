<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Netflixify</title>


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

@yield('content')


<!--jquery-->
<script src="{{asset('frontend_files/js/jquery-3.4.0.min.js')}}"></script>

<!--bootstrap-->
<script src="{{asset('frontend_files/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend_files/js/popper.min.js')}}"></script>

<!--vendor js-->
<script src="{{asset('frontend_files/js/vendor.min.js')}}"></script>

<!--main scripts-->
<script src="{{asset('frontend_files/js/main.min.js')}}"></script>
<!--player js-->
<script src="{{asset('frontend_files/js/playerjs.js')}}"></script>

<script>
    $(document).ready(function () {

        $("#banner .movies").owlCarousel({
            loop: true,
            nav: false,
            items: 1,
            dots: false,
        });

        $(".listing .movies").owlCarousel({
            loop: true,
            nav: false,
            stagePadding: 50,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                900: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            },
            dots: false,
            margin: 15,
            loop: true,
        });

    });
</script>
@stack('scripts')
</body>
</html>

@extends('frontend.layout.app')
@section('content')
    <section id="show">

        @include('frontend.includes._header')

        <div class="movie">

            <div class="movie__bg"
                 style="background: linear-gradient(rgba(0,0,0, 0.6), rgba(0,0,0, 0.6)), url({{$movie->image_path}}) center/cover no-repeat;"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-8">
                        <div id="player"></div>
                    </div><!-- end of col -->

                    <div class="col-md-4 text-white">
                        <h3 class="movie__name fw-300">{{$movie->name}}</h3>

                        <div class="d-flex movie__rating my-1">
                            <div class="d-flex mr-2">
                                @for($i = 0; $i < $movie->rating; $i++)
                                    <span class="fas fa-star text-primary mr-2"></span>
                                @endfor
                            </div>
                            <span class="align-self-center">4.7</span>
                        </div>
                        <p>Views: <span class="movie__views">{{$movie->views}}</span></p>
                        <p class="movie__description my-3">{{$movie->description}}</p>

                        <a href="" class="btn btn-primary text-capitalize my-3"><i class="far fa-heart"></i> add to
                            favorites</a>

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of container -->

        </div><!-- end of movie -->


    </section><!-- end of banner section-->

    <section class="listing py-2">

        <div class="container">

            <div class="row my-4">
                <div class="col-12 d-flex justify-content-between">
                    <h3 class="listing__title text-white fw-300">Related Movies</h3>
                    <a href="" class="align-self-center text-capitalize text-primary">see all</a>
                </div>
            </div><!-- end of row -->


            <div class="movies owl-carousel owl-theme">

                @foreach($related_movies as $related_movie)
                    <div class="movie p-0">
                        <img src="{{$related_movie->poster_path}}" class="img-fluid" alt="">

                        <div class="movie__details text-white">

                            <div class="d-flex justify-content-between">
                                <p class="mb-0 movie__name">{{$related_movie->name}}</p>
                                <p class="mb-0 movie__year align-self-center">{{$related_movie->year}}</p>
                            </div>

                            <div class="d-flex movie__rating">
                                <div class="mr-2">
                                    @for($i = 0; $i < $related_movie->rating; $i++)
                                        <span class="fas fa-star text-primary mr-2"></span>
                                    @endfor
                                </div>
                                <span>{{$related_movie->rating}}</span>
                            </div>

                            <div class="movie___views">
                                <p>{{$related_movie->views}}</p>
                            </div>

                            <div class="d-flex movie__cta">
                                <a href="{{$related_movie->slug}}"
                                   class="btn btn-primary text-capitalize flex-fill mr-2"><i
                                        class="fas fa-play"></i> watch now</a>
                                <i class="far fa-heart fa-1x align-self-center movie__fav-button"></i>
                            </div>

                        </div><!-- end of movie details -->

                    </div><!-- end of col -->
                @endforeach


            </div><!-- end of row -->

        </div><!-- end of container -->

    </section><!-- end of listing section -->

    <footer id="footer" class="py-3 bg-primary text-center text-white">
        <p class="mb-0 text-capitalize">&copy; all copy right reserved for Netflixify 2019</p>
        <div class="social__icons">
            <a href="" class="text-white mr-2"><i class="fab fa-facebook fa-1x"></i></a>
            <a href="" class="text-white mr-2"><i class="fab fa-youtube"></i></a>
            <a href="" class="text-white mr-2"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

    @push('scripts')
        <script>
            var file =
                "[Auto]{{Storage::url('movies/' . $movie->id . '/' . $movie->id . '.m3u8')}}," +
                "[360]{{Storage::url('movies/' . $movie->id . '/' . $movie->id . '_0_100.m3u8')}}," +
                "[480]{{Storage::url('movies/' . $movie->id . '/' . $movie->id . '_1_250.m3u8')}}," +
                "[720]{{Storage::url('movies/' . $movie->id . '/' . $movie->id . '_2_500.m3u8')}}";
            var player = new Playerjs({
                id: "player",
                file: file,
                poster: "{{$movie->image_path}}",
            });

            function PlayerjsEvents(event, id, data) {
                if (event == "duration") {
                    duration = data;
                }
                if (event == "time") {
                    time = data;
                }
                let percent = (time / duration) * 100;
                console.log(percent);
            }
        </script>
    @endpush

@endsection

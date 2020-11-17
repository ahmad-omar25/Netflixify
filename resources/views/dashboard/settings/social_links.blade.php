@extends('dashboard.layout.app')
@section('content')
    <h2>Settings</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Social Links</li>
        </ol>
    </nav>
    <div class="tile mb-4">

        <div class="row">
            <div class="col-md-12">
                <form action="{{route('dashboard.settings.store')}}" method="POST">
                    @csrf

                    @php
                        $social_sites = ['facebook', 'google', 'youtube'];
                    @endphp

                    @foreach($social_sites as $social_site)

                        <div class="form-group">
                            <label class="text-capitalize" for="">{{$social_site}} link</label>
                            <input type="text" name="{{$social_site}}_link"
                                   value="{{setting($social_site . '_link')}}"
                                   class="form-control"
                                   placeholder=""
                                   aria-describedby="helpId">
                        </div>

                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Save</button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->

    @include('sweetalert::alert')

@endsection

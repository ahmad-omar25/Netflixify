@extends('dashboard.layout.app')
@section('content')
    <h2>Edit Movie</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.movies.index')}}">Movies</a></li>
            <li class="breadcrumb-item">Edit</li>
        </ol>
    </nav>
    <div class="tile mb-4">

        <div class="row">
            <div class="col-md-12">
                <form id="movie_properties"
                      action="{{route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'update'])}}"
                      enctype="multipart/form-data"
                      method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                    <div class="form-group">
                        @php $input = "name" @endphp
                        <label for="">Name</label>
                        <input type="text" name="{{$input}}" id="movie_name" value="{{old($input) ?? $movie->$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Movie Name"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        @php $input = "description" @endphp
                        <label for="">Description ( Option )</label>
                        <textarea type="text" name="{{$input}}"
                                  class="form-control"
                                  placeholder="Movie Description"
                                  aria-describedby="helpId">{{old($input) ?? $movie->$input}}</textarea>
                    </div>

                    <!-- Poster -->
                    <div class="form-group">
                        @php $input = "poster" @endphp
                        <label for="">Movie Poster</label>
                        <input type="file" name="{{$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               aria-describedby="helpId">
                        <img src="{{$movie->poster_path}}" style="width: 255px; height: 378px; margin-top: 10px;"
                             alt="">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        @php $input = "image" @endphp
                        <label for="">Movie Image</label>
                        <input type="file" name="{{$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               aria-describedby="helpId">
                        <img src="{{$movie->image_path}}" style="width: 300px; height: 300px; margin-top: 10px;"
                             alt="">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Categories -->
                    <div class="form-group">
                        <label for="">Categories</label>
                        <select class="form-control select2 @error('categories') is-invalid @enderror"
                                name="categories[]"
                                multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    {{in_array($category->id, $movie->categories->pluck('id')->toArray()) ? 'selected' : ''}}
                                >{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('categories')
                        <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Year -->
                    <div class="form-group">
                        @php $input = "year" @endphp
                        <label for="">Movie Year</label>
                        <input type="text" name="{{$input}}" value="{{old($input) ?? $movie->$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Movie Year"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        @php $input = "rating" @endphp
                        <label for="">Movie Rating</label>
                        <input type="number" min="1" name="{{$input}}" value="{{old($input) ?? $movie->$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Movie Rating"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" id="movie_submit_btn"
                                style="display:block"
                                class="btn btn-primary"><i
                                class="fa fa-plus"></i>
                            {{--                            {{$errors->any() ? 'block' : 'none'}}--}}
                            Publish
                        </button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->
@endsection

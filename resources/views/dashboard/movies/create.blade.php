@extends('dashboard.layout.app')
@push('styles')
    <style>
        #movie_upload_wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            cursor: pointer;
            border: 1px solid black;
        }
    </style>
@endpush
@section('content')
    <h2>Create Movie</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.movies.index')}}">Movies</a></li>
            <li class="breadcrumb-item">Add</li>
        </ol>
    </nav>
    <div class="tile mb-4">

        <div class="row">
            <div class="col-md-12">
                <div class=""
                     id="movie_upload_wrapper"
                     onclick="document.getElementById('movie_file_input').click()"
                     style="display: {{$errors->any() ? 'none' : 'flex'}}">
                    <i class="fa fa-video-camera fa-2x"></i>
                    <p>Click To Upload</p>
                </div>
                <input type="file" name="" data-url="{{route('dashboard.movies.store')}}" data-movie-id="{{$movie->id}}"
                       id="movie_file_input" style="display: none">

                <form id="movie_properties"
                      action="{{route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'publish'])}}"
                      style="display: {{$errors->any() ? 'block' : 'none'}}"
                      enctype="multipart/form-data"
                      method="POST">
                    @csrf
                    @method('PUT')
                    {{-- progress bar --}}
                    <div class="form-group" style="display: {{$errors->any() ? 'none' : 'block'}}">
                        <label id="movie_upload_status">Uploading</label>
                        <div class="progress">
                            <div class="progress-bar" id="movie_upload_progress" role="progressbar">
                            </div>
                        </div>
                    </div>

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
                                style="display:{{$errors->any() ? 'block' : 'none'}}"
                                class="btn btn-primary"><i
                                class="fa fa-plus"></i>
                            Publish
                        </button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->
@endsection

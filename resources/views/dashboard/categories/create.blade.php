@extends('dashboard.layout.app')
@section('content')
    <h2>Create Category</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item">Add</li>
        </ol>
    </nav>
    <div class="tile mb-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('dashboard.categories.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        @php $input = "name" @endphp
                        <label for="">Category Name</label>
                        <input type="text" name="{{$input}}" value="{{old($input)}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="{{$input}}"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Save</button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->
@endsection

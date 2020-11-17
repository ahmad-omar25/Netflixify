@extends('dashboard.layout.app')
@section('content')
    <h2>Movies</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Movies</li>
        </ol>
    </nav>
    <div class="tile mb-4">
        <div class="row">
            <div class="col-md-12">
                <form action="">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="search" value="{{request()->input('search')}}"
                                       class="form-control"
                                       placeholder="Search"
                                       autofocus
                                       aria-describedby="helpId">
                            </div>
                        </div><!-- end  of col -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="category">
                                    <option>All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{ request()->category == $category->id ? 'selected' : '' }}
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- end  of col -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search
                                </button>
                                @if(auth()->user()->hasPermission('movies_create'))
                                    <a href="{{route('dashboard.movies.create')}}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>Add</a>
                                @else
                                    <a href="#" disabled class="btn btn-primary"><i
                                            class="fa fa-plus"></i>Add</a>
                                @endif
                            </div>
                        </div><!-- end  of col -->

                    </div><!-- end of row -->

                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

        <div class="row">

            <div class="col-md-12">
                @if ($movies->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Year</th>
                            <th>Rating</th>
                            <th>Categories</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $index=>$movie)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$movie->name}}</td>
                                <td>{{\Illuminate\Support\Str::limit($movie->description, 20) ?? '_______'}}</td>
                                <td>{{$movie->year}}</td>
                                <td>{{$movie->rating}}</td>
                                <td>
                                    @foreach($movie->categories as $category)
                                        <h5 style="display: inline-block"><span
                                                class="badge badge-primary">{{$category->name}}</span></h5>
                                    @endforeach
                                </td>
                                <td>
                                    @if(auth()->user()->hasPermission('movies_update'))
                                        <a class="btn btn-warning btn-sm text-white"
                                           href="{{route('dashboard.movies.edit', $movie->id)}}"><i
                                                class="fa fa-edit"></i>Edit</a>
                                    @else
                                        <a class="btn btn-warning btn-sm text-white"
                                           href="#" disabled><i class="fa fa-edit"></i>Edit</a>
                                    @endif
                                    @if(auth()->user()->hasPermission('movies_delete'))
                                        <form style="display: inline-block"
                                              action="{{route('dashboard.movies.destroy', $movie->id)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                    class="fa fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    @else
                                        <a href="#" disabled class="btn btn-danger btn-sm delete"><i
                                                class="fa fa-trash"></i>Delete
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><!-- end of table -->
                    {{$movies->appends(request()->query())->links()}}
                @else
                    <h3 style="font-weight: 400">Sorry no records found</h3>
                @endif
            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->

    @include('sweetalert::alert')

@endsection

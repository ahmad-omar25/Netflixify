@extends('dashboard.layout.app')
@section('content')
    <h2>Roles</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Roles</li>
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
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search
                                </button>
                                @if(auth()->user()->hasPermission('roles_create'))
                                    <a href="{{route('dashboard.roles.create')}}" class="btn btn-primary"><i
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
                @if ($roles->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 50%;">Permissions</th>
                            <th style="width: 10%;">Users Count</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $index=>$role)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                        <h5 style="display: inline-block"><span
                                                class="badge badge-primary">{{$permission->name}}</span></h5>
                                    @endforeach
                                </td>
                                <td>{{$role->users_count}}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('roles_update'))
                                        <a class="btn btn-warning btn-sm text-white"
                                           href="{{route('dashboard.roles.edit', $role->id)}}"><i
                                                class="fa fa-edit"></i>Edit</a>
                                    @else
                                        <a class="btn btn-warning btn-sm text-white"
                                           href="#" disabled><i class="fa fa-edit"></i>Edit</a>
                                    @endif
                                    @if(auth()->user()->hasPermission('roles_delete'))
                                        <form style="display: inline-block"
                                              action="{{route('dashboard.roles.destroy', $role->id)}}"
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
                    {{$roles->appends(request()->query())->links()}}
                @else
                    <h3 style="font-weight: 400">Sorry no records found</h3>
                @endif
            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->

    @include('sweetalert::alert')

@endsection

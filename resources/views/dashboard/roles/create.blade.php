@extends('dashboard.layout.app')
@section('content')
    <h2>Create Role</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item">Add</li>
        </ol>
    </nav>
    <div class="tile mb-4">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('dashboard.roles.store')}}" method="POST">
                @csrf

                <!-- Name -->
                    <div class="form-group">
                        @php $input = "name" @endphp
                        <label for="">Role Name</label>
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

                    <!-- Permissions -->
                    <div class="form-group">
                        <h4 style="font-weight: 400;margin-top: 30px">Permissions</h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Model</th>
                                <th>Permissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $models = ['categories', 'users', 'roles', 'settings', 'movies']
                            @endphp
                            @foreach($models as $index=>$model)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td class="text-capitalize" style="font-weight: bold">{{$model}}</td>
                                    <td>
                                        @php
                                            $permission_maps = ['create', 'read', 'update', 'delete']
                                        @endphp
                                        @if ($model == 'settings')
                                            @php
                                                $permission_maps = ['create', 'read']
                                            @endphp
                                        @endif
                                        <select name="permissions[]"
                                                class="form-control select2 @error('permissions') is-invalid @enderror"
                                                multiple>
                                            @foreach($permission_maps as $permission_map)
                                                <option
                                                    value="{{$model. '_' .$permission_map}}">{{$permission_map}}</option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Save</button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->
@endsection

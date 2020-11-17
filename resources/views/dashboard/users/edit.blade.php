@extends('dashboard.layout.app')
@section('content')
    <h2>Edit User</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.users.index')}}">Users</a></li>
            <li class="breadcrumb-item">Edit</li>
        </ol>
    </nav>
    <div class="tile mb-4">

        <div class="row">
            <div class="col-md-12">
                <form action="{{route('dashboard.users.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <!-- Name -->
                    <div class="form-group">
                        @php $input = "name" @endphp
                        <label for="">Name</label>
                        <input type="text" name="{{$input}}" value="{{old($input) ?? $user->$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Name"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        @php $input = "email" @endphp
                        <label for="">Email</label>
                        <input type="email" name="{{$input}}" value="{{old($input) ?? $user->$input}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Email"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Roles -->
                    <div class="form-group">
                        @php $input = "role_id" @endphp
                        <label for="">Roles</label>
                        <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="">
                            <option value="" disabled selected>Select Role</option>
                            @foreach($roles as $role)
                                <option
                                    value="{{$role->id}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
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

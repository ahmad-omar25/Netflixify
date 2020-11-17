@extends('dashboard.layout.app')
@section('content')
    <h2>Create User</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('dashboard.users.index')}}">Users</a></li>
            <li class="breadcrumb-item">Add</li>
        </ol>
    </nav>
    <div class="tile mb-4">

        <div class="row">
            <div class="col-md-12">
                <form action="{{route('dashboard.users.store')}}" method="POST">
                @csrf

                <!-- Name -->
                    <div class="form-group">
                        @php $input = "name" @endphp
                        <label for="">Name</label>
                        <input type="text" name="{{$input}}" value="{{old($input)}}"
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
                        <input type="email" name="{{$input}}" value="{{old($input)}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Email"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        @php $input = "password" @endphp
                        <label for="">Password</label>
                        <input type="password" name="{{$input}}" value="{{old($input)}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Password"
                               aria-describedby="helpId">
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="form-group">
                        @php $input = "password_confirmation" @endphp
                        <label for="">Password Confirmation</label>
                        <input type="password" name="{{$input}}" value="{{old($input)}}"
                               class="form-control @error($input) is-invalid @enderror"
                               placeholder="Password Confirmation"
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
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <a href="{{route('dashboard.roles.create')}}">Create new role ?</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Save</button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of col 12 -->

        </div><!-- end of row -->

    </div><!-- end of tile -->
@endsection

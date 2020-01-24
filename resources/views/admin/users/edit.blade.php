@extends('layouts.admin')

@section('content')

    <h1>Edit Users</h1>

 <div class="row">
    <div class="col-sm-3">
        <img src="@if($user->photo){{$user->photo->path}} @endif" alt="User Photo" class="img-responsive img-rounded">
    </div>

        <div class="col-sm-9">
            <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">

                {{csrf_field()}}
                {{--       User Name --}}
                <div class="form-group">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>

                    {{--        User Email--}}

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>


                    {{--        User Role--}}
                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role_id" class="form-control">
                            <div class="form-group">


                                <option disabled >Choose Role</option>
                                    @if($roles)
                                        @foreach($roles as $role)
                                            @if($user->role->id == $role->id)
                                            <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                            @else
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                            </div>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select name="is_active" class="form-control" >
                          @if($user->is_active == 1)
                            <option value="1" selected>Active</option>
                            <option value="0">Not-Active</option>
                            @else
                            <option value="1" selected>Active</option>
                            <option value="0" selected>Not-Active</option>
                          @endif
                        </select>
                    </div>
                    {{-- images uploads--}}

                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file"  name="photo_id" class="form-control">
                    </div>


                    {{--               //password field--}}

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    {{--submit button--}}
                    <div class="form-group">
                        <input type="submit" value="Update User" class="btn btn-primary col-sm-6">
                    </div>
                </div>
            </form>

            <form action="/users/{{$user->id}}" method="POST" class="form-group" >
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <input type="submit" value="Delete User" class="btn btn-danger col-sm-6">
            </form>

        </div>
</div>
    <div class="row">
        @include('includes.errors')
    </div>
@endsection

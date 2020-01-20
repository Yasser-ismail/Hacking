@extends('layouts.admin')

@section('content')

    <h1>Create Users</h1>

{{--    {!! Form::open(['method'=>'post', 'action'=>'AdminUsersController@store']) !!}--}}

{{--            <div class="form-group">--}}
{{--                {!! Form::label('title', 'Name:') !!}--}}
{{--                {!! Form::text('name', null, ['class'=>'form-control']) !!}--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}--}}
{{--            </div>--}}

{{--     {!!Form::close() !!}--}}

        <form method="POST" action="/users" enctype="multipart/form-data">

            {{csrf_field()}}
{{--       User Name --}}
        <div class="form-group">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control">
                </div>

        {{--        User Email--}}

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control">
                </div>


        {{--        User Role--}}
                <div class="form-group">
                   <label>Role:</label>
                     <select name="role_id" class="form-control">
                        <div class="form-group">

                        <option disabled selected>Choose Role</option>
                                @if($roles)
                                    @foreach($roles as $role)

                                        <option value="{{$role->id}}">{{$role->name}}</option>

                                    @endforeach
                                @endif
                     </select>
                </div>


{{--            {!! Form::label('role', 'Role :') !!}--}}
{{--            {!! Form::select('role_id',[''=>'Choose Role']+ $roles , null, ['class'=>'form-control'] ) !!}--}}
        {{--        Status--}}

                <div class="form-group">
                    <label>Status:</label>
                    <select name="is_active" class="form-control">
                        <option value="1">Active</option>
                        <option value="0" selected>Not-Active</option>
                    </select>
                </div>
{{--                         <div class="form-group">--}}
{{--                             {!! Form::label('status', 'Status:') !!}--}}
{{--                             {!! Form::select('is_active',array('1'=>'Active', '0'=>'Not-Active'), 0, ['class'=>'form-control']) !!}--}}
{{--                         </div>--}}

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

                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" name="password_confirm" class="form-control">
                </div>

{{--               <div class="form-group">--}}
{{--                   {!! Form::label('password', 'Password:') !!}--}}
{{--                   {!! Form::password('password', ['class'=>'form-control']) !!}--}}
{{--               </div>--}}


               {{--submit button--}}
                <div class="form-group">
                    <input type="submit" value="Create User" class="btn btn-primary">
                </div>
        </div>
    </form>
@include('includes.errors')

@endsection




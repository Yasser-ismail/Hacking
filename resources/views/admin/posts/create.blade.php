@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>

    {{--    {!! Form::open(['method'=>'post', 'action'=>'AdminUsersController@store']) !!}--}}

    {{--            <div class="form-group">--}}
    {{--                {!! Form::label('title', 'Name:') !!}--}}
    {{--                {!! Form::text('name', null, ['class'=>'form-control']) !!}--}}
    {{--            </div>--}}

    {{--            <div class="form-group">--}}
    {{--                {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}--}}
    {{--            </div>--}}

    {{--     {!!Form::close() !!}--}}

    <form method="POST" action="/posts" enctype="multipart/form-data">

        {{csrf_field()}}
        {{--       post title --}}
        <div class="form-group">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control">
            </div>

            {{--        post category--}}

            <div class="form-group">
                <label>Category:</label>
                <select name="category_id" class="form-control">
                    <option selected disabled>Choose Category</option>
                    @if($categories)
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>


            {{--        post photo--}}
            <div class="form-group">
                <label>Photo:</label>
                <input type="file" name="photo_id" class="form-control">
            </div>


            {{--            {!! Form::label('role', 'Role :') !!}--}}
            {{--            {!! Form::select('role_id',[''=>'Choose Role']+ $roles , null, ['class'=>'form-control'] ) !!}--}}


            {{--        post description --}}

            <div class="form-group">
                <label>Description:</label>
                <textarea name="body" cols="60" rows="10" class="form-control"></textarea>
            </div>
            {{--                         <div class="form-group">--}}
            {{--                             {!! Form::label('status', 'Status:') !!}--}}
            {{--                             {!! Form::select('is_active',array('1'=>'Active', '0'=>'Not-Active'), 0, ['class'=>'form-control']) !!}--}}
            {{--                         </div>--}}


            {{--submit button--}}
            <div class="form-group">
                <input type="submit" value="Create Post" class="btn btn-primary">
            </div>
        </div>
    </form>
    @include('includes.errors')

@endsection




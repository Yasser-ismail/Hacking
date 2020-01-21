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

   @if($post->photo)

       <div class="row">
            <div class="col-sm-3">
                <img src="{{$post->photo->path}}" alt="" class="img-responsive img-rounded">
            </div>
           <div class="col-sm-9">
               <form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">

                   {{csrf_field()}}
                   <input type="hidden" name="_method" value="PATCH">
                   {{--       post title --}}
                   <div class="form-group">
                       <div class="form-group">
                           <label>Title:</label>
                           <input type="text" name="title" class="form-control" VALUE="{{$post->title}}">
                       </div>

                       {{--        post category--}}

                       <div class="form-group">
                           <label>Category:</label>
                           <select name="category_id" class="form-control">
                               <option  disabled>Choose Category</option>
                               @if($categories)
                                   @foreach($categories as $category)
                                       @if($category->id == $post->category_id)
                                           <option selected value="{{$category->id}}">{{$category->name}}</option>
                                       @else
                                           <option value="{{$category->id}}">{{$category->name}}</option>
                                       @endif
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
                           <textarea name="body" cols="60" rows="10"  class="form-control">{{$post->body}}</textarea>
                       </div>
                       {{--                         <div class="form-group">--}}
                       {{--                             {!! Form::label('status', 'Status:') !!}--}}
                       {{--                             {!! Form::select('is_active',array('1'=>'Active', '0'=>'Not-Active'), 0, ['class'=>'form-control']) !!}--}}
                       {{--                         </div>--}}


                       {{--submit button--}}
                       <div class="form-group">
                           <input type="submit" value="Update Post" class="btn btn-primary col-sm-6">
                       </div>
                   </div>
               </form>
               <form action="/posts/{{$post->id}}" method="Post">
                   <input type="hidden" name="_method" value="DELETE">
                   {{csrf_field()}}

                   <input type="submit" value="Delete Post" class="btn btn-danger col-sm-6">

               </form>
           </div>

       </div>

                @else
                       <div class="row">

                                <form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">

                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PATCH">
                                    {{--       post title --}}
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Title:</label>
                                            <input type="text" name="title" class="form-control" VALUE="{{$post->title}}">
                                        </div>

                                        {{--        post category--}}

                                        <div class="form-group">
                                            <label>Category:</label>
                                            <select name="category_id" class="form-control">
                                                <option  disabled>Choose Category</option>
                                                @if($categories)
                                                    @foreach($categories as $category)
                                                        @if($category->id == $post->category_id)
                                                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                            @else
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endif
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
                                            <textarea name="body" cols="60" rows="10"  class="form-control">{{$post->body}}</textarea>
                                        </div>
                                        {{--                         <div class="form-group">--}}
                                        {{--                             {!! Form::label('status', 'Status:') !!}--}}
                                        {{--                             {!! Form::select('is_active',array('1'=>'Active', '0'=>'Not-Active'), 0, ['class'=>'form-control']) !!}--}}
                                        {{--                         </div>--}}


                                        {{--submit button--}}
                                        <div class="form-group">
                                            <input type="submit" value="Update Post" class="btn btn-primary col-sm-6">
                                        </div>
                                    </div>
                                </form>
                                <form action="/posts/{{$post->id}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <input type="submit" value="Delete Post" class="btn btn-danger col-sm-6">

                                </form>
                    </div>
   @endif
    <div class="row">
         @include('includes.errors')
    </div>
@endsection




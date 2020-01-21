@extends('layouts.admin')
@section('content')
    <h1>Posts</h1>

    @if(Session::has('deleted_post'))

        <p class="bg-danger">{{session('deleted_post')}}</p>

    @endif
    @if(Session::has('not_admin'))

        <p class="bg-danger">{{session('not_admin')}}</p>

    @endif
    @if(Session::has('not_owner'))

        <p class="bg-danger">{{session('not_owner')}}</p>

    @endif

    @if(Session::has('created_post'))
        <p class="bg-primary">{{session('created_post')}}</p>
    @endif

    @if(Session::has('updated_post'))
        <p class="bg-primary">{{session('updated_post')}}</p>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created</th>
            <th>updated</th>


        </tr>
        </thead>
        <tbody>
        @if($posts)

            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
               @if($post->photo)
                    <td><img src="{{$post->photo->path}}" alt="Post Photo" style="height: 50px;width: 100px;"></td>
                    @else
                        <td>No Photo</td>
                @endif
                    <td><a href="{{route('posts.edit',[$post->id])}}">{{$post->title}}</a></td>
                    <td><a href="{{route('posts.edit', [$post->id])}}"> {{$post->body}}</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>


                </tr>
        @endforeach

        @endif
    </table>

@endsection
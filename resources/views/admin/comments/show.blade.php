@extends('layouts.admin')

@section('content')

    <form class="form-inline my-2 my-lg-0" method="post" action="/comments/search">
        {{csrf_field()}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input class="form-control mr-sm-2" type="search" name="author" placeholder="Author" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search fa-fw"></i></button>
    </form>

    @if(count($comments) > 0)
        <h1>Comments</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created_at</th>
                <th>Post Link</th>
                <th>Replies Link</th>

            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('post.home', [$comment->post_id])}}">View Post</a></td>
                    <td><a href="{{route('replies', $id = $comment->id)}}">View Replies</a> </td>
                    <td>
                        @if($comment->is_active == 1)
                            <form method="POST" action="/comments/{{$comment->id}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-group">
                                    <input type="submit" value="Dis-Approve" class="btn btn-success">
                                </div>
                            </form>
                        @else
                            <form method="POST" action="/comments/{{$comment->id}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="is_active" value="1">
                                <div class="form-group">
                                    <input type="submit" value="Approve" class="btn btn-primary">
                                </div>
                            </form>
                        @endif

                    </td>
                    <td>
                        <form method="POST" action="/comments/{{$comment->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="form-group">
                                <input type="submit" value="Delete  " class="btn btn-danger">
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments</h1>
    @endif
@endsection
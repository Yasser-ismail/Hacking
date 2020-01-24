@extends('layouts.admin')

@section('content')

@if(count($comments)>0)
            <h1>Comments</h1>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Created_at</th>
                    <th>Post Title</th>
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
                            <td>{{$comment->post->title}}</td>
                            <td><a href="{{route('post.home', [$comment->post->slug])}}">View Post</a></td>
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
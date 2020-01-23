@extends('layouts.admin')

@section('content')

    @if(count($replies)>0)
        <h1>Replies</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created_at</th>


            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td>
                        @if($reply->is_active == 1)
                            <form method="POST" action="/comment/replies/{{$reply->id}}">
                                {{csrf_field()}}

                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-group">
                                    <input type="submit" value="Dis-Approve" class="btn btn-success">
                                </div>
                            </form>
                        @else
                            <form method="POST" action="/comment/replies/{{$reply->id}}">
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
                        <form method="POST" action="/comment/replies/{{$reply->id}}">
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
        <h1 class="text-center">No replies</h1>
    @endif
@endsection
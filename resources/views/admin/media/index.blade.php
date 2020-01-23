@extends('layouts.admin')
@section('content')
    <h1>Media</h1>

    @if(Session::has('deleted_media'))

        <p class="bg-danger">{{session('deleted_media')}}</p>

    @endif

    @if(Session::has('created_media'))
        <p class="bg-primary">{{session('created_media')}}</p>
    @endif

    @if(Session::has('updated_media'))
        <p class="bg-primary">{{session('updated_media')}}</p>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Belongs To</th>
            <th>Name</th>
            <th>Created</th>
            <th>updated</th>


        </tr>
        </thead>
        <tbody>
        @if($photos)

            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td>
                        @if($photo->post)

                            <a href="{{route('post.home', $photo->post->id)}}">{{'Post : '. $photo->post->id}}</a>
                        @elseif($photo->user)

                            {{'User : ' . $photo->user->id}}

                        @else

                            {{'Server Photos'}}

                        @endif


                    </td>
                    <td><img src="{{$photo->path}}" alt="" style="height: 50px;width: 100px;"></td>
                    <td>{{$photo->created_at->diffForHumans()}}</td>
                    <td>{{$photo->updated_at->diffForHumans()}}</td>
                    <td>
                        <form action="/media/{{$photo->id}}" method="post" >
                            {{csrf_field()}}


                                        <input type="hidden" name="_method" value="delete">
                                        @if( $photo->id != 1 )

                                            <div class="form-group">
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </div>

                                        @endif


                        </form>

                    </td>


                </tr>
        @endforeach

        @endif
    </table>

@endsection
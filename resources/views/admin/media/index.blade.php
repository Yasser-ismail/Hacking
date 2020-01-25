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
<form action="medias/delete" method="POST" class="form-inline">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="delete">
        <div class="form-group">
            <input type="submit" class="btn btn-primary ">
        </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" id="options">Check all</th>
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
                    @if( $photo->id == 1 )
                        <td></td>
                    @else
                    <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                    @endif
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
                    <td>@if($photo->path)<img src="{{$photo->path}}" alt="" style="height: 50px;width: 100px;">@endif</td>
                    <td>{{$photo->created_at->diffForHumans()}}</td>
                    <td>{{$photo->updated_at->diffForHumans()}}</td>
                    <td>
{{--                        <form action="/media/{{$photo->id}}" method="post" >--}}
{{--                            {{csrf_field()}}--}}


{{--                                        <input type="hidden" name="_method" value="delete">--}}
{{--                                        @if( $photo->id != 1 )--}}

{{--                                            <div class="form-group">--}}
{{--                                                <input type="submit" value="Delete" class="btn btn-danger">--}}
{{--                                            </div>--}}

{{--                                        @endif--}}


{{--                        </form>--}}
                            @if( $photo->id != 1 )
                                <form action="medias/delete" method="POST" class="form-inline">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <div class="form-group">
                                        <input type="hidden" name="media" value="{{$photo->id}}">
                                        <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                                    </div>
                                </form>
                            @endif
                    </td>


                </tr>
        @endforeach

        @endif
    </table>
</form>
    @section('footer')

        <script>
            $('#options').click(function () {

                if (this.checked) {
                    $('.checkboxes').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkboxes').each(function () {
                        this.checked = false;

                    });
                }
            });
        </script>

    @endsection

@endsection
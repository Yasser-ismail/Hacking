@extends('layouts.admin')

@section('content')





        {{csrf_field()}}
        {{--       Category Name --}}
    <div class="form-group col-sm-6">
        <h1>Create Category</h1>
        <form method="POST" action="/categories" enctype="multipart/form-data">
                        {{csrf_field()}}
                <div class="row">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control ">
                    </div>
                </div>
                    {{--submit button--}}
                <div class="row">
                    <div class="form-group">
                        <input type="submit" value="Create Category" class="btn btn-primary">
                    </div>
                </div>
        </form>
    @include('includes.errors')
    </div>
    <div class="col-sm-6">
        <h1>Categories</h1>

        @if(Session::has('deleted_category'))

            <p class="bg-danger">{{session('deleted_category')}}</p>

        @endif

        @if(Session::has('created_category'))
            <p class="bg-primary">{{session('created_category')}}</p>
        @endif

        @if(Session::has('updated_category'))
            <p class="bg-primary">{{session('updated_category')}}</p>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>updated</th>


            </tr>
            </thead>
            <tbody>
            @if($categories)

                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('categories.edit', [$category->id])}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>


                    </tr>
            @endforeach

            @endif
        </table>

    </div>

@endsection




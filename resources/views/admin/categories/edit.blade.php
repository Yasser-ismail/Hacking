@extends('layouts.admin')

@section('content')



    {{--       Category Name --}}
<div class="row">
    <div class="col-sm-12">

        @if(Session::has('updated_category'))
            <p class="bg-primary">{{session('updated_category')}}</p>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">

        <h1>Edit Category</h1>
        <form method="POST" action="/categories/{{$category->id}}" enctype="multipart/form-data">

            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            <div class="row">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control ">
                </div>
            </div>
            {{--submit button--}}
            <div class="row">
                <div class="form-group">
                    <input type="submit" value="Edit Category" class="btn btn-primary">
                </div>
            </div>
        </form>
        @include('includes.errors')
    </div>

    <div class="col-sm-6">


            <h1>Categories</h1>

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
</div>
@endsection







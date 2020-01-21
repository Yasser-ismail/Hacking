@extends('layouts.admin')

@section('content')

    <h1>Edit Category</h1>


    <form method="POST" action="/categories/{{$category->id}}" enctype="multipart/form-data">

        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">

        {{--       Category Name --}}
        <div class="form-group">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control">
            </div>

            {{--submit button--}}
            <div class="form-group">
                <input type="submit" value="Update Category" class="btn btn-primary col-sm-6">
            </div>
        </div>
    </form>
    <form method="POST" action="/categories/{{$category->id}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" value="Delete Category" class="btn btn-danger col-sm-6">
    </form>
    @include('includes.errors')

@endsection




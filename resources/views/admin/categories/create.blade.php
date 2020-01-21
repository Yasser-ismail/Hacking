@extends('layouts.admin')

@section('content')

    <h1>Create Category</h1>


    <form method="POST" action="/categories" enctype="multipart/form-data">

        {{csrf_field()}}
        {{--       Category Name --}}
        <div class="form-group">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control">
            </div>

            {{--submit button--}}
            <div class="form-group">
                <input type="submit" value="Create Category" class="btn btn-primary">
            </div>
        </div>
    </form>
    @include('includes.errors')

@endsection




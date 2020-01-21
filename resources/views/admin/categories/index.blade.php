@extends('layouts.admin')
@section('content')
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

@endsection
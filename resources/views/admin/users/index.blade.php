@extends('layouts.admin')
@section('content')
    <h1>users</h1>

    @if(Session::has('deleted_user'))

        <p class="bg-danger">{{session('deleted_user')}}</p>

    @endif

    @if(Session::has('created_user'))
        <p class="bg-primary">{{session('created_user')}}</p>
    @endif

    @if(Session::has('updated_user'))
        <p class="bg-primary">{{session('updated_user')}}</p>
    @endif

<table class="table table-striped">
    <thead>
      <tr>

          <th>ID</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Created</th>
          <th>updated</th>




      </tr>
    </thead>
    <tbody>
      @if($users)

         @foreach($users as $user)
              <tr>
                  <td>{{$user->id}}</td>


                  <td><a href="{{route('users.edit', [$user->id])}}"><img src="{{$user->photo->path}}" alt="User Photo" style="border-radius:50%;height: 30px;width: 30px;"></a></td>
                  <td><a href="{{route('users.edit', [$user->id])}}">{{$user->name}}</a></td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role->name}}</td>
                  <td>{{$user->is_active == 1 ? 'Active':'Not-Active'}}</td>
                  <td>{{$user->created_at->diffForHumans()}}</td>
                  <td>{{$user->updated_at->diffForHumans()}}</td>


              </tr>
         @endforeach

       @endif
</table>

@endsection
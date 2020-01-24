@extends('layouts.blog-post')

@section('content')
   <div class="col-lg-8">

      <!-- Blog Post -->

      <!-- Title -->
      <h1>{{$post->title}}</h1>

      <!-- Author -->
      <p class="lead">
         by <a href="#">{{$post->user->name}}</a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
       @if($post->photo)
      <hr>

      <!-- Preview Image -->
      <img class="img-responsive" src="{{$post->photo->path}}" alt="">
       @endif
      <hr>

      <!-- Post Content -->
      <p>{{$post->body}}</p>
      <hr>

      <!-- Blog Comments -->
         @if(Session::has('created_comment'))
            <div class="form-group">
               <p class="bg-primary">{{session('created_comment')}}</p>
            </div>
         @endif

      <!-- Comments Form -->
      @if(Auth::check())
            <div class="well">
                     <h4>Leave a Comment:</h4>
                     <form method="POST" action="/comments">
                        {{csrf_field()}}
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                           <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                     </form>
            </div>
         <hr>
      @endif

      <!-- Posted Comments -->


      <!-- Comment -->
       @if(count($post->comments()->get()) >0)
               @if(Session::has('created_reply'))
                   <div class="form-group">
                       <p class="bg-primary">{{session('created_reply')}}</p>
                   </div>
               @endif

           @foreach($post->comments as $comment)
             @if($comment->is_active == 1)

               <div class="media">
                   <a class="pull-left" href="#">
                      <img class="media-object img-responsive" src="{{$comment->user_photo_path}}" alt="a7a" style="width:32px; height: 32px;" >
                   </a>
                   <div class="media-body">
                      <h4 class="media-heading">{{$comment->author}}
                         <small>{{$comment->created_at->diffForHumans()}}</small>
                      </h4>
                         {{$comment->body}}
                       <hr>
                      <!-- Nested Comment -->



                            @if(count($comment->replies()->get()) > 0)
                                @foreach($comment->replies as $reply)
                                  @if($reply->is_active == 1)
                                       <div class="media">
                                          <a class="pull-left" href="#">
                                             <img class="media-object img-responsive" src="{{$reply->user_photo_path}}" alt="" style="width:32px; height: 32px;" >
                                          </a>
                                          <div class="media-body">
                                             <h4 class="media-heading">{{$reply->author}}
                                                <small>{{$reply->created_at->diffForHumans()}}</small>
                                             </h4>
                                             {{$reply->body}}
                                          </div>
                                           <hr>
                                       </div>
                                  @endif
                                @endforeach
                              @else

                           @endif
                       <!-- End Nested Comment -->
                                 <div class="comment-reply-container">
                                           <button class="btn btn-primary toggle-reply pull-right">Reply</button>

                                       <div class="reply-container">
                                               <form class="form-inline" role="form" action="/comment/replies" method="post">
                                                     {{csrf_field()}}
                                                   <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                  <div class="form-group">
                                                     <input class="form-control" type="text" name="body" placeholder="Your replies" />
                                                  </div>
                                                  <div class="form-group">
                                                     <button type="submit" class="btn btn-default">Add</button>
                                                  </div>
                                               </form>
                                       </div>
                                 </div>
                   </div>
               </div>
                <hr><hr>
             @endif
          @endforeach
       @endif
   </div>

   <!-- Blog Sidebar Widgets Column -->
   <div class="col-md-4">

      <!-- Blog Search Well -->
      <div class="well">
         <h4>Blog Search</h4>
         <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
         </div>
         <!-- /.input-group -->
      </div>

      <!-- Blog Categories Well -->
      <div class="well">
         <h4>Blog Categories</h4>
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-unstyled">
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
               </ul>
            </div>
            <div class="col-lg-6">
               <ul class="list-unstyled">
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
                  <li><a href="#">Category Name</a>
                  </li>
               </ul>
            </div>
         </div>
         <!-- /.row -->
      </div>

      <!-- Side Widget Well -->
      <div class="well">
         <h4>Side Widget Well</h4>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
      </div>

   </div>


@endsection

@section('scripts')
    <script>
        $('.comment-reply-container .toggle-reply').click(function () {
            $(this).next().slideToggle('slow');
        });
    </script>




@endsection
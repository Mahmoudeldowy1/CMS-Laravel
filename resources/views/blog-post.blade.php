<x-home-master>

    @section('content')
        <!-- Title -->

            <h1 class="mt-4">{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">{{$post->user->name}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on {{$post->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

            <hr>
            <!-- Post Content -->
            <p class="lead">{{$post->body}}</p>

            <hr>

            @if(session('message_comment'))

                <div class="alert alert-success">{{session('message_comment')}}</div>
            @elseif(session('reply_message'))
                <div class="alert alert-success">{{session('reply_message')}}</div>
            @endif

            @if(Auth::check())
            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post" action="{{route('comments.store')}}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            @if(count($comments) > 0)
                @foreach($comments as $comment)

                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" height="50px" src="{{$comment->file}}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">{{$comment->author}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h5>
                            {{$comment->body}}


                            @foreach($comment->replies as $reply)

                                @if($reply->is_active == 1)
                                <!-- Comment with nested comments -->
                            <div class="media mt-5">
                                <img class="d-flex mr-3 rounded-circle" height="50px" src="{{$reply->file}}" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">{{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h5>
                                    {{$reply->body}}
                                </div>
                            </div>
                                @endif

                            @endforeach

                            <div class="card my-4">
                                <h5 class="card-header">Leave a Reply:</h5>
                                <div class="card-body">
                                    <form method="post" action="{{route('createReply')}}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$comment->id}}">
                                        <div class="form-group">
                                            <label for="body">Body</label>
                                            <textarea name="body" class="form-control" rows="1" placeholder="Enter Reply"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Reply</button>
                                    </form>
                                </div>
                           </div>


                        </div>
                    </div>
                @endforeach
            @endif
         @endif






        @endsection

</x-home-master>

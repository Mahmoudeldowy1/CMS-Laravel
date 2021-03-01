<x-admin-master>

    @section('content')

    <h1>Comments</h1>

        @if(session('action_comment'))

            <div class="alert alert-success">{{session('action_comment')}}</div>
        @elseif(session('deleted_comment'))
            <div class="alert alert-danger">{{session('deleted_comment')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>Body</th>
                            <th>Created AT</th>
                            <th>Updated AT</th>
                            <th>View Post</th>
                            <th>View Replies</th>
                            <th>Options</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>Body</th>
                            <th>Created AT</th>
                            <th>Updated AT</th>
                            <th>View Post</th>
                            <th>View Replies</th>
                            <th>Options</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td><img height="50px" src="{{$comment->file}}" alt="Image"></td>
                                <td>{{$comment->author}}</td>
                                <td>{{$comment->email}}</td>
                                <td>{{$comment->body}}</td>
                                <td>{{$comment->created_at->diffForHumans()}}</td>
                                <td>{{$comment->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('home.post',$comment->post->id)}}">View Post</a></td>
                                <td><a href="{{route('replies.show',$comment->id)}}">View replies</a></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                    @if($comment->is_active== 1)

                                        <form action="{{route('comments.update',$comment->id)}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="is_active" value="0">
                                            <button type="submit" class="btn btn-primary btn-block">Unapprove</button>
                                        </form>

                                       @else
                                            <form action="{{route('comments.update',$comment->id)}}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="is_active" value="1">
                                                <button type="submit" class="btn btn-primary btn-block">Approve</button>
                                            </form>

                                    @endif
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                            </form>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    @endsection

</x-admin-master>

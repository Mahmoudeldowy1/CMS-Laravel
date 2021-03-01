<x-admin-master>

    @section('content')

        <h1>Replies</h1>

        @if(session('action_reply'))

            <div class="alert alert-success">{{session('action_reply')}}</div>
        @elseif(session('deleted_reply'))
            <div class="alert alert-danger">{{session('deleted_reply')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Replies</h6>
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
                            <th>Options</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($replies as $reply)
                            <tr>
                                <td>{{$reply->id}}</td>
                                <td><img height="50px" src="{{$reply->file}}" alt="Image"></td>
                                <td>{{$reply->author}}</td>
                                <td>{{$reply->email}}</td>
                                <td>{{$reply->body}}</td>
                                <td>{{$reply->created_at->diffForHumans()}}</td>
                                <td>{{$reply->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($reply->is_active== 1)

                                                <form action="{{route('replies.update',$reply->id)}}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="is_active" value="0">
                                                    <button type="submit" class="btn btn-primary btn-block">Unapprove</button>
                                                </form>

                                            @else
                                                <form action="{{route('replies.update',$reply->id)}}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="is_active" value="1">
                                                    <button type="submit" class="btn btn-primary btn-block">Approve</button>
                                                </form>

                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{route('replies.destroy',$reply->id)}}" method="post">
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

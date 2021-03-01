
<x-admin-master>

    @section('content')

        <h1 class="h3 mb-4 text-gray-800">All Posts</h1>

            @if(session('post-deleted-message'))
                <div class="alert alert-danger">{{session('post-deleted-message')}}</div>
            @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
            @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
          @endif


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>image</th>
                            <th>body</th>
                            <th>Category</th>
                            <th>View Post</th>
                            <th>View Comments</th>
                            <th>Created at</th>
                            <th>Actions</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->title}}</td>
                            <td><img height="50px"  src="{{$post->post_image}}" alt="image"></td>
                            <td>{{$post->body}}</td>
                            <td>{{$post->category->name}}</td>
                            <td><a href="{{route('home.post',$post->id)}}">View Post</a></td>
                            <td><a href="{{route('comments.show',$post->id)}}">View Comments</a></td>
                            <td>{{$post->created_at}}</td>
                            <td>
{{--                                @can('view',$post)--}}
                                <form action="{{route('post.destroy', $post->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
{{--                                @endcan--}}
                                <hr>
                                <button class="btn btn-success"><a href="{{route('post.edit',$post->id)}}"> Edit</a></button>
                            </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    <div class="d-flex">
        <div class="mx-auto">
        {{$posts->links()}}
        </div>
    </div>

    @endsection


    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
{{--            <script src="{{asset('js/demo/datatables-demo.js')}}"></script--}}
    @endsection
</x-admin-master>

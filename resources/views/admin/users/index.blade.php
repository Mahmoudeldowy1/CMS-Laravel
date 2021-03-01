<x-admin-master>

    @section('content')

    <h1>Users</h1>

        @if(session('user-deleted-message'))
            <div class="alert alert-danger">{{session('user-deleted-message')}}</div>
{{--        @elseif(session('user-created-message'))--}}
{{--            <div class="alert alert-success">{{session('user-created-message')}}</div>--}}
{{--        @elseif(session('user-updated-message'))--}}
{{--            <div class="alert alert-success">{{session('user-updated-message')}}</div>--}}
        @endif


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>image</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Updated Profile Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td><img height="50px"  src="{{$user->avatar}}" alt="image"></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffForhumans()}}</td>
                                <td>{{$user->updated_at->diffForhumans()}}</td>
                                <td>

                                        <form action="{{route('user.destroy', $user->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                    <hr>
                                    <button class="btn btn-success"><a href="{{route('user.show.profile',$user->id)}}"> Edit</a>

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
                {{$users->links()}}
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

<x-admin-master>

    @section('content')

        <div class="row">

            <div class="col-sm-3">

                <form method="post" action="{{route('permissions.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Create</button>

                </form>

            </div>

            <div class="col-sm-9">
                @if(session('permission-deleted'))
                    <div class="alert alert-danger">{{session('permission-deleted')}}</div>
                @elseif(session('permission-created'))
                    <div class="alert alert-success">{{session('permission-created')}}</div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>options</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>options</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>{{$permission->created_at->diffForHumans()}}</td>
                                        <td>{{$permission->updated_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form action="{{route('permissions.destroy',$permission->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                                    </form>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{route('permissions.edit',$permission->id)}}"><button type="submit" class="btn btn-dark btn-block">Edit</button></a>
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
            </div>

        </div>
    @endsection

</x-admin-master>

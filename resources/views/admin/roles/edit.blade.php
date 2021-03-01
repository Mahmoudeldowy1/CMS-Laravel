<x-admin-master>

    @section('content')

        @if(session('role-updated'))
            <div class="alert alert-success">{{session('role-updated')}}</div>
        @endif


    <div class="row">

      <div class="col-sm-6">

          <h1>Edit Role: {{$role->name}}</h1>

          <form method="post" action="{{route('roles.update',$role->id)}}">
              @csrf
              @method('PUT')
              <div class="form-group ">
                  <label for="name">Name</label>
                  <input type="text" name="name" value="{{$role->name}}" class="form-control @error('name') is-invalid @enderror" id="name">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                  @enderror
              </div>

              <button type="submit" class="btn btn-primary ">Update</button>

          </form>
      </div>

    </div>

            <br>

    <div class="row">
        <div class="col-lg-12">
            @if($permissions->isNotEmpty())
             <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Options</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Attach</th>
                            <th>Detach</th>
{{--                            <th>options</th>--}}

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Attach</th>
                            <th>Detach</th>
{{--                            <th>options</th>--}}
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox"
                                       @foreach($role->permissions as $role_permission)
                                       @if($role_permission->slug == $permission->slug)
                                       checked
                                    @endif
                                    @endforeach
                                ></td>

                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                            <td>{{$permission->created_at->diffForHumans()}}</td>
                            <td>{{$permission->updated_at->diffForHumans()}}</td>
                            <td>
                                <form action="{{route('role.permission.attach',$role)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                    <button class="btn btn-primary"
                                            @if($role->permissions->contains($permission))
                                            disabled
                                        @endif
                                    >Attach</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('role.permission.detach',$role)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                    <button class="btn btn-danger"

                                            @if(!$role->permissions->contains($permission))
                                            disabled
                                        @endif
                                    >Detach</button>
                                </form>
                            </td>

{{--                            <td>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <form action="{{route('roles.destroy',$role->id)}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-danger btn-block">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <a href="{{route('roles.edit',$role->id)}}"><button type="submit" class="btn btn-dark btn-block">Edit</button></a>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </td>--}}

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif
        </div>
    </div>

    @endsection

</x-admin-master>

<x-admin-master>

    @section('content')

    <h1>User Profile for : {{$user->name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('user.update.profile',$user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"  id="name" value="{{$user->name}}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{$user->username}}">

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" >

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirmation" class="form-label">Confirm Password</label>
                        <input name="password-confirmation" type="password" class="form-control @error('password-confirmation') is-invalid @enderror" id="password-confirmation" >

                        @error('password-confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="mb-4 form-group">
                        <img class="img-profile card-img rounded-circle" src="{{$user->avatar}}">
                    </div>

                    <div class="mb-3">
                        <input type="file" name="avatar" >
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>

                </form>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles Table</h6>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Options</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td><input type="checkbox"
                                        @foreach($user->roles as $user_role)
                                            @if($user_role->slug == $role->slug)
                                                checked
                                            @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                    <form action="{{route('user.role.attach',$user)}}" method="post">
                                        @csrf
                                        @method('put')
                                    <input type="hidden" name="role" value="{{$role->id}}">
                                    <button class="btn btn-primary"
                                    @if($user->roles->contains($role))
                                        disabled
                                    @endif
                                    >Attach</button>
                                    </form>
                                    </td>
                                    <td>
                                        <form action="{{route('user.role.detach',$user)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button class="btn btn-danger"

                                            @if(!$user->roles->contains($role))
                                            disabled
                                            @endif
                                            >Detach</button>
                                        </form>
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

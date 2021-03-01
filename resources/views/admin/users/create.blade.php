<x-admin-master>

    @section('content')



        <h1>Create User</h1>

        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Enter Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Enter Username</label>
                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter Username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Enter Email</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Enter Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="email" placeholder="Enter Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror

            </div>


            <div class="mb-3">
                <label for="avatar" class="form-label">Image</label> <br>
                <input type="file" class="form-control-file " name="avatar" id="avatar" >

            </div>


            <input type="submit" class="btn btn-primary" value="Create Post">

        </form>





    @endsection

</x-admin-master>

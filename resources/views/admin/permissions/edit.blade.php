<x-admin-master>

    @section('content')

        @if(session('permission-updated'))
            <div class="alert alert-success">{{session('permission-updated')}}</div>
        @endif


        <div class="row">

            <div class="col-sm-6">

                <h1>Edit Permission: {{$permission->name}}</h1>

                <form method="post" action="{{route('permissions.update',$permission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{$permission->name}}" class="form-control @error('name') is-invalid @enderror" id="name">
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


    @endsection

</x-admin-master>

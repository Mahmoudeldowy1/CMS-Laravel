<x-admin-master>

    @section('content')

        @if(session('role-updated'))
            <div class="alert alert-success">{{session('role-updated')}}</div>
        @endif


        <div class="row">

            <div class="col-sm-6">

                <h1>Edit Category: {{$category->name}}</h1>

                <form method="post" action="{{route('categories.update',$category->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror" id="name">
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

    @endsection

</x-admin-master>

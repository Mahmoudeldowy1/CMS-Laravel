<x-admin-master>

    @section('content')

        <h1>Create post</h1>


        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Enter Title</label>
            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title Post">
            @error('title')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
        </div>


        <div class="mb-3">
             <label for="image" class="form-label">File</label> <br>
             <input type="file" class="form-control-file " name="post_image" id="post_image" >

        </div>

            <div class="mb-3">
                <label for="body" class="form-label">Enter Content</label>
                <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="exampleFormControlTextarea1" cols="30" rows="10"></textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
                @enderror
            </div>

            <div class="mb-3">
                <select class="form-select form-control" name="category_id">
                    <option>Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>



            <input type="submit" class="btn btn-primary" value="Create Post">

        </form>

    @endsection
</x-admin-master>

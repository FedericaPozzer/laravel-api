@extends("layouts.app")

@section("content")

<h2 class="my-5">Add a new project to the list!</h2>

@include("layouts.partials.errors")

<form action="{{ route("admin.projects.store") }}" method="POST" class="row" enctype="multipart/form-data">
     @csrf

    <div class="col-6 d-flex flex-column">
        <div>
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{ old("title") }}">
            @error("title")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        <div class="my-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error("image") is-invalid @enderror" id="image" name="image">
            {{-- @error("image")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror --}}
            {{-- <div>
                <img src="{{$project->getIamge()}}" alt="">
            </div> --}}
        </div>

        <div class="mt-4  mt-auto">
            <button type="submit" class="btn btn-outline-primary">Save this new project</button>
        </div>

    </div>

    <div class="col-6 d-flex flex-column">
        <label for="text" class="form-label">Text</label>
        <textarea class="border" name="text" id="text" rows="10"></textarea>
        @error("text")
            <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>
    
</form>

<button type="button" class="btn btn-outline-secondary mt-5">
    <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
</button>

@endsection

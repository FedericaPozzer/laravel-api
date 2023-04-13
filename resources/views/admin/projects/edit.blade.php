@extends("layouts.app")

@section("content")

<h2 class="my-5">Update this project!</h2>

@include("layouts.partials.errors")

<form action="{{ route("admin.projects.update", $project) }}" method="POST" class="row" enctype="multiport/from-data">
    @method("PUT")
    @csrf

    <div class="col-6 d-flex flex-column">
        <div>
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title">
            @error("title")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        <div class="my-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error("image") is-invalid @enderror" id="image" name="image" value="{{ old("image") ?? $project->image }}">
            @error("image")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        <div class="mt-4  mt-auto">
            <button type="submit" class="btn btn-outline-primary">Update the project</button>
        </div>

    </div>

    <div class="col-6 d-flex flex-column">
        <label for="text" class="form-label">Text</label>
        <textarea class="border" name="text" id="text" rows="10">{{ old("text") ?? $project->text }}</textarea>
        @error("text")
            <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>
    
</form>

<button type="button" class="btn btn-outline-secondary mt-5">
    <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
</button>

@endsection
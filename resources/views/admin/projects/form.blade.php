@extends("layouts.app")

{{-- @section("title", $project->id ? "Update this project!" : "Add a new project to the list!") --}}

@section("content")

{{-- * TITLE --}}
<div>
@if($project->id)
<h2 class="my-5">Update this project!</h2>
@else
<h2 class="my-5">Add a new project to the list!</h2>
@endif
</div>

@include("layouts.partials.errors")

{{-- * IS IT EDIT OR CREATE? --}}
@if($project->id)
    <form action="{{ route("admin.projects.update", $project) }}" method="POST" class="row" enctype="multipart/form-data">
    @method("PUT")
@else
    <form action="{{ route("admin.projects.store") }}" method="POST" class="row" enctype="multipart/form-data">
@endif 
    @csrf

    <div class="col-6 d-flex flex-column">

        {{-- * PROJECT TITLE --}}
        <div>
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{ old("title") ?? $project->title }}">
            @error("title")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        {{-- * PROJECT IMAGE --}}
        <div class="my-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error("image") is-invalid @enderror" id="image" name="image">
            @error("image")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
            {{-- <div>
                <img src="{{old("image", $project->image)}}" class="img-fluid" alt="">
            </div> --}}
        </div>

        {{-- * PROJECT TYPES --}}
        <div class="my-4">
            <label for="type_id">Type</label>
            <select name="type_id" id="type_id" class="form-select form-control mt-2 @error("type_id") is-invalid @enderror">
                <option value="">None</option>

                @foreach($types as $type)
                <option @if(old("type_id", $project->type_id) == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                @endforeach

                @error("type_id")
                <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </select>
        </div>

        {{-- * PROJECT TECHNOLOGIES --}}
        <div class="mb-5 mt-3 row">
            <div class="col-7">
                <label for="" class="form-label">Technologies</label>
                <div class="form-check @error("technologies") is-invalid @enderror">

                @foreach($technologies as $technology)
                    <input type="checkbox" id="technology-{{$technology->id}}" value="{{$technology->id}}" class="form-check-control" name="technologies[]" @if(in_array($technology->id, old("technologies", $project_technogies ?? []))) checked @endif>
                    <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
                    <br>
                @endforeach

                {{-- Input di prova per testare il vlaidator - OK --}}
                {{-- <input type="checkbox" id="technology-10" value="10" name="technologies[]" class="form-check-control">
                <label for="technology-10">GimmeError</label> --}}
                </div>

                @error("technologies")
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <div class="col-5">
                <label for="is_published" class="form-label">Check here to publish this project</label>
                <input type="checkbox" name="is_published" id="is_published" class="form-check-control @error("is_published") is-invalid @enderror" @checked(old("is_published", $project->is_published)) value="1">
            </div>
        </div>

        {{-- * SAVE BTN (Edit/Create versions) --}}
        <div class="mt-auto">
            @if($project->id)
                <button type="submit" class="btn btn-outline-primary">Update this project</button>
            @else
                <button type="submit" class="btn btn-outline-primary">Save this new project</button>
            @endif 
        </div>

    </div>

    {{-- * PROJECT DESCRIPTION --}}
    <div class="col-6 d-flex flex-column">
        <label for="text" class="form-label">Description</label>
        <textarea class="form-control @error("text") is-invalid @enderror" name="text" id="text" rows="13">{{ old("text") ?? $project->text }}</textarea>
        @error("text")
            <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
    </div>
    
</form>

{{-- * GO BACK BTN --}}
<button type="button" class="btn btn-outline-secondary mt-5">
    <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
</button>

@endsection

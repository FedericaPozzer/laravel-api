@extends("layouts.app")

{{-- @section("title", $type->id ? "Update this type!" : "Add a new type to the list!") --}}

@section("content")

<div>
@if($type->id)
<h2 class="my-5">Update this type!</h2>
@else
<h2 class="my-5">Add a new type to the list!</h2>
@endif
</div>

@include("layouts.partials.errors")

@if($type->id)
    <form action="{{ route("admin.types.update", $type) }}" method="POST" class="row" enctype="multipart/form-data">
    @method("PUT")
@else
    <form action="{{ route("admin.types.store") }}" method="POST" class="row" enctype="multipart/form-data">
@endif 
    @csrf

    <div class="col-6 d-flex flex-column">
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name") ?? $type->name }}">
            @error("name")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        <div class="my-5">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control @error("color") is-invalid @enderror" id="color" name="color" value="{{ old("color") ?? $type->color }}">
            @error("color")
            <div class="invalid-feedback"> {{ $message }} </div>
            @enderror
        </div>

        <div class="mt-auto">
            <button type="submit" class="btn btn-outline-primary">Save this new type</button>
        </div>

    </div>
    
</form>

<button type="button" class="btn btn-outline-secondary mt-5">
    <a href="{{route('admin.types.index')}}" class="text-dark"> Back to the list! </a>
</button>

@endsection

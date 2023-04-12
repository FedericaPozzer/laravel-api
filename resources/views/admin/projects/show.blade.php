@extends("layouts.app")

@section("content")

<div class="row my-5">
    <div class="col-10">
        <h2>{{$project->title}}</h2>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-secondary text-dark">
            <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
        </button>
    </div>
</div>

<section class="row">
    <div class="col-8">
        <img src="{{$project->image}}" alt="img">
    </div>
    <div class="col-4">
        <p>{{$project->text}}</p>
    </div>
</section>

@endsection
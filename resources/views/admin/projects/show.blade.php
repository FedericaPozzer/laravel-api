@extends("layouts.app")

@section("content")

<div class="row my-5">
    <div class="col-10">
        <h2>{{$project->title}}</h2>
        {{-- @dump($project->type?->color) YESSS --}}
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-outline-secondary">
            <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
        </button>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <img src=" {{ $project->getImage() }} " alt="img">
    </div>
    <div class="col-4">
        <p>{{$project->text}}</p>
    </div>
</div>

<div>
    <p class="badge rounded-pill" 
    style="background-color:{{$project->type?->color}}">
    {{$project->type?->name}}</p>
</div>

@endsection


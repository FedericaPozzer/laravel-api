@extends("layouts.app")

@section("content")

<div class="row my-5">
    <div class="col-9">
        <h2>{{$project->title}}</h2>
        {{-- @dump($project->type?->color) YESSS --}}
    </div>

    {{-- * ACTIONS --}}
    <div class="col-3">
        <button type="button" class="btn btn-outline-secondary">
            <a href="{{route('admin.projects.index')}}" class="text-dark"> Back to the list! </a>
        </button>

        <a href="{{route("admin.projects.edit", $project)}}">
            <i class="bi bi-pencil mx-3" rel="tooltip" title="Edit"></i>
        </a>

        <button class="bi bi-trash" rel="tooltip" title="Kill" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}"></button>
    </div>

</div>

<div class="row mb-5">
    {{-- * IMG --}}
    <div class="col-8">
        <div class="show-img-container">
            <img src=" {{ $project->getImage() }} " alt="img">
        </div>
    </div>
    {{-- * TEXTAREA --}}
    <div class="col-4">
        <p>{{$project->text}}</p>
    </div>
</div>

{{-- * TYPE --}}
<div> {{-- aggiungo l'IF perchè se cancello il type mi rimane "Type:" volante e lo odio --}}
    @if($project->type)
    <p class="badge rounded-pill" 
        style="background-color:{{$project->type?->color}}"> Type:
        {{$project->type?->name}}</p>
    @endif
</div>

{{-- * TECHNOLOGIES --}}
<div>
    @foreach($project->technologies as $technology)
    <span class="badge" style="background-color: {{$technology->color}}"> Tech: 
    {{$technology->name}}
    </span>
    @endforeach
</div>

{{-- * IS PUBLISHED? --}}
<div class="text-center"> 
    @if(($project->is_published) == 1)
    <p class="h3">
        &hearts;
        This project is currently published!
        &hearts;
    </p>
    @endif
</div>

@endsection


{{-- * MODAL FOR DELETE --}}
@section("modals")

@include("layouts.partials.modalProject")

@endsection
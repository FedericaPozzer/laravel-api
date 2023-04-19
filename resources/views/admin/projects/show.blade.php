@extends("layouts.app")

@section("content")

<div class="row my-5">
    <div class="col-9">
        <h2>{{$project->title}}</h2>
        {{-- @dump($project->type?->color) YESSS --}}
    </div>

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



@section("modals")
<div class="modal fade" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you wanna delete {{$project->title}}? <br> This operation is not reversible!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
            @method("delete")
            @csrf
            <button type="submit" class="btn btn-primary">Yes, delete!</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
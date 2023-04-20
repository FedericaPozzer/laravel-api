@extends("layouts.app")

@section("content")

<h1 class="my-5">Projects</h1>

<table class="table table-primary table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Abstract</th>
        <th scope="col">Tech</th>
        <th scope="col">Type</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
        <th scope="row">{{$project->id}}</th>
        <td>{{$project->title}}</td>
        <td>{{$project->getAbstract()}}</td>
         <td>
          @forelse($project->technologies as $technology)
          <span class="badge" style="background-color: {{$technology->color}}">
          {{$technology->name}}
          </span>
          @empty -
          @endforelse
        </td>
        <td>
          {{-- @forelse($project->types as $type)
            {!! $type->getTypeHTML() !!}
          @empty no types
          @endforelse --}} 
          {{-- NON VA!!! --}}

          <span class="badge rounded-pill" style="background-color: {{$project->type?->color}}">
            {{$project->type?->name}}
          </span>
        </td>
        <td class="d-flex justify-content-between pe-3">
            <a href="{{route("admin.projects.show", $project)}}">
                <i class="bi bi-eyeglasses" rel="tooltip" title="More details"></i>
            </a>

            <a href="{{route("admin.projects.edit", $project)}}">
                <i class="bi bi-pencil" rel="tooltip" title="Edit"></i>
            </a>

            <button class="bi bi-trash" rel="tooltip" title="Kill" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}"></button>
        </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">
            <p>No projects available!</p>
          </td>
        </tr>
        @endforelse
    </tbody>
</table> 

{{$projects->links()}}


<div class="my-3 d-flex w-100 justify-content-end">
    <a href="{{ route('admin.projects.create') }}" type="button" class="btn btn-outline-primary">+ add new project</a>
</div>

@endsection

@section("modals")
@foreach($projects as $project)

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

@endforeach
@endsection
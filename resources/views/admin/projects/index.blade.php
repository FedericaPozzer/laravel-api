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

		{{-- * DESCRIPTION ABSTRACT (Project Model) --}}
    	<td>{{$project->getAbstract()}}</td>

		{{-- * TECHNOLOGIES --}}
		<td>
        	@forelse($project->technologies as $technology)
        	<span class="badge" style="background-color: {{$technology->color}}">
        	{{$technology->name}}
        	</span>
        	@empty -
        	@endforelse
    	</td>

		{{-- * TYPE --}}
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

		{{-- * ACTIONS (see, edit, delete) --}}
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
		{{-- * if the table is empty --}}
        <tr>
        <td colspan="5">
            <p>No projects available!</p>
        </td>
        </tr>
        @endforelse
    </tbody>
</table> 

{{-- * pagination --}}
{{$projects->links()}}

<div class="d-flex justify-content-end">
{{-- * ADD PROJECT BTN --}}
    <div class="">
     <a href="{{ route('admin.projects.create') }}" type="button" class="btn btn-outline-primary">+ add new project</a>
    </div>

{{-- * ADD PROJECT BTN --}}
    <div class="ms-3">
        <a href="{{ route('admin.projects.trash') }}" type="button" class="btn btn-outline-primary"><span class="bi bi-trash3"></span> trashed projects</a>
    </div>
</div>

@endsection


{{-- * MODAL FOR DELETE --}}
@section("modals")
@foreach($projects as $project)

@include("layouts.partials.modalProject")


@endforeach
@endsection
@extends("layouts.app")

@section("content")

<h1 class="my-5">Projects</h1>

<table class="table table-primary table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Abstract</th>
        <th scope="col">Details</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
        <th scope="row">{{$project->id}}</th>
        <td>{{$project->title}}</td>
        <td>{{$project->getAbstract()}}</td>
        <td class="d-flex justify-content-between pe-3">
            <a href="{{route("admin.projects.show", $project)}}">
                <i class="bi bi-eyeglasses" rel="tooltip" title="More details"></i>
            </a>

            <a href="{{route("admin.projects.edit", $project)}}">
                <i class="bi bi-pencil" rel="tooltip" title="Edit TODO"></i>
            </a>

            <a href="{{route("admin.projects.destroy", $project)}}">
                <i class="bi bi-trash" rel="tooltip" title="Kill TODO"></i>
            </a>
        </td>
        </tr>
        @empty
        <p>no projects available</p>
        @endforelse
    </tbody>
</table> 

{{$projects->links()}}


<div class="my-3 d-flex w-100 justify-content-end">
    <a href="{{ route('admin.projects.create') }}" type="button" class="btn btn-outline-primary">+ add new project</a>
</div>

@endsection
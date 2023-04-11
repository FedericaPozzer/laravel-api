@extends("layouts.app")

@section("content")

<h1 class=my-5>Projects</h1>

<table class="table table-warning table-striped">
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
        <td><a href="{{route("admin.projects.show", $project)}}">READ</a></td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table> 

{{$projects->links()}}

@endsection
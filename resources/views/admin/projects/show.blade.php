@extends("layouts.app")

@section("content")

<h2 class="my-5">{{$project->title}}</h2>

<section class="row">
    <div class="col-8">
        <img src="{{$project->image}}" alt="img">
    </div>
    <div class="col-4">
        <p>{{$project->text}}</p>
    </div>
</section>

@endsection
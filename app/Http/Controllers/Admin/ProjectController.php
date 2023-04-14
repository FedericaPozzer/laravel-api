<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; //per lo storage (immagini)
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.projects.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        // [
        //     "title" => "required|string|max:100",
        //     "text" => "required|string",
        //     "image" => "nullable|image|mimes:jpg,jpeg,png",
        // ], 
        // [
        //     "title.required" => "Insert a title.",
        //     "title.string" => "The title must be a string.",
        //     "title.max" => "The title must be shorter than 100 characters.",

        //     "text.required" => "Insert the text.",
        //     "text.string" => "The text must be a string!",

        //     "image.image" => "Insert an image.",
        //     "image.mimes" => "Extensions accepted: jpg, jpeg, png."
        // ]);


        $data = $request->all();

        if(Arr::exists($data, "image")) {
            $path = Storage::put("uploads/projects", $data["image"]);
            $data["image"] = $path;
        };

        // dd($path);

        // if ($request->hasFile('image')) {
        //     Storage::put("uploads", $request->image);
        // } Michele option

        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        // dd($data);

        return to_route("admin.projects.show", $project);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view("admin.projects.edit", compact("project"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $request->validate(
        // [
        //     "title" => "required|string|max:100",
        //     "text" => "required|string",
        //     "image" => "nullable|image|mimes:jpg,jpeg,png",
        // ], 
        // [
        //     "title.required" => "Insert a title.",
        //     "title.string" => "The title must be a string.",
        //     "title.max" => "The title must be shorter than 100 characters.",

        //     "text.required" => "Insert the text.",
        //     "text.string" => "The text must be a string!",

        //     "image.image" => "Insert an image.",
        //     "image.mimes" => "Extensions accepted: jpg, jpeg, png."
        // ]);

        $data = $request->all();

        if(Arr::exists($data, "image")) {
            if($project->image) Storage::delete($project->image);
            $path = Storage::put("uploads/projects", $data["image"]);
            $data["image"] = $path;
        };

        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        return to_route("admin.projects.show", $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $id_project = $project->id;

        if($project->image) Storage::delete($project->image);
        $project->delete();

        return redirect()->route("admin.projects.index");
    }
}

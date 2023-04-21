<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
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
        $project = new Project;
        $types = Type::all();
        $technologies = Technology::all();
        $project_technologies = [];
        return view("admin.projects.form", compact("project", "types", "technologies", "project_technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
        [
            "title" => "required|string|max:100",
            "text" => "required|string",
            "image" => "nullable|image|mimes:jpg,jpeg,png",
            "type_id" => "nullable|exists:types,id",
            "technologies" => "nullable|exists:technologies,id" //al plurale perchè è un array
        ], 
        [
            "title.required" => "Insert a title.",
            "title.string" => "The title must be a string.",
            "title.max" => "The title must be shorter than 100 characters.",

            "text.required" => "Insert the text.",
            "text.string" => "The text must be a string!",

            "image.image" => "Insert an image.",
            "image.mimes" => "Extensions accepted: jpg, jpeg, png.",

            "type_id.exists" => "Insert type",

            "technologies.exists" => "Technology not valid",
        ]);


        $data = $request->all();

        if(Arr::exists($data, "image")) {
            $path = Storage::put("uploads/projects", $data["image"]);
            $data["image"] = $path;
        };

        // dd($path);

        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        // dd($data);

        if(Arr::exists($data, "technologies")) $project->technologies()->sync($data["technologies"]);
        // come nell'update ma senza il detach, che non serve perchè essendo un project nuovo non ho roba vecchia da detachare

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
        $types = Type::all();
        $technologies = Technology::all();
        $project_technologies = $project->technologies->pluck("id")->toArray();
        return view("admin.projects.form", compact("project", "types", "technologies", "project_technologies"));
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
        $request->validate(
        [
            "title" => "required|string|max:100",
            "text" => "required|string",
            "image" => "nullable|image|mimes:jpg,jpeg,png",
            "type_id" => "nullable|exists:types,id",
            "technologies" => "nullable|exists:technologies,id" //al plurale perchè è un array
        ], 
        [
            "title.required" => "Insert a title.",
            "title.string" => "The title must be a string.",
            "title.max" => "The title must be shorter than 100 characters.",

            "text.required" => "Insert the text.",
            "text.string" => "The text must be a string!",

            "image.image" => "Insert an image.",
            "image.mimes" => "Extensions accepted: jpg, jpeg, png.",

            "type_id.exists" => "Insert type",

            "technologies.exists" => "Technology not valid",
        ]);

        $data = $request->all();

        if(Arr::exists($data, "image")) {
            if($project->image) Storage::delete($project->image);
            $path = Storage::put("uploads/projects", $data["image"]);
            $data["image"] = $path;
        };

        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->save();
        
        if(Arr::exists($data, "technologies")) $project->technologies()->sync($data["technologies"]);
        else $project->technologies()->detach();

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

        // if($project->image) Storage::delete($project->image);
        $project->delete();

        return redirect()->route("admin.projects.index");
    }

    /** SOFT DELETE
     * Display a listing of the trashed resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        // dd($projects); ok
        return view("admin.projects.trash", compact("projects"));
    }

    /** RESTORE
     * Display a listing of the trashed resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function restore(Int $id) {
        $project = Project::where("id", $id)->onlyTrashed()->first();
        $project->restore();

        return to_route("admin.projects.index");
    }

    /** FORCE DELETE
     * Display a listing of the trashed resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Int $id) 
    {
        $project = Project::where("id", $id)->onlyTrashed()->first();

        $id_project = $project->id;

        if($project->image) Storage::delete($project->image);
        $project->forceDelete();

        return to_route("admin.projects.trash");
    }

}

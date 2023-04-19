<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::paginate(10);
        return view("admin.types.index", compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = new Type();
        return view("admin.types.form", compact("type"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:20",
            "color" => "required|string|size:7"
        ], [
            "name.required" => "Insert a name",
            "name.string" => "Insert a string",
            "name.max" => "Name must be shorter than 21 characters",

            "color.required" => "Insert a color",
            "color.string" => "Insert a string",
            "color.size" => "Insert a 7-characters color (ex. '#ffffff')",
        ]);

        $type = new Type();
        $type->fill($request->all());
        $type->save();

        return view("admin.types.show");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view("admin.types.show", compact("type"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view("admin.types.form", compact("type"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            "name" => "required|string|max:20",
            "color" => "required|string|size:7"
        ], [
            "name.required" => "Insert a name",
            "name.string" => "Insert a string",
            "name.max" => "Name must be shorter than 21 characters",

            "color.required" => "Insert a color",
            "color.string" => "Insert a string",
            "color.size" => "Insert a 7-characters color (ex. '#ffffff')",
        ]);

        $type->update($request->all());

        return view("admin.types.show");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return view("admin.types.index");
    }
}

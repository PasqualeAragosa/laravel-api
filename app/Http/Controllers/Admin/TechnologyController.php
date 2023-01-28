<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $validated_data = $request->validated();

        // Slug
        $technology_slug = Technology::createTechnologySlug($validated_data['name']);
        $validated_data['slug'] = $technology_slug;

        $technology = Technology::create($validated_data);

        return to_route('admin.technologies.index')->with('message', "New project technology $technology->name added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateTechnologyRequest $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $validated_data = $request->validated();

        // Slug
        $technology_slug = Technology::createTechnologySlug($validated_data['name']);
        $validated_data['slug'] = $technology_slug;

        $technology->update($validated_data);

        return to_route('admin.technologies.index')->with('message', "Project technology $technology->name modified");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', " Project $technology->name deleted");
    }
}

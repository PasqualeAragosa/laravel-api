<?php

namespace App\Http\Controllers\Admin; //ho spostato il controller

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

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
        $projects = Project::orderByDesc('id')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        // Valido tutti i campi inviato tramite form allo 'store'
        $validated_data = $request->validated();

        // Se viene passata un'immagine la carico in uploads
        if ($request->hasFile('cover_image')) {
            $cover_image = Storage::put('uploads', $validated_data['cover_image']);
            //sostituisco il valore di cover_img nei dati validati
            $validated_data['cover_image'] = $cover_image;
        }

        // Genero slug
        $project_slug = Project::createSlug($validated_data['title']);
        $validated_data['slug'] = $project_slug;

        $project = Project::create($validated_data);


        return to_route('admin.projects.index')->with('message', 'New Project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $cover_image = Storage::put('uploads', $validated_data['cover_image']);

            //sostituisco il valore di cover_img nei dati validati
            $validated_data['cover_image'] = $cover_image;
        }

        $project_slug = Project::createSlug($validated_data['title']);

        $validated_data['slug'] = $project_slug;
        $project->update($validated_data);

        return to_route('admin.projects.index')->with('message', " Project $project->title modified");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', " Project $project->title deleted");
    }
}

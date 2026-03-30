<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use App\Models\Lead;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $from_data = $request->all();

        if ($request->hasFile('image')) {
            $img_path = Storage::disk('public')->put('uploads', $from_data['image']);
        }
        $from_data['image'] = $img_path;
        $slug = Str::slug($request->title, '-');
        $from_data['slug'] = $slug;
        $newProject = Project::create($from_data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        $newLead = Lead::create($from_data);

        Mail::to('info@boolpress.com')->send(new NewContact($newLead));

        return redirect()->route('admin.projects.index')->with('message', 'Project created correctly!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['type', 'technologies']);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $from_data = $request->all();
        if ($request->hasFile('image')) {

            if ($project->image) {

                Storage::delete($project->image);
            }

            $img_path = Storage::disk('public')->put('uploads', $from_data['image']);
        }

        $from_data['image'] = $img_path;

        $slug = Str::slug($request->title, '-');
        $from_data['slug'] = $slug;
        $project->update($from_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.projects.index', compact('project'))->with('message', 'Project modified correctly!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index', compact('project'))->with('message_danger', 'Project deleted correctly!!');
    }
}

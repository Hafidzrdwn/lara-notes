<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Workspace $space)
    {
        $categories = Category::all();

        return view('projects.create',  compact('space', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Workspace $space)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'category' => 'required'
        ]);

        $validatedData['workspace_id'] = $space->id;
        $validatedData['category_id'] = $validatedData['category'];
        $validatedData['slug'] = "prj" . Str::random(20);
        $validatedData['security'] = ($request->has('security')) ? 1 : 0;

        Project::create($validatedData);
        $route = ($request->page == "dashboard") ? redirect()->route('dashboard.space.show', $space->id) : redirect()->route('space', $space->slug);
        return $route->with('success', '<strong>Congratulations!!</strong> new project is successfully created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Workspace $space, Project $project)
    {
        if ($project->security == 1 && auth()->user()->id != $space->user_id) {
            abort(403);
        }
        return view('projects.show', compact('space', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return response()->json(Project::find(request()->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workspace $space, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'category' => 'required'
        ]);

        $validatedData['workspace_id'] = $space->id;
        $validatedData['category_id'] = $validatedData['category'];
        $validatedData['slug'] = "prj" . Str::random(20);
        $validatedData['security'] = ($request->has('security')) ? 1 : 0;

        Project::find($project->id)->update($validatedData);

        $route = ($request->query('page') == "dashboard") ? redirect()->route('dashboard.space.show', $space->id) : redirect()->route('space', $space->slug);

        return $route->with('success', "<strong>Congratulations!!</strong> your project ({$validatedData['title']}) is successfully updated!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workspace $space, Project $project)
    {
        $page = request()->query('page');
        Project::destroy($project->id);
        $route = ($page == "dashboard") ? redirect()->route('dashboard.space.show', $space->id) : redirect()->route('space', $space->slug);
        return $route->with('success', "<strong>Wow!</strong> your project ({$project->title}) has been deleted!!");
    }
}

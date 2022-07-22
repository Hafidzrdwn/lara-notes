<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::with('user');
        $workspaces = (!Auth::check()) ? $workspaces->where('is_example', 1) : $workspaces->latest();

        return view('spaces.index', [
            'spaces' => $workspaces->paginate(8)
        ]);
    }

    public function show(Workspace $space)
    {
        if (!Auth::check() && !$space->is_example) {
            return redirect()->route('spaces');
        }

        return view('spaces.space', [
            'space' => $space->load('user', 'projects'),
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('spaces.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:30',
            'description' => 'required|string|min:3'
        ]);

        $validated['desc'] = $validated['description'];
        $validated['slug'] = SlugService::createSlug(Workspace::class, 'slug', $request->title);
        $validated['user_id'] = Auth::user()->id;

        Workspace::create($validated);

        return redirect()->route('dashboard.space')->with('success', '<strong>Congratulations!!</strong> your new workspace is successfully created!!');
    }

    public function edit(Workspace $space)
    {
        if (!Auth::check() || Auth::user()->id != $space->user_id) {
            abort(403);
        }

        return view('spaces.edit', ['space' => $space]);
    }

    public function update(Request $request, Workspace $space)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:30',
            'description' => 'required|string|min:3'
        ]);

        $validated['desc'] = $validated['description'];
        $validated['slug'] = SlugService::createSlug(Workspace::class, 'slug', $request->title);
        $validated['user_id'] = Auth::user()->id;

        Workspace::find($space->id)->update($validated);
        $route = ($request->page == "dashboard") ? redirect()->route('dashboard.space', $space->id) : redirect()->route('spaces');
        return $route->with('success', '<strong>Congratulations!!</strong> your workspace has been edited!!');
    }

    public function destroy(Workspace $space)
    {
        $page = request()->query('page');
        Workspace::destroy($space->id);
        $route = ($page == "dashboard") ? redirect()->route('dashboard.space') : redirect()->route('spaces');
        return $route->with('success', "<strong>Workspace ({$space->title})</strong>, has been deleted!!");
    }
}

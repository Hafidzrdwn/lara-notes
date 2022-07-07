<?php

namespace App\Http\Controllers;

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
            'spaces' => $workspaces->get()
        ]);
    }

    public function create()
    {
        return view('spaces.create');
    }

    public function show(Workspace $space)
    {
        return view('spaces.space', ['space' => $space->load('projects')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:30',
            'description' => 'required|string|min:3'
        ]);

        $validated['desc'] = $validated['description'];
        $validated['slug'] = $request->slug;
        $validated['user_id'] = Auth::user()->id;

        Workspace::create($validated);

        return redirect()->route('dashboard')->with('success', '<strong>Congratulations!!</strong> your new space is successfully created!!');
    }

    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Workspace::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}

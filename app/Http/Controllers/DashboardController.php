<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function space()
    {
        $spaces = Workspace::where('user_id', Auth::user()->id)->with('projects')->latest()->get();
        return view('dashboard.space', compact('spaces'));
    }

    public function show(Workspace $space)
    {
        $projects = Project::where('workspace_id', $space->id)->with('category')->get();
        $categories = Category::all();

        return view('dashboard.show', compact('space', 'projects', 'categories'));
    }
}

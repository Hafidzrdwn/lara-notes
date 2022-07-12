<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function store(Request $request, Workspace $space, Project $project)
    {
        $data = $request->all();
        $data['project_id'] = $project->id;

        Note::create($data);

        return response()->json([
            'success' => true,
            'msg' => 'Note created'
        ]);
    }

    public function destroy(Workspace $space, Project $project, Note $note)
    {
        Note::destroy($note->id);
        return redirect()->route('project', [
            'space' => $space->slug,
            'project' => $project->slug
        ]);
    }
}

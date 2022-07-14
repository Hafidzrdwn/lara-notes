@extends('layouts.main', ['title' => $project->title])

@if ($project->category->name == "Plain Notes")
    @include('projects.categories.plain')
@elseif($project->category->name == "Rich Notes")
    @include('projects.categories.rich')
@endif

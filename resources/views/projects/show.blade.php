@extends('layouts.main', ['title' => $project->title])

@if ($project->category->name == "Plain Notes")
    @include('projects.categories.plain')
@endif

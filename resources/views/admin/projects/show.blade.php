@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col my-3">
            <div class="card">
                <h5 class="card-header">{{ $project->title }}</h5>
                <div class="card-body">
                    <h5><strong>Linguaggio</strong>: {{$project->type?->name ?? 'Non Specificato'}}</h5>
                    <h5><strong>Tecnologia</strong>:
                        @forelse($project->technologies as $technology)
                        {{$technology?->name}}
                        @empty
                        Non Specificato
                        @endforelse
                    </h5>
                    <p class="card-text"><strong>Descrizione</strong>: {{ $project->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col my-3">
            <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Go Projects List</a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    @if(session('message'))
    <div class="row">
        <div class="col my-3">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    </div>
    @endif

    @if(session('message_danger'))
    <div class="row">
        <div class="col my-3">
            <div class="alert alert-danger">
                {{ session('message_danger') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col my-3">
            <a href="{{route('admin.projects.create')}}">
                <button class="btn btn-square btn-primary">
                    Add Project
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped my-3">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{$project->title}}</td>
                        <td>{{$project->description}}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.projects.show', [ 'project'=> $project->id ]) }}">
                                    <button class="ms-2 btn btn-square btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{ route('admin.projects.edit', [ 'project'=> $project->id ]) }}">
                                    <button class="ms-2 btn btn-square btn-warning">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </a>
                                <form action="{{ route('admin.projects.destroy', ['project'=>$project->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ms-2 btn btn-square btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
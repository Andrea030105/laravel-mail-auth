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
            <a href="{{route('admin.types.create')}}">
                <button class="btn btn-square btn-primary">
                    Add Type
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped my-3">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Linguaggio</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $type)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                {{$type->name}}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.types.show', [ 'type'=> $type->id ]) }}">
                                    <button class="ms-2 btn btn-square btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{ route('admin.types.edit', [ 'type'=> $type->id ]) }}">
                                    <button class="ms-2 btn btn-square btn-warning">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </a>
                                <form action="{{ route('admin.types.destroy', ['type'=>$type->id]) }}" method="POST">
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
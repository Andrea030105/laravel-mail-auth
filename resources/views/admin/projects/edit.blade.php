@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col my-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col my-3">
                <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Add Title"
                            value="{{ $project->title }}">
                    </div>
                    <div class="mb-3">
                        <div>
                            <img src="{{ asset('storage/' . $project->image) }}" class="img-project-width my-2"
                                alt="{{ $project->title }}">
                        </div>
                        <label for="image" class="form-label"><strong>Insert icon</strong>:</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type_id" id="type_id">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="technologies" class="form-label mb-0 me-3"><strong>Technologies</strong>:</label>
                        @foreach ($technologies as $technology)
                            <div class="form-check @error('technologies') is-invalid @enderror">
                                @if ($errors->any())
                                    <input class="form-check-input me-1" type="checkbox" value="{{ $technology->id }}"
                                        name="technologies[]"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label me-3">{{ $technology->name }}</label>
                                @else
                                    <input class="form-check-input me-1" type="checkbox" value="{{ $technology->id }}"
                                        name="technologies[]"
                                        {{ $project->technologies->contains($technology ? 'checked' : '') }}>
                                    <label class="form-check-label me-3">{{ $technology->name }}</label>
                                @endif
                            </div>
                        @endforeach

                        @error('technologies')
                            <div class="invalid-feedback">{{ message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Add Description">{{ $project->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col my-3">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col my-3">
            <form action="{{ route('admin.types.update', ['type'=>$type->id]) }}" method="POST">
                @csrf

                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Add name" value="{{ $type->name }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
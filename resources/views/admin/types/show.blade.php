@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col my-3">
            <div class="card">
                <h5 class="card-header">{{ $type->name }}</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col my-3">
            <a href="{{route('admin.types.index')}}" class="btn btn-primary">Go Types List</a>
        </div>
    </div>
</div>
@endsection
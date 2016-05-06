@extends('prosper.core::layouts.clear')

@section('content')

    <form method="post" action="{{ prosper_route('auth.springboard.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Project name" required>
        </div>

        <button class="btn btn-success">
            Create project
        </button>
    </form>

@stop
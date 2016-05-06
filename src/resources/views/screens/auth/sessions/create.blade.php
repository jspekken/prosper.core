@extends('prosper.core::layouts.clear')

@section('content')

    <form method="post" action="{{ prosper_route('auth.sessions.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-success">
            Sign-in
        </button>
    </form>

@stop
@extends('prosper.core::layouts.clear')

@section('content')

    <h3>Sign into</h3>

    <ul>
        @foreach ($projects as $project)
            <li>
                <a href="{{ prosper_route('auth.springboard.open', $project) }}">
                    {{ $project->name }}
                </a>
            </li>
        @endforeach
    </ul>

@stop
@extends('prosper.core::layouts.master')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ prosper_route('module.store', 'pages') }}" class="form-horizontal">
        {{ csrf_field() }}

        @include('prosper.core::components.admin.form')
    </form>

@stop
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

    <form method="post" action="{{ prosper_route('module.update', [$controller->getModule(), $builder->data->key]) }}" class="form-horizontal">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @include('prosper.core::components.admin.form')
    </form>

@stop
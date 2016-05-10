@extends('prosper.core::layouts.master')

@section('content')

    @if ($builder->data->count() > 0)
        <table class="table table-hover">

        </table>
    @endif

@stop
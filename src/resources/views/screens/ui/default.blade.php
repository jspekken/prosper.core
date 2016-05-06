@extends('prosper.core::layouts.master')

@section('content')
    @foreach ($mapper->getChildren() as $child)
        {!! $child->render() !!}
    @endforeach
@stop
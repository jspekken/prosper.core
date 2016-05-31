@extends('prosper.core::layouts.master')

@section('content')

    @if (!$builder->data->isEmpty())
        <table class="table table-hover">
            <thead>
                <tr>

                    @foreach ($mapper->all() as $field)
                        @include('prosper.core::components.admin.list.head.column')
                    @endforeach

                </tr>
            </thead>
            <tbody>

                @foreach ($builder->data as $row)
                    <tr>
                        @foreach ($row->fields as $field)
                            @include('prosper.core::components.admin.list.body.column')
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>

        {!! $builder->query->links() !!}
    @endif

@stop
@extends('prosper.core::layouts.master')

@section('content')

    @if (!$builder->data->isEmpty())
        <table class="table table-hover">
            <thead>
                <tr>

                    @foreach ($mapper->all() as $field)
                        <th>{{ $field->label }}</th>
                    @endforeach

                </tr>
            </thead>
            <tbody>

                @foreach ($builder->data as $row)
                    <tr>
                        @foreach ($row->fields as $field)
                            <td>
                                {!! $field->render() !!}
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>

        {!! $builder->query->links() !!}
    @endif

@stop
@foreach ($builder->data->fields as $field)
    {!! $field->render() !!}
@endforeach

<div class="row">
    <div class="col-sm-12 col-md-9 col-md-offset-3">
        <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
        <button class="btn btn-success">Save changes</button>
    </div>
</div>
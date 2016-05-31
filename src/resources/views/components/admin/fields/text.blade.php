<div class="form-group">
    <label for="f-{{ $field->name }}" class="col-sm-3 control-label">
        {{ $field->label }}
    </label>
    <div class="col-sm-9">
        <input type="text" name="{{ $field->name }}" id="f-{{ $field->name }}" class="form-control" value="{{ $field->value }}">
    </div>
</div>
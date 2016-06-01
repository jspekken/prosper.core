<div class="form-group">
    <label for="f-{{ $field->name }}" class="control-label">
        {{ $field->label }}
    </label>
    <input type="text" name="{{ $field->name }}" id="f-{{ $field->name }}" class="form-control" value="{{ $field->value }}">
</div>
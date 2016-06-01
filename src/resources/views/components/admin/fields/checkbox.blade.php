<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="hidden" name="{{ $field->name }}" value="0">
            <input type="checkbox" name="{{ $field->name }}" value="1" {{ $field->value ? 'checked' : '' }}>
            {{ $field->label }}
        </label>
    </div>
</div>
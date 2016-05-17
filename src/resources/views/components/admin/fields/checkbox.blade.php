<div class="form-group">
    <div class="col-sm-9 col-md-offset-3">
        <div class="checkbox">
            <label>
                <input type="hidden" name="{{ $field->name }}" value="0">
                <input type="checkbox" name="{{ $field->name }}" value="1" {{ $field->value ? 'checked' : '' }}>
                {{ $field->label }}
            </label>
        </div>
    </div>
</div>
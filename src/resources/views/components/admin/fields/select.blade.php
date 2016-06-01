<div class="form-group">
    <label for="f-{{ $field->name }}" class="control-label">
        {{ $field->label }}
    </label>
    <select name="{{ $field->name }}" id="f-{{ $field->name }}" class="form-control">
        @foreach ($field->options as $key => $option)
            <option value="{{ $key }}" {{ $field->selected == $key ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="f-{{ $field->name }}" class="col-sm-3 control-label">
        {{ $field->label }}
    </label>
    <div class="col-sm-9">
        <select name="{{ $field->name }}" id="f-{{ $field->name }}" class="form-control">
            @foreach ($field->options as $key => $option)
                <option value="{{ $key }}" {{ $field->selected == $key ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    </div>
</div>
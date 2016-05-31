<a href="{{ $field->url }}">
    {{ $field->value }}
</a>

@if (isset($field->properties['sub-column']))
    <span class="sub-column">
        {{ $field->properties['sub-column']($field) }}
    </span>
@endif
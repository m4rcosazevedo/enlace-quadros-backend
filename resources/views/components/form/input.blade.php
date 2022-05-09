@php($class ??= '')
@php($value ??= null)

<input
    type="{{ $type ?? 'text' }}"
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    class="form-control @error($name) @errror is-invalid @enderror {{ $class }}"
    value="{{ old($name, $model->{$name} ?? $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes }}
/>

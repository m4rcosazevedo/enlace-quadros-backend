<div
    id="editor"
    class="markdown-editor @error($name) @errror is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}"
>{{ old($name, $model->{$name} ?? null) }}</div>

@if(!empty($model))
    <input type="hidden" id="oldContent" value="{{ $model->{$name} }}" />
@endif
<input type="hidden" name="{{ $name }}" id="content" />

{{--
<textarea
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    rows="5"
    class="form-control @error($name) @errror is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}"
>{{ old($name, $model->{$name} ?? null) }}</textarea>
--}}

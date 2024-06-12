@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
    'required'      => false,
    'value'         => ''
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }} {!! $required ? '<span class="text-danger fw-bold">*</span>' : '' !!}</label>
    <textarea
        class="form-control {{ $error ? 'is-invalid' : '' }}"
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($autofocus) autofocus @endif
        @if ($required) required @endif
    >{{ $value }}</textarea>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
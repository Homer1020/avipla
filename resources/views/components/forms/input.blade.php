@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'type'          => 'text',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
    'required'      => false,
    'value'         => ''
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }} {!! $required ? '<span class="text-danger fw-bold">*</span>' : '' !!}</label>
    <input
        class="form-control {{ $error ? 'is-invalid' : '' }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if ($autofocus) autofocus @endif
        @if ($required) required @endif
        {!! $attributes !!}
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
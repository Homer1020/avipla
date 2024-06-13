@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
    'required'      => false,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }} {!! $required ? '<span class="text-danger fw-bold">*</span>' : '' !!}</label>
    <select
        class="form-select {{ $error ? 'is-invalid' : '' }}"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($autofocus) autofocus @endif
        @if ($required) required @endif
    >{{ $slot }}</select>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
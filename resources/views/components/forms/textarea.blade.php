@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
    'value'         => ''
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea
        class="form-control {{ $error ? 'is-invalid' : '' }}"
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($autofocus) autofocus @endif
    >{{ $value }}</textarea>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
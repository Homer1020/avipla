@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'type'          => 'text',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
    'value'         => ''
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input
        class="form-control {{ $error ? 'is-invalid' : '' }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($autofocus) autofocus @endif
        value="{{ $value }}"
    >
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
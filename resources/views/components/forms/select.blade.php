@props([
    'error'         => false,
    'id'            => '',
    'name'          => '',
    'placeholder'   => '',
    'label'         => '',
    'autofocus'     => false,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select
        class="form-select {{ $error ? 'is-invalid' : '' }}"
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($autofocus) autofocus @endif
    >
    </select>
    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
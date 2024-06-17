<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input
        type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name) }}"
        placeholder="John Doe"
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Correo</label>
    <input
        type="text"
        name="email"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email) }}"
        placeholder="john@doe.com"
    >
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="role_id" class="form-label">Role</label>
    <select class="form-select" name="role_id" id="role_id">
        <option selected disabled>Seleccionar rol</option>
        @foreach ($roles as $role)
            <option @selected($role->id === old('role_id', $user->roles->first() ? $user->roles->first()->id : '')) value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
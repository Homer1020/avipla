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
    <label for="#" class="form-label">Rol</label>
    <select name="role_id" id="role_id" class="form-select">
        <option selected disabled>Seleccione un rol</option>
        
        @foreach ($roles as $role)
            <option @selected($role->id === old('role_id', $user->roles->first() ? $user->roles->first()->id : null)) value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input
        type="password"
        name="password"
        id="password"
        class="form-control @error('password') is-invalid @enderror"
        placeholder="*******"
    >
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
    <input
        type="password"
        name="password_confirmation"
        id="password_confirmation"
        class="form-control @error('password_confirmation') is-invalid @enderror"
        placeholder="*******"
    >
</div>
<div class="d-flex mb-3 align-items-end gap-2">
  <div class="flex-grow-1">
    @csrf
    <label for="role" class="form-label">Role</label>
    <input
      type="text"
      name="role"
      id="role"
      class="form-control @error('role') is-invalid @enderror"
      value="{{ old('role', $role->name) }}"
      placeholder="Usuario, Admin, Super admin, Editor..."
      required
    >
    @error('role')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">
    <i class="fa fa-save"></i>
    Guardar role
  </button>
</div>

<div class="mb-3">
  {{-- @dump() --}}
  <ul class="list-group">
    @foreach($permissions as $permission)
      <li class="list-group-item">
        <label class="form-check form-switch">
          <input
            @checked(in_array($permission->id, $role->permissions->pluck('id')->toArray()))
            class="form-check-input"
            type="checkbox"
            name="permissions[]"
            value="{{ $permission->name }}"
          >
          <div class="form-check-label">
            {{ $permission->name }}
          </div>
        </label>
      </li>
    @endforeach
  </ul>
</div>

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

<div class="row g-3">
  {{-- @dump() --}}
  @foreach($permissionsGroup as $group => $permissions)
    <div class="col-12 col-md-4 col-lg-4">
      <div class="card">
        <div class="card-header">
          <p class="card-title mb-0">{{ $group }}</p>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach ($permissions as $permission)
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
                  {{ __('permissions.' . $permission->name) }}
                </div>
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endforeach
</div>

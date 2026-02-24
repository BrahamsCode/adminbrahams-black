<x-black-layout title="Editar Usuario">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header d-flex align-items-center gap-3">
          <a href="{{ route('admin.users.index') }}" class="btn btn-simple btn-sm mb-0 text-white d-flex align-items-center gap-1">
            <i class="tim-icons icon-minimal-left"></i> Volver
          </a>
          <div>
            <h5 class="card-title mb-0">Editar Usuario</h5>
            <small class="text-muted">{{ $user->email }}</small>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="bd-label">Nombre completo</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="bd-input {{ $errors->has('name') ? 'is-invalid' : '' }}" autofocus>
                @error('name')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="bd-label">Rol</label>
                <select name="role" class="bd-input">
                  <option value="user"  {{ old('role',$user->role)==='user'  ? 'selected':'' }}>Usuario</option>
                  <option value="admin" {{ old('role',$user->role)==='admin' ? 'selected':'' }}>Administrador</option>
                </select>
                @error('role')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-12 mb-3">
                <label class="bd-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="bd-input {{ $errors->has('email') ? 'is-invalid' : '' }}">
                @error('email')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
            </div>

            <hr style="border-color:rgba(255,255,255,.1)">
            <p class="text-muted mb-3" style="font-size:.8rem">
              <i class="tim-icons icon-lock-circle mr-1"></i>
              Deja los campos de contraseña vacíos para no modificarla.
            </p>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="bd-label">Nueva contraseña</label>
                <input type="password" name="password"
                       class="bd-input {{ $errors->has('password') ? 'is-invalid' : '' }}">
                @error('password')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="bd-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="bd-input">
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-2">
              <a href="{{ route('admin.users.index') }}" class="btn btn-simple text-white mb-0">Cancelar</a>
              <button type="submit" class="btn btn-success mb-0">
                <i class="tim-icons icon-check-2 mr-1"></i> Guardar Cambios
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-black-layout>

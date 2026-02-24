<x-black-layout title="Mi Perfil">
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card">
        <div class="card-body text-center py-5">
          <div class="rounded-circle d-inline-flex align-items-center justify-content-center font-weight-bold text-white mb-3"
               style="background:linear-gradient(87deg,#7928ca,#ff0080);width:80px;height:80px;font-size:2rem">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
          </div>
          <h5 class="mb-0">{{ Auth::user()->name }}</h5>
          <p class="text-muted mb-2" style="font-size:.85rem">{{ Auth::user()->email }}</p>
          @if(Auth::user()->isAdmin())
            <span class="badge badge-admin text-white px-3">Administrador</span>
          @else
            <span class="badge badge-user text-white px-3">Usuario</span>
          @endif
          <hr style="border-color:rgba(255,255,255,.1);margin:1.25rem 0">
          <div class="text-left px-2">
            <p class="mb-2 d-flex align-items-center gap-2" style="font-size:.85rem">
              <i class="tim-icons icon-calendar-60 text-primary"></i>
              <span class="text-muted">Miembro desde:</span>
              <span class="font-weight-bold ml-1">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
            </p>
            <p class="mb-0 d-flex align-items-center gap-2" style="font-size:.85rem">
              <i class="tim-icons icon-email-85 text-primary"></i>
              <span class="text-muted">Email verificado:</span>
              <span class="font-weight-bold ml-1">{{ Auth::user()->email_verified_at ? 'Sí' : 'No' }}</span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
          <i class="tim-icons icon-single-02 text-primary"></i>
          <h5 class="card-title mb-0">Información Personal</h5>
        </div>
        <div class="card-body">
          @if(session('status')==='profile-updated')
            <div class="alert alert-bd-success alert-dismissible fade show mb-3 d-flex align-items-center gap-2">
              <i class="fas fa-check-circle"></i> Perfil actualizado correctamente.
              <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
            </div>
          @endif
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="bd-label">Nombre</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                       class="bd-input {{ $errors->has('name') ? 'is-invalid':'' }}" required autofocus>
                @error('name')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="bd-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                       class="bd-input {{ $errors->has('email') ? 'is-invalid':'' }}" required>
                @error('email')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
              <button type="submit" class="btn btn-primary mb-0">
                <i class="tim-icons icon-check-2 mr-1"></i> Guardar Cambios
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
          <i class="tim-icons icon-lock-circle text-info"></i>
          <h5 class="card-title mb-0">Cambiar Contraseña</h5>
        </div>
        <div class="card-body">
          @if(session('status')==='password-updated')
            <div class="alert alert-bd-success alert-dismissible fade show mb-3 d-flex align-items-center gap-2">
              <i class="fas fa-check-circle"></i> Contraseña actualizada.
              <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
            </div>
          @endif
          <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('PUT')
            <div class="row">
              <div class="col-12 mb-3">
                <label class="bd-label">Contraseña actual</label>
                <input type="password" name="current_password" class="bd-input" autocomplete="current-password">
                @error('current_password','updatePassword')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="bd-label">Nueva contraseña</label>
                <input type="password" name="password" class="bd-input" autocomplete="new-password">
                @error('password','updatePassword')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="bd-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="bd-input">
              </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
              <button type="submit" class="btn btn-info mb-0">
                <i class="tim-icons icon-lock-circle mr-1"></i> Actualizar Contraseña
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="card" style="border:1px solid rgba(253,93,147,.3)">
        <div class="card-header d-flex align-items-center gap-2">
          <i class="tim-icons icon-alert-circle-exc text-danger"></i>
          <h5 class="card-title mb-0 text-danger">Zona de Peligro</h5>
        </div>
        <div class="card-body">
          <p class="text-muted mb-3" style="font-size:.875rem">Esta acción eliminará permanentemente tu cuenta.</p>
          <button type="button" class="btn btn-danger mb-0" data-toggle="modal" data-target="#deleteModal">
            <i class="tim-icons icon-simple-remove mr-1"></i> Eliminar mi cuenta
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background:#27293d;border:1px solid rgba(255,255,255,.1)">
        <div class="modal-header" style="border-color:rgba(255,255,255,.1)">
          <h5 class="modal-title text-danger"><i class="tim-icons icon-alert-circle-exc mr-1"></i> Eliminar Cuenta</h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <form method="POST" action="{{ route('profile.destroy') }}">
          @csrf @method('DELETE')
          <div class="modal-body">
            <p class="text-muted mb-3" style="font-size:.875rem">Esta acción es <strong class="text-white">irreversible</strong>.</p>
            <label class="bd-label">Contraseña para confirmar</label>
            <input type="password" name="password" class="bd-input" required>
            @error('password','userDeletion')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
          </div>
          <div class="modal-footer" style="border-color:rgba(255,255,255,.1)">
            <button type="button" class="btn btn-simple text-white mb-0" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger mb-0">Sí, eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</x-black-layout>

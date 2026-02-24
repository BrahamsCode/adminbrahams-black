<x-black-layout title="Usuarios">

  <div class="row mb-3 align-items-center">
    <div class="col"><p class="text-muted mb-0" style="font-size:.85rem">Gestiona todos los usuarios del sistema.</p></div>
    <div class="col-auto">
      <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm mb-0">
        <i class="tim-icons icon-simple-add"></i> Nuevo Usuario
      </a>
    </div>
  </div>

  {{-- Filtros --}}
  <div class="card mb-3">
    <div class="card-body py-3">
      <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2 align-items-end">
        <div class="col-md-5">
          <label class="bd-label">Buscar</label>
          <input type="text" name="search" value="{{ request('search') }}"
                 placeholder="Nombre o correo..." class="bd-input">
        </div>
        <div class="col-md-3">
          <label class="bd-label">Rol</label>
          <select name="role" class="bd-input">
            <option value="">Todos</option>
            <option value="admin" {{ request('role')==='admin' ? 'selected' : '' }}>Admin</option>
            <option value="user"  {{ request('role')==='user'  ? 'selected' : '' }}>Usuario</option>
          </select>
        </div>
        <div class="col-auto d-flex gap-2">
          <button type="submit" class="btn btn-primary btn-sm mb-0">
            <i class="tim-icons icon-zoom-split"></i> Filtrar
          </button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-simple btn-sm mb-0 text-white">Limpiar</a>
        </div>
      </form>
    </div>
  </div>

  {{-- Tabla --}}
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0">Listado de Usuarios</h5>
      <span class="text-muted" style="font-size:.8rem">{{ $users->total() }} en total</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tablesorter table-dark-custom">
          <thead class="text-primary">
            <tr>
              <th>#</th>
              <th>Usuario</th>
              <th class="text-center">Rol</th>
              <th class="text-center">Registro</th>
              <th class="text-right">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
            <tr>
              <td class="text-muted" style="font-size:.8rem">{{ $user->id }}</td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center font-weight-bold text-white"
                       style="background:linear-gradient(87deg,#7928ca,#ff0080);width:34px;height:34px;font-size:.8rem;flex-shrink:0;margin-right:.75rem">
                    {{ strtoupper(substr($user->name,0,1)) }}
                  </div>
                  <div>
                    <span class="d-block" style="font-size:.875rem;font-weight:600">{{ $user->name }}</span>
                    <small class="text-muted">{{ $user->email }}</small>
                  </div>
                </div>
              </td>
              <td class="text-center">
                @if($user->role==='admin')
                  <span class="badge badge-admin text-white px-2">Admin</span>
                @else
                  <span class="badge badge-user text-white px-2">Usuario</span>
                @endif
              </td>
              <td class="text-center text-muted" style="font-size:.8rem">{{ $user->created_at->format('d/m/Y') }}</td>
              <td class="text-right">
                <div class="d-flex justify-content-end align-items-center gap-3">
                  <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-link btn-warning btn-sm p-1 mb-0" title="Editar">
                    <i class="tim-icons icon-pencil"></i>
                  </a>
                  @if($user->id !== auth()->id())
                  <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar a {{ addslashes($user->name) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-link btn-danger btn-sm p-1 mb-0" title="Eliminar">
                      <i class="tim-icons icon-simple-remove"></i>
                    </button>
                  </form>
                  @endif
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center py-5 text-muted">
                <i class="tim-icons icon-zoom-split d-block mb-2" style="font-size:2rem"></i>
                No se encontraron usuarios.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if($users->hasPages())
        <div class="mt-3">{{ $users->links() }}</div>
      @endif
    </div>
  </div>

</x-black-layout>

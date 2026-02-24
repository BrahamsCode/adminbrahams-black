<x-black-layout title="Dashboard">
  @php
    $totalUsers  = \App\Models\User::count();
    $totalAdmins = \App\Models\User::where('role','admin')->count();
    $totalNormal = \App\Models\User::where('role','user')->count();
    $recent      = \App\Models\User::where('created_at','>=',now()->subDays(7))->count();
  @endphp

  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5"><div class="info-icon text-center icon-warning"><i class="tim-icons icon-single-02"></i></div></div>
            <div class="col-7"><div class="numbers"><p class="card-category">Total Usuarios</p><h3 class="card-title">{{ $totalUsers }}</h3></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5"><div class="info-icon text-center icon-danger"><i class="tim-icons icon-badge"></i></div></div>
            <div class="col-7"><div class="numbers"><p class="card-category">Administradores</p><h3 class="card-title">{{ $totalAdmins }}</h3></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5"><div class="info-icon text-center icon-success"><i class="tim-icons icon-satisfied"></i></div></div>
            <div class="col-7"><div class="numbers"><p class="card-category">Usuarios Normales</p><h3 class="card-title">{{ $totalNormal }}</h3></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5"><div class="info-icon text-center icon-info"><i class="tim-icons icon-user-run"></i></div></div>
            <div class="col-7"><div class="numbers"><p class="card-category">Nuevos (7 días)</p><h3 class="card-title">{{ $recent }}</h3></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title">Últimos Usuarios Registrados</h5>
          @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary btn-simple mb-0">Ver todos</a>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table tablesorter table-dark-custom">
              <thead class="text-primary">
                <tr><th>Usuario</th><th>Rol</th><th class="text-right">Registro</th></tr>
              </thead>
              <tbody>
                @foreach(\App\Models\User::latest()->take(5)->get() as $u)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="rounded-circle d-flex align-items-center justify-content-center font-weight-bold text-white"
                           style="background:linear-gradient(87deg,#7928ca,#ff0080);width:36px;height:36px;font-size:.85rem;flex-shrink:0">
                        {{ strtoupper(substr($u->name,0,1)) }}
                      </div>
                      <div>
                        <span class="d-block font-weight-600">{{ $u->name }}</span>
                        <small class="text-muted">{{ $u->email }}</small>
                      </div>
                    </div>
                  </td>
                  <td>
                    @if($u->role==='admin')
                      <span class="badge badge-admin text-white px-2">Admin</span>
                    @else
                      <span class="badge badge-user text-white px-2">Usuario</span>
                    @endif
                  </td>
                  <td class="text-right">{{ $u->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header"><h5 class="card-title">Mi Cuenta</h5></div>
        <div class="card-body text-center">
          <div class="rounded-circle d-inline-flex align-items-center justify-content-center font-weight-bold text-white mb-3"
               style="background:linear-gradient(87deg,#7928ca,#ff0080);width:70px;height:70px;font-size:1.8rem">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
          </div>
          <h5 class="mb-0">{{ Auth::user()->name }}</h5>
          <p class="text-muted" style="font-size:.85rem">{{ Auth::user()->email }}</p>
          @if(Auth::user()->isAdmin())
            <span class="badge badge-admin text-white px-3 mb-3">Administrador</span>
          @else
            <span class="badge badge-user text-white px-3 mb-3">Usuario</span>
          @endif
          <div class="mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm btn-block">
              <i class="tim-icons icon-settings mr-1"></i> Editar Perfil
            </a>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm btn-block mt-2">
              <i class="tim-icons icon-simple-add mr-1"></i> Nuevo Usuario
            </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

</x-black-layout>

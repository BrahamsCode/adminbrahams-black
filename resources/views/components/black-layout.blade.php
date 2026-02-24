@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('black-dashboard/img/favicon.png') }}">
  <title>{{ $title }} — {{ config('app.name') }}</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
  <link href="{{ asset('black-dashboard/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('black-dashboard/css/black-dashboard.min.css') }}" rel="stylesheet" />
  <style>
    body { font-family: 'Poppins', sans-serif; }

    /* Inputs limpios */
    .bd-label {
      font-size: .75rem;
      font-weight: 600;
      color: rgba(255,255,255,.6);
      text-transform: uppercase;
      letter-spacing: .06em;
      margin-bottom: .35rem;
      display: block;
    }
    .bd-input {
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: .4285rem;
      color: #fff;
      padding: .5rem .85rem;
      font-size: .875rem;
      width: 100%;
      transition: border-color .2s ease, box-shadow .2s ease;
    }
    .bd-input:focus {
      background: rgba(255,255,255,.1);
      border-color: #e14eca;
      box-shadow: 0 0 0 3px rgba(225,78,202,.2);
      outline: none;
      color: #fff;
    }
    .bd-input::placeholder { color: rgba(255,255,255,.35); }
    .bd-input.is-invalid { border-color: #fd5d93; }
    select.bd-input option { background: #1e1e2e; color: #fff; }

    /* Badges rol */
    .badge-admin { background: linear-gradient(87deg,#7928ca,#ff0080); }
    .badge-user  { background: linear-gradient(87deg,#2dce89,#2dcecc); }

    /* Alertas */
    .alert-bd-success { background: linear-gradient(87deg,#2dce89,#2dcecc); color:#fff; border:none; border-radius:.4285rem; }
    .alert-bd-danger  { background: linear-gradient(87deg,#f5365c,#f56036); color:#fff; border:none; border-radius:.4285rem; }

    /* Tabla hover */
    .table-dark-custom tbody tr:hover { background: rgba(255,255,255,.05); }

    /* Stat card number */
    .stat-number { font-size: 1.6rem; font-weight: 700; }

    /* Gap utilities (Bootstrap 4 no las trae de serie) */
    .gap-1 { gap: .25rem !important; }
    .gap-2 { gap: .5rem  !important; }
    .gap-3 { gap: 1rem   !important; }
    .gap-4 { gap: 1.5rem !important; }

    /* Paginación — dark theme */
    .pagination { flex-wrap: wrap; gap: 4px; }
    .pagination .page-link {
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.15);
      color: rgba(255,255,255,.7);
      border-radius: .4285rem !important;
      padding: .38rem .7rem;
      font-size: .82rem;
      transition: background .2s, border-color .2s;
    }
    .pagination .page-link:hover {
      background: rgba(255,255,255,.15);
      border-color: rgba(255,255,255,.3);
      color: #fff;
    }
    .pagination .page-item.active .page-link {
      background: linear-gradient(87deg,#7928ca,#ff0080);
      border-color: transparent;
      color: #fff;
    }
    .pagination .page-item.disabled .page-link {
      background: rgba(255,255,255,.04);
      border-color: rgba(255,255,255,.08);
      color: rgba(255,255,255,.28);
      cursor: default;
    }
    /* Eliminar bordes de esquinas extra que Bootstrap 4 pone */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child  .page-link { border-radius: .4285rem !important; }
  </style>
</head>

<body class="">
<div class="wrapper">

  {{-- SIDEBAR --}}
  <div class="sidebar" data-color="purple" data-image="{{ asset('black-dashboard/img/sidebar-1.jpg') }}">
    <div class="sidebar-wrapper">
      <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text logo-mini">
          <i class="tim-icons icon-bullet-list-67"></i>
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
          {{ config('app.name') }}
        </a>
      </div>
      <ul class="nav">

        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @if(Auth::user()->isAdmin())
        <li class="nav-item">
          <p class="nav-label">Gestión</p>
        </li>
        <li class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">
          <a href="{{ route('admin.users.index') }}">
            <i class="tim-icons icon-single-02"></i>
            <p>Usuarios</p>
          </a>
        </li>
        <li class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
          <a href="{{ route('admin.users.create') }}">
            <i class="tim-icons icon-simple-add"></i>
            <p>Nuevo Usuario</p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <p class="nav-label">Cuenta</p>
        </li>
        <li class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
          <a href="{{ route('profile.edit') }}">
            <i class="tim-icons icon-settings"></i>
            <p>Mi Perfil</p>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="tim-icons icon-button-power"></i>
            <p>Cerrar Sesión</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </li>

      </ul>
    </div>
  </div>

  {{-- MAIN PANEL --}}
  <div class="main-panel">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-toggle d-inline">
            <button type="button" class="navbar-toggler">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
          <a class="navbar-brand" href="#">{{ $title }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                <div class="photo">
                  <span style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;font-weight:700;font-size:.9rem;color:#fff">
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                  </span>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Cerrar Sesión
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    {{-- CONTENT --}}
    <div class="content">
      <div class="container-fluid">

        {{-- Alertas --}}
        @if(session('success'))
          <div class="alert alert-bd-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-bd-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif

        {{ $slot }}

      </div>
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-muted" style="font-size:.8rem">
            © {{ date('Y') }} {{ config('app.name') }}
          </div>
          <div class="col-sm-6 text-right text-muted" style="font-size:.8rem">
            Diseño por <a href="https://www.creative-tim.com" target="_blank" class="text-muted font-weight-bold">Creative Tim</a>
          </div>
        </div>
      </div>
    </footer>

  </div>
</div>

{{-- JS --}}
<script src="{{ asset('black-dashboard/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('black-dashboard/js/core/popper.min.js') }}"></script>
<script src="{{ asset('black-dashboard/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('black-dashboard/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('black-dashboard/js/black-dashboard.min.js') }}"></script>
</body>
</html>

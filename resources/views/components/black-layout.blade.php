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

    /* Avatar navbar — inicial del usuario */
    .navbar .nav-avatar-photo {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(87deg, #7928ca, #ff0080);
      border: 2px solid rgba(255,255,255,.35);
      box-shadow: 0 0 0 3px rgba(121,40,202,.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: .92rem;
      color: #fff;
      flex-shrink: 0;
      transition: border-color .2s, box-shadow .2s;
    }
    .navbar .nav-link:hover .nav-avatar-photo,
    .navbar .nav-link:focus .nav-avatar-photo {
      border-color: rgba(255,255,255,.65);
      box-shadow: 0 0 0 4px rgba(121,40,202,.5);
    }
    .navbar .nav-avatar-name {
      font-size: .82rem;
      font-weight: 600;
      color: rgba(255,255,255,.85);
      line-height: 1;
      max-width: 130px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    /* Dropdown menu dark */
    .navbar .dropdown-menu {
      background: #1e1e2e;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: .5rem;
      box-shadow: 0 8px 28px rgba(0,0,0,.45);
      padding: .4rem 0;
      min-width: 160px;
    }
    .navbar .dropdown-menu .dropdown-item {
      color: rgba(255,255,255,.72);
      font-size: .84rem;
      padding: .5rem 1.1rem;
      transition: background .15s, color .15s;
    }
    .navbar .dropdown-menu .dropdown-item:hover {
      background: rgba(255,255,255,.08);
      color: #fff;
    }
    .navbar .dropdown-menu .dropdown-divider {
      border-color: rgba(255,255,255,.1);
      margin: .3rem 0;
    }

    /* ══ SIDEBAR — mejoras visuales ══════════════════════ */

    /* sidebar-wrapper como columna flex */
    .sidebar .sidebar-wrapper {
      display: flex !important;
      flex-direction: column !important;
      height: 100% !important;
    }

    /* Lista de nav: crece y tiene scroll suave */
    .sidebar .nav {
      flex: 1 !important;
      overflow-y: auto !important;
      overflow-x: hidden !important;
    }
    .sidebar .nav::-webkit-scrollbar { width: 3px; }
    .sidebar .nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar .nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.2); border-radius: 4px; }

    /* Items nav — forma píldora */
    .sidebar .nav > li > a {
      border-radius: .5rem !important;
      margin: 2px 10px !important;
      padding: .6rem 1rem !important;
      display: flex !important;
      align-items: center !important;
      gap: .75rem !important;
      opacity: 1 !important;
      transition: background .18s !important;
    }
    .sidebar .nav > li > a:hover {
      background: rgba(255,255,255,.1) !important;
      box-shadow: none !important;
    }
    .sidebar .nav > li.active > a {
      background: rgba(255,255,255,.18) !important;
      box-shadow: 0 3px 12px rgba(0,0,0,.2) !important;
    }
    .sidebar .nav > li > a i {
      font-size: .95rem !important;
      width: 20px !important;
      text-align: center !important;
      flex-shrink: 0 !important;
    }
    .sidebar .nav > li > a p {
      font-size: .82rem !important;
      font-weight: 500 !important;
      margin: 0 !important;
      white-space: nowrap !important;
      overflow: hidden !important;
    }

    /* Etiquetas de sección */
    .sidebar .nav > li.nav-section > p {
      font-size: .6rem !important;
      font-weight: 700 !important;
      letter-spacing: .12em !important;
      text-transform: uppercase !important;
      color: rgba(255,255,255,.4) !important;
      padding: 1rem 1.5rem .3rem !important;
      margin: 0 !important;
      pointer-events: none;
    }

    /* Usuario al pie del sidebar */
    .sidebar-user {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      gap: .7rem;
      padding: .85rem 1.2rem;
      border-top: 1px solid rgba(255,255,255,.1);
      overflow: hidden;
    }
    .sidebar-user-avatar {
      width: 32px; height: 32px; border-radius: 50%;
      background: rgba(255,255,255,.2);
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: .8rem; color: #fff; flex-shrink: 0;
    }
    .sidebar-user-info { overflow: hidden; }
    .sidebar-user-info .sb-name {
      font-size: .75rem; font-weight: 600; color: rgba(255,255,255,.9);
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .sidebar-user-info .sb-role { font-size: .64rem; color: rgba(255,255,255,.5); }

    /* ── Modo mini (colapsado — solo iconos) ─────────── */
    body.sidebar-mini .sidebar { width: 72px !important; }
    body.sidebar-mini .sidebar .logo {
      padding-left: .65rem !important;
      padding-right: .65rem !important;
      text-align: center;
    }
    body.sidebar-mini .sidebar .logo .logo-normal { display: none !important; }
    body.sidebar-mini .sidebar .nav > li > a {
      justify-content: center !important;
      margin: 2px 6px !important;
      padding: .65rem .5rem !important;
      gap: 0 !important;
    }
    body.sidebar-mini .sidebar .nav > li > a p { display: none !important; }
    body.sidebar-mini .sidebar .nav > li.nav-section { display: none !important; }
    body.sidebar-mini .sidebar-user-info { display: none !important; }
    body.sidebar-mini .sidebar-user { padding: .85rem .7rem !important; justify-content: center; }
    body.sidebar-mini .main-panel { width: calc(100% - 72px) !important; }

    /* Transición suave al colapsar */
    .sidebar     { transition: width .28s cubic-bezier(.4,0,.2,1) !important; }
    .main-panel  { transition: width .28s cubic-bezier(.4,0,.2,1) !important; }

    /* ── Overlay mobile ────────────────────────────────── */
    .sidebar-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.55); z-index: 990;
    }
    body.nav-open .sidebar-overlay { display: block; }

    /* ── Logo del sidebar: flex para alojar el botón ────── */
    .sidebar .logo {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      padding: .9rem 1rem .9rem 1.25rem !important;
    }
    .sidebar .logo .logo-normal {
      flex: 1 !important;
    }

    /* ── Botón toggle dentro del logo (desktop) ─────────── */
    .sidebar-logo-toggle {
      background: rgba(255,255,255,.12);
      border: 1px solid rgba(255,255,255,.2);
      border-radius: .4rem;
      width: 30px; height: 30px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; flex-shrink: 0;
      color: rgba(255,255,255,.85); font-size: .8rem;
      transition: background .2s;
    }
    .sidebar-logo-toggle:hover { background: rgba(255,255,255,.24); }

    /* En modo mini: solo mostrar el botón, centrado */
    body.sidebar-mini .sidebar .logo {
      justify-content: center !important;
      padding: .85rem .5rem !important;
    }
    body.sidebar-mini .sidebar .logo .logo-mini,
    body.sidebar-mini .sidebar .logo .logo-normal { display: none !important; }

    /* ── Botón toggle en navbar (solo mobile) ────────────── */
    .navbar-mobile-toggle {
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: .4rem;
      width: 34px; height: 34px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; flex-shrink: 0;
      transition: background .2s;
      margin-right: .75rem;
    }
    .navbar-mobile-toggle:hover { background: rgba(255,255,255,.22); }
    .navbar-mobile-toggle i { color: rgba(255,255,255,.85); font-size: .85rem; }
  </style>
</head>

<body class="">
<div class="wrapper">

  {{-- Overlay para cerrar sidebar en mobile --}}
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  {{-- SIDEBAR --}}
  <div class="sidebar" data-color="purple">
    <div class="sidebar-wrapper">

      {{-- Logo + botón toggle (desktop) --}}
      <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text logo-mini">
          <i class="tim-icons icon-bullet-list-67"></i>
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
          {{ config('app.name') }}
        </a>
        <button id="sidebarToggleBtn" type="button"
                class="sidebar-logo-toggle d-none d-lg-flex"
                title="Contraer / expandir menú">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      {{-- Navegación --}}
      <ul class="nav">

        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @if(Auth::user()->isAdmin())
        <li class="nav-section">
          <p>Gestión</p>
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

        <li class="nav-section">
          <p>Cuenta</p>
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

      {{-- Usuario al pie --}}
      <div class="sidebar-user">
        <div class="sidebar-user-avatar">
          {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>
        <div class="sidebar-user-info">
          <div class="sb-name">{{ Auth::user()->name }}</div>
          <div class="sb-role">{{ Auth::user()->role === 'admin' ? 'Administrador' : 'Usuario' }}</div>
        </div>
      </div>

    </div>
  </div>

  {{-- MAIN PANEL --}}
  <div class="main-panel">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
      <div class="container-fluid">
        <div class="navbar-wrapper" style="display:flex;align-items:center">
          {{-- Botón visible solo en mobile (sidebar está oculto en mobile) --}}
          <button id="sidebarToggleBtnMobile" type="button"
                  class="navbar-mobile-toggle d-flex d-lg-none"
                  title="Abrir menú">
            <i class="fas fa-bars"></i>
          </button>
          <a class="navbar-brand" href="#" style="padding:0;margin:0">{{ $title }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="ml-auto navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" style="gap:.55rem;padding-top:.4rem;padding-bottom:.4rem"
                 href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="nav-avatar-photo">
                  {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                </div>
                <span class="nav-avatar-name d-none d-lg-block">{{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="mr-2 tim-icons icon-settings" style="font-size:.8rem"></i> Mi Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="mr-2 tim-icons icon-button-power" style="font-size:.8rem"></i> Cerrar Sesión
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
          <div class="gap-2 mb-4 alert alert-bd-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="ml-auto close" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif
        @if(session('error'))
          <div class="gap-2 mb-4 alert alert-bd-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="ml-auto close" data-dismiss="alert"><span>&times;</span></button>
          </div>
        @endif

        {{ $slot }}

      </div>
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
            <div class="mx-auto text-center col-sm-6 text-muted" style="font-size:.8rem">
            © {{ date('Y') }} {{ config('app.name') }}
            </div>
          {{-- <div class="text-right col-sm-6 text-muted" style="font-size:.8rem">
            Diseño por <a href="https://www.creative-tim.com" target="_blank" class="text-muted font-weight-bold">Creative Tim</a>
          </div> --}}
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

<script>
(function () {
  var MINI_KEY      = 'bd_sidebar_mini';
  var body          = document.body;
  var btnDesktop    = document.getElementById('sidebarToggleBtn');       /* en logo sidebar, solo desktop */
  var btnMobile     = document.getElementById('sidebarToggleBtnMobile'); /* en navbar, solo mobile */
  var overlay       = document.getElementById('sidebarOverlay');

  /* ── Restaurar estado al cargar (solo desktop) ── */
  if (window.innerWidth > 991 && localStorage.getItem(MINI_KEY) === '1') {
    body.classList.add('sidebar-mini');
  }

  /* ── Desktop: colapsar / expandir a modo icono ── */
  if (btnDesktop) {
    btnDesktop.addEventListener('click', function () {
      var mini = body.classList.toggle('sidebar-mini');
      localStorage.setItem(MINI_KEY, mini ? '1' : '0');
    });
  }

  /* ── Mobile: mostrar / ocultar sidebar con overlay ── */
  if (btnMobile) {
    btnMobile.addEventListener('click', function () {
      body.classList.toggle('nav-open');
    });
  }

  /* Cerrar sidebar mobile al tocar el overlay */
  if (overlay) {
    overlay.addEventListener('click', function () {
      body.classList.remove('nav-open');
    });
  }

  /* Cerrar sidebar mobile al navegar */
  document.querySelectorAll('.sidebar .nav a').forEach(function (link) {
    link.addEventListener('click', function () {
      if (window.innerWidth <= 991) {
        body.classList.remove('nav-open');
      }
    });
  });
})();
</script>
</body>
</html>

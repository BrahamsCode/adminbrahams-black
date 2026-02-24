<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Iniciar Sesión — {{ config('app.name') }}</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
  <link href="{{ asset('black-dashboard/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('black-dashboard/css/black-dashboard.min.css') }}" rel="stylesheet" />
  <style>
    body,html{height:100%;font-family:'Poppins',sans-serif;}
    .login-page{min-height:100vh;display:flex;align-items:center;justify-content:center;background:#1e1e2e;}
    .login-card{width:100%;max-width:420px;background:#27293d;border-radius:.8rem;border:1px solid rgba(255,255,255,.1);overflow:hidden;}
    .login-header{background:linear-gradient(87deg,#7928ca,#ff0080);padding:2.5rem 2rem;text-align:center;}
    .login-body{padding:2rem;}
    .bd-label{font-size:.75rem;font-weight:600;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.35rem;display:block;}
    .bd-input{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.15);border-radius:.4285rem;color:#fff;padding:.5rem .85rem;font-size:.875rem;width:100%;transition:border-color .2s,box-shadow .2s;}
    .bd-input:focus{background:rgba(255,255,255,.1);border-color:#e14eca;box-shadow:0 0 0 3px rgba(225,78,202,.2);outline:none;color:#fff;}
    .bd-input::placeholder{color:rgba(255,255,255,.35);}
  </style>
</head>
<body>
<div class="login-page">
  <div class="login-card">
    <div class="login-header">
      <i class="tim-icons icon-bullet-list-67 text-white mb-2" style="font-size:2.5rem"></i>
      <h4 class="text-white font-weight-bold mb-1">{{ config('app.name') }}</h4>
      <p class="text-white mb-0" style="opacity:.7;font-size:.875rem">Ingresa tus credenciales</p>
    </div>
    <div class="login-body">
      @if(session('status'))
        <div class="alert alert-info mb-3" style="font-size:.85rem">{{ session('status') }}</div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="bd-label">Correo electrónico</label>
          <input type="email" name="email" value="{{ old('email') }}" class="bd-input"
                 required autofocus placeholder="correo@ejemplo.com">
          @error('email')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="bd-label">Contraseña</label>
          <input type="password" name="password" class="bd-input" required placeholder="••••••••">
          @error('password')<div class="text-danger mt-1" style="font-size:.78rem">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex align-items-center mb-4">
          <input type="checkbox" name="remember" id="remember" class="mr-2">
          <label for="remember" class="mb-0 text-muted" style="font-size:.85rem;cursor:pointer">Recuérdame</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-3">Iniciar Sesión</button>
        @if(Route::has('register'))
          <p class="text-center text-muted mb-0" style="font-size:.85rem">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-primary font-weight-bold">Regístrate</a>
          </p>
        @endif
      </form>
    </div>
  </div>
</div>
<script src="{{ asset('black-dashboard/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('black-dashboard/js/core/bootstrap.min.js') }}"></script>
</body>
</html>

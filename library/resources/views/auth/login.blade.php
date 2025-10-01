@extends('layouts.app')
@section('title','Sign In')

@section('content')
<div class="container" style="max-width: 520px;">
  <div class="text-center mb-4">
    <h3 class="fw-bold mb-1">Welcome Back</h3>
    <p class="text-muted">Sign in to continue to Library</p>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label">Email *</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
          @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
          <label class="form-label">Password *</label>
          <input type="password" name="password" class="form-control" required>
          @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a>
          @endif
        </div>

        <button class="btn btn-dark w-100">Sign In</button>
      </form>

      <div class="text-center mt-3 small">
        Don’t have an account?
        <a href="{{ route('register') }}" class="fw-semibold">Create one</a>
      </div>
    </div>
  </div>
</div>
@endsection

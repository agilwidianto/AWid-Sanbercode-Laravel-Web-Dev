@extends('layouts.app')
@section('title','Create Account')

@section('content')
<div class="container" style="max-width: 520px;">
  <div class="text-center mb-4">
    <h3 class="fw-bold mb-1">Create your account</h3>
    <p class="text-muted">Join the Library and start exploring books</p>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label">Name *</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
          @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Email *</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Password *</label>
          <input type="password" name="password" class="form-control" required>
          @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
          <label class="form-label">Confirm Password *</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-dark w-100">Create Account</button>
      </form>

      <div class="text-center mt-3 small">
        Already have an account?
        <a href="{{ route('login') }}" class="fw-semibold">Sign in</a>
      </div>
    </div>
  </div>
</div>
@endsection

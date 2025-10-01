@extends('layouts.app')
@section('title','Create Genre')

@section('content')
<div class="container" style="max-width: 720px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Create Genre</h3>
    <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">← Back</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('genres.store') }}" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
          @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
          <button class="btn btn-dark">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')
@section('title','Edit Genre')

@section('content')
<div class="container" style="max-width: 720px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Edit Genre</h3>
    <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">← Back</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('genres.update',$genre) }}" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name',$genre->name) }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" rows="3" class="form-control">{{ old('description',$genre->description) }}</textarea>
          @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <div></div>
          <div class="d-flex gap-2">
            <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button class="btn btn-dark">Update</button>
          </div>
        </div>
      </form>

      {{-- Delete genre (admin only) --}}
      @auth
        @if(auth()->user()->isAdmin())
          <hr>
          <form action="{{ route('genres.destroy',$genre) }}" method="POST" onsubmit="return confirm('Delete this genre?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Delete Genre</button>
          </form>
        @endif
      @endauth
    </div>
  </div>
</div>
@endsection

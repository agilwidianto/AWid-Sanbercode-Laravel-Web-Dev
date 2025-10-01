@extends('layouts.app')
@section('title','Create Book')

@section('content')
<div class="container" style="max-width: 820px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Create Book</h3>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">← Back</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label">Title *</label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
          @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Summary</label>
          <textarea name="summary" rows="4" class="form-control" placeholder="Short description...">{{ old('summary') }}</textarea>
          @error('summary')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Genre *</label>
            <select name="genre_id" class="form-select" required>
              <option value="">-- Select Genre --</option>
              @foreach($genres as $g)
                <option value="{{ $g->id }}" @selected(old('genre_id')==$g->id)>{{ $g->name }}</option>
              @endforeach
            </select>
            @error('genre_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Stock *</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock',0) }}" min="0" required>
            @error('stock')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="mt-3">
          <label class="form-label">Cover (jpg, jpeg, png, webp • max 2MB)</label>
          <input type="file" name="cover" class="form-control" accept="image/*">
          @error('cover')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
          <button class="btn btn-dark">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

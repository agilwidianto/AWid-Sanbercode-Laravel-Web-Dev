@extends('layouts.app')
@section('title','Edit Book')

@section('content')
<div class="container" style="max-width: 920px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Edit Book</h3>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">← Back</a>
  </div>

  <div class="row g-4">
    {{-- Left: Form --}}
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <form method="POST" action="{{ route('books.update',$book) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Title *</label>
              <input type="text" name="title" class="form-control" value="{{ old('title',$book->title) }}" required>
              @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Summary</label>
              <textarea name="summary" rows="4" class="form-control">{{ old('summary',$book->summary) }}</textarea>
              @error('summary')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Genre *</label>
                <select name="genre_id" class="form-select" required>
                  @foreach($genres as $g)
                    <option value="{{ $g->id }}" @selected(old('genre_id',$book->genre_id)==$g->id)>{{ $g->name }}</option>
                  @endforeach
                </select>
                @error('genre_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">Stock *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock',$book->stock) }}" min="0" required>
                @error('stock')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label d-flex justify-content-between">
                <span>Replace Cover (opsional)</span>
                <small class="text-muted">jpg, jpeg, png, webp • max 2MB</small>
              </label>
              <input type="file" name="cover" class="form-control" accept="image/*">
              @error('cover')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Cancel</a>
              <button class="btn btn-dark">Update</button>
            </div>
          </form>

          {{-- Delete (opsional, admin) --}}
          @auth
            @if(auth()->user()->isAdmin())
              <hr>
              <form action="{{ route('books.destroy',$book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger">Delete Book</button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    </div>

    {{-- Right: Preview cover --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Current Cover</h6>
          <div class="ratio ratio-3x4 border rounded overflow-hidden">
            @if($book->cover_path)
              <img src="{{ asset('storage/'.$book->cover_path) }}" alt="{{ $book->title }}" class="w-100 h-100 object-fit-cover">
            @else
              <img src="https://via.placeholder.com/400x500?text=No+Cover" class="w-100 h-100 object-fit-cover" alt="no cover">
            @endif
          </div>
          <div class="small text-muted mt-2">
            * Upload file baru untuk mengganti cover.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

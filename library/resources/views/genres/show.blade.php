@extends('layouts.app')
@section('title', $genre->name)

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="mb-1">{{ $genre->name }}</h3>
      @if($genre->description)
        <p class="text-muted mb-0">{{ $genre->description }}</p>
      @endif
    </div>
    <div>
      <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">← Back</a>
      @auth
        @if(auth()->user()->isAdmin())
          <a href="{{ route('genres.edit',$genre) }}" class="btn btn-dark ms-2">Edit Genre</a>
        @endif
      @endauth
    </div>
  </div>

  <hr class="mb-4">

  <h5 class="mb-3">Books in “{{ $genre->name }}”</h5>

  @if($books->count())
    <div class="row g-4">
      @foreach($books as $b)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card h-100 border rounded-3">
            <a href="{{ route('books.show',$b) }}" class="text-decoration-none">
              @if($b->cover_path)
                <img src="{{ asset('storage/'.$b->cover_path) }}" class="card-img-top" alt="{{ $b->title }}">
              @else
                <img src="https://via.placeholder.com/400x500?text=No+Cover" class="card-img-top" alt="no cover">
              @endif
            </a>
            <div class="card-body">
              <h6 class="fw-bold mb-1">
                <a href="{{ route('books.show',$b) }}" class="text-decoration-none">{{ $b->title }}</a>
              </h6>
              <p class="text-muted small mb-0">Stock: {{ $b->stock }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $books->links() }}
    </div>
  @else
    <div class="alert alert-secondary">Belum ada buku pada genre ini.</div>
  @endif
</div>
@endsection

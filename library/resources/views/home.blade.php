@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="container">

  {{-- Books --}}
  <section id="best-selling-items" class="mb-5">
    <div class="d-md-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-3 mb-md-0">Books</h3>
      <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">View All</a>
    </div>

    <div class="row g-4">
      @forelse($books as $b)
        <div class="col-6 col-md-3">
          <div class="card h-100 border rounded-3">
            @if($b->cover_path)
              <img src="{{ asset('storage/'.$b->cover_path) }}" class="card-img-top" alt="{{ $b->title }}">
            @else
              <img src="https://via.placeholder.com/400x500?text=No+Cover" class="card-img-top" alt="no cover">
            @endif
            <div class="card-body">
              <h6 class="fw-bold mb-1">
                <a href="{{ route('books.show',$b) }}" class="text-decoration-none">{{ $b->title }}</a>
              </h6>
              <p class="text-muted mb-2 small">Genre: <a href="{{ route('genres.show',$b->genre) }}" class="text-decoration-none">{{ $b->genre->name }}</a></p>
              <p class="mb-0 small">Stock: {{ $b->stock }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12"><div class="alert alert-secondary">Belum ada buku.</div></div>
      @endforelse
    </div>
  </section>

  {{-- Categories / Genres --}}
  <section id="categories">
    <div class="mb-3">
      <h3>Categories</h3>
    </div>
    <div class="row">
      @forelse($genres as $g)
        <div class="col-md-4">
          <div class="card mb-4 border-0 rounded-3 position-relative">
            <a href="{{ route('genres.show',$g) }}" class="text-decoration-none">
              {{-- Jika kamu punya gambar genre, tampilkan di sini. Sementara placeholder. --}}
              <img src="https://picsum.photos/seed/{{ $g->id }}/600/400" class="img-fluid rounded-3" alt="{{ $g->name }}">
              <h6 class="position-absolute bottom-0 bg-primary m-4 py-2 px-3 rounded-3">
                <span class="text-white">{{ $g->name }}</span>
              </h6>
            </a>
          </div>
        </div>
      @empty
        <div class="col-12"><div class="alert alert-secondary">Belum ada genre.</div></div>
      @endforelse
    </div>
  </section>

</div>
@endsection

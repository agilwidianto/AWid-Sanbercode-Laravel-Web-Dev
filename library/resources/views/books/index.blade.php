@extends('layouts.app')
@section('title','Books')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Books</h3>
    @auth
      @if(auth()->user()->isAdmin())
        <a href="{{ route('books.create') }}" class="btn btn-dark">+ Add Book</a>
      @endif
    @endauth
  </div>

  @if($books->count())
    <div class="row g-4">
      @foreach($books as $b)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card h-100 border-0 shadow-sm">
            <a href="{{ route('books.show',$b) }}" class="text-decoration-none">
              @if($b->cover_path)
                <img
                  src="{{ Storage::url($b->cover_path) }}"
                  alt="{{ $b->title }}"
                  class="book-cover shadow-sm"
                >
              @else
                <img
                  src="https://via.placeholder.com/150x220?text=No+Cover"
                  alt="no cover"
                  class="book-cover shadow-sm"
                >
              @endif
            </a>
            <div class="card-body">
              <h6 class="fw-bold mb-1">
                <a href="{{ route('books.show',$b) }}" class="text-decoration-none">{{ $b->title }}</a>
              </h6>
              <div class="text-muted small">
                Genre:
                <a class="text-decoration-none" href="{{ route('genres.show',$b->genre) }}">{{ $b->genre->name }}</a>
              </div>
              <div class="small">Stock: {{ $b->stock }}</div>
            </div>
            @auth
              @if(auth()->user()->isAdmin())
                <div class="card-footer bg-white border-0 d-flex gap-2">
                  <a href="{{ route('books.edit',$b) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                  <form action="{{ route('books.destroy',$b) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                  </form>
                </div>
              @endif
            @endauth
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $books->links() }}
    </div>
  @else
    <div class="alert alert-secondary">Belum ada buku.</div>
  @endif
</div>
@endsection

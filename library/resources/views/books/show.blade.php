@extends('layouts.app')
@section('title', $book->title)

@section('content')
<div class="container py-4">

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-start mb-4">
    <div class="d-flex gap-3">
      <div class="rounded overflow-hidden shadow-sm bg-light flex-shrink-0" style="width:180px; height:260px;">
        @if(!empty($book->cover_path))
          <img src="{{ asset('storage/'.$book->cover_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $book->title }}">
        @else
          <img src="https://via.placeholder.com/400x500?text=No+Cover" class="w-100 h-100 object-fit-cover" alt="no cover">
        @endif
      </div>
      <div>
        <h3 class="mb-1">{{ $book->title }}</h3>

        @php $genre = $book->genre; @endphp
        <div class="mb-2">
          <span class="text-muted me-1">Genre:</span>

          @if($genre) 
            {{-- route() bisa terima model Genre langsung (implicit binding) --}}
            <a class="badge text-bg-secondary text-decoration-none"
              href="{{ route('genres.show', $genre) }}">
              {{ $genre->name }}
            </a>
          @else
            <span class="badge text-bg-secondary">Uncategorized</span>
          @endif
        </div>


        <div class="mb-3">
          Stock: <strong>{{ $book->stock }}</strong>
        </div>

        @if($book->summary)
          <p class="mb-0 text-secondary">{{ $book->summary }}</p>
        @endif
      </div>
    </div>

    <div class="text-end">
      <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">← Back</a>
      @auth
        @if(method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin())
          <a href="{{ route('books.edit', $book) }}" class="btn btn-dark ms-2">Edit Book</a>
        @endif
      @endauth
    </div>
  </div>

  <hr class="my-4">

  {{-- Content --}}
  <div class="row g-4">
    <div class="col-lg-8">

      {{-- Form komentar --}}
      <h5 class="mb-3">Comments</h5>

      @auth
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <form method="POST" action="{{ route('comments.store', $book) }}">
              @csrf
              <div class="mb-2">
                <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar…">{{ old('content') }}</textarea>
                @error('content') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
              </div>
              <div class="d-flex justify-content-end">
                <button class="btn btn-dark">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      @else
        <div class="alert alert-info">
          Silakan <a href="{{ route('login') }}">login</a> untuk menulis komentar.
        </div>
      @endauth

      {{-- List komentar --}}
      @forelse($book->comments as $c)
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="small text-muted">
                <strong class="text-dark">{{ $c->user->name }}</strong>
                • {{ $c->created_at->diffForHumans() }}
              </div>

              @auth
                @if(auth()->id() === $c->user_id || (method_exists(auth()->user(),'isAdmin') && auth()->user()->isAdmin()))
                  {{-- Jika rute destroy adalah /comments/{comment}, cukup kirim $c --}}
                  <form method="POST" action="{{ route('comments.destroy', $c) }}" onsubmit="return confirm('Hapus komentar ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-link text-danger p-0 small" type="submit">Hapus</button>
                  </form>
                @endif
              @endauth
            </div>

            <div class="mt-2">{{ $c->content }}</div>
          </div>
        </div>
      @empty
        <div class="alert alert-secondary">Belum ada komentar.</div>
      @endforelse
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Info Buku</h6>
          <ul class="list-unstyled small mb-0">
            <li>Genre:
              @if($genre->exists)
                <a href="{{ route('genres.show', $genre) }}" class="text-decoration-none">{{ $genre->name }}</a>
              @else
                <span class="text-muted">Uncategorized</span>
              @endif
            </li>
            <li>Stock: {{ $book->stock }}</li>
            @if($book->user)
              <li>Uploader: {{ $book->user->name }}</li>
            @endif
            <li>Dibuat: {{ $book->created_at->format('d M Y') }}</li>
            <li>Update: {{ $book->updated_at->format('d M Y') }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

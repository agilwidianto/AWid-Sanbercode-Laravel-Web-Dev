@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Genres</h3>
    @auth
      @if(auth()->user()->isAdmin())
        <a href="{{ route('genres.create') }}" class="btn btn-dark">+ Add Genre</a>
      @endif
    @endauth
  </div>
    <div class="row">
        @foreach($genres as $genre)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                {{-- Gambar Genre --}}
                @if($genre->image)
                    <img src="{{ Storage::url($genre->image) }}" alt="{{ $genre->name }}" class="card-img-top genre-cover">
                @else
                    @switch($genre->name)
                        @case('Fantasy') @case('Fantasi')
                            <img src="https://images.unsplash.com/photo-1746048059073-f0234df06f26?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Fantasy" class="card-img-top genre-cover">
                            @break
                        @case('Romance') @case('Romansa')
                            <img src="https://images.unsplash.com/photo-1663868290007-e8df80a5b909?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Romance" class="card-img-top genre-cover">
                            @break
                        @case('Sejarah') @case('History')
                            <img src="https://images.unsplash.com/photo-1472173148041-00294f0814a2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="History" class="card-img-top genre-cover">
                            @break
                        @case('Sains') @case('Ilmiah') @case('Science')
                            <img src="https://images.unsplash.com/photo-1732304722020-be33345c00c3?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sains" class="card-img-top genre-cover">
                            @break
                        @case('Horror')
                            <img src="https://images.unsplash.com/photo-1635007129134-814c0b7c777e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Horror" class="card-img-top genre-cover">
                            @break
                        @default
                            <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image" class="card-img-top genre-cover">
                    @endswitch
                @endif

                {{-- Isi Card --}}
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('genres.show', $genre) }}">{{ $genre->name }}</a>
                    </h5>
                    <p class="card-text">{{ Str::limit($genre->description, 100) }}</p>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('genres.edit', $genre) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

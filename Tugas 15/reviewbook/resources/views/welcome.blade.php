@extends('layouts.master')

@section('title','Dashboard')
@section('page_title','DASHBOARD')

@section('content')
  <h2>Selamat Datang {{ $first_name }} {{ $last_name }}</h2>
  <p>Terima kasih telah bergabung di Sanberbook. Social Media kita bersama</p>

  @php
    use Illuminate\Support\Str;
@endphp

<h3 class="mt-5 d-flex align-items-center justify-content-between">
  <span>Daftar Genre Terbaru</span>
  <span>
    <a href="{{ route('genre.index') }}" class="btn btn-outline-secondary btn-sm">Kelola Semua</a>
    <!-- <a href="{{ route('genre.create') }}" class="btn btn-primary btn-sm">+ Tambah Genre</a> -->
  </span>
</h3>

@if(isset($latestGenres) && $latestGenres->count())
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    @foreach($latestGenres as $g)
      <div class="col">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title mb-1">{{ $g->name }}</h5>
            <p class="card-text text-muted mb-3">{{ Str::limit($g->description, 100) }}</p>

            <!-- <a href="{{ route('genre.show', $g) }}" class="btn btn-sm btn-outline-primary">Detail</a>
            <a href="{{ route('genre.edit', $g) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('genre.destroy', $g) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Hapus genre \"{{ $g->name }}\"?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form> -->
          </div>
          <div class="card-footer small text-muted">
            {{ $g->created_at->diffForHumans() }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@else
  <div class="alert alert-info d-flex justify-content-between align-items-center">
    <span>Belum ada data genre.</span>
    <!-- <a href="{{ route('genre.create') }}" class="btn btn-primary btn-sm">+ Tambah Genre</a> -->
  </div>
@endif
@endsection

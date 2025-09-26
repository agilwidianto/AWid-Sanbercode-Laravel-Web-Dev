@extends('layouts.master')
@section('content')
<div class="container py-4">
  <h3 class="mb-3">{{ $genre->name }}</h3>
  <p class="text-muted">{{ $genre->description ?: '—' }}</p>
  <a href="{{ route('genre.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection

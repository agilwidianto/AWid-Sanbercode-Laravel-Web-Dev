@extends('layouts.master')

@section('title','Genre')
@section('page_title','Kelola Genre')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Daftar Genre</h3>
  <div class="d-flex gap-2">
    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">← Kembali</a>
    <a href="{{ route('genre.create') }}" class="btn btn-primary">+ Genre Baru</a>
  </div>
</div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($genres->count())
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>#</th><th>Nama</th><th>Deskripsi</th><th>Dibuat</th><th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($genres as $g)
          <tr>
            <td>{{ $loop->iteration + ($genres->currentPage()-1)*$genres->perPage() }}</td>
            <td><a href="{{ route('genre.show',$g) }}">{{ $g->name }}</a></td>
            <td class="text-muted">{{ Str::limit($g->description, 80) }}</td>
            <td>{{ $g->created_at->format('d M Y') }}</td>
            <td class="text-end">
              <a href="{{ route('genre.edit',$g) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('genre.destroy',$g) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Hapus genre ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{ $genres->links() }}
  @else
    <div class="alert alert-info">Belum ada data genre.</div>
  @endif
</div>
@endsection

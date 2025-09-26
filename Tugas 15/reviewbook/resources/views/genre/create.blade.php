@extends('layouts.master')
@section('content')
<div class="container py-4">
  <h3>Buat Genre Baru</h3>
  <form action="{{ route('genre.store') }}" method="POST">
    @include('genre._form')
  </form>
</div>
@endsection

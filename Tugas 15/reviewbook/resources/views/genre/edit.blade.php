@extends('layouts.master')
@section('content')
<div class="container py-4">
  <h3>Edit Genre</h3>
  <form action="{{ route('genre.update',$genre) }}" method="POST">
    @method('PUT')
    @include('genre._form', ['genre'=>$genre])
  </form>
</div>
@endsection

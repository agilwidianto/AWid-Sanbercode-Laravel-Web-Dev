@extends('layouts.master')

@section('title','Home')
@section('page_title','HOME')

@section('content')
  <h2>SanberBook</h2>
  <h4>Social Media Developer Santai Berkualitas</h4>
  <p>Belajar dan Berbagi agar hidup ini semakin santai berkualitas</p>

  <h5 class="mt-4">Benefit Join di SanberBook</h5>
  <ul>
    <li>Mendapatkan motivasi dari sesama developer</li>
    <li>Sharing knowledge dari para mastah Sanber</li>
    <li>Dibuat oleh calon web developer terbaik</li>
  </ul>

  <h5 class="mt-4">Cara Bergabung ke SanberBook</h5>
  <ol>
    <li>Mengunjungi Website ini</li>
    <li>mendaftar di <a href="{{ url('/register') }}">Form Sign Up</a></li>
    <li>Dibuat oleh calon web developer terbaik</li>
  </ol>
@endsection

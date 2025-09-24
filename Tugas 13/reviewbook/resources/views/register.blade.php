@extends('layouts.master')

@section('title','Register')
@section('page_title','REGISTER')

@section('content')
  <form action="{{ url('/welcome') }}" method="POST" class="col-lg-6 col-md-8">
    @csrf

    <div class="mb-3">
      <label class="form-label">First name:</label>
      <input type="text" name="first_name" class="form-control" value="" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Last name:</label>
      <input type="text" name="last_name" class="form-control" value="" required>
    </div>

    <div class="mb-3">
      <label class="form-label d-block">Gender:</label>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Male">
        <label class="form-check-label">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Female">
        <label class="form-check-label">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Other">
        <label class="form-check-label">Other</label>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Nationality:</label>
      <select name="nationality" class="form-select">
        <option>Indonesian</option>
        <option>Malaysian</option>
        <option>Singaporean</option>
        <option>Other</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label d-block">Language Spoken:</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="language[]" value="Bahasa Indonesia">
        <label class="form-check-label">Bahasa Indonesia</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="language[]" value="English">
        <label class="form-check-label">English</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="language[]" value="Other">
        <label class="form-check-label">Other</label>
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label">Bio:</label>
      <textarea name="bio" rows="3" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success px-4">Sign Up</button>
  </form>
@endsection

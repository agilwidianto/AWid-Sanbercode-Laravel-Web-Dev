@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

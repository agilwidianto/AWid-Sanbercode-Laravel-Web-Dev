@extends('layouts.app')
@section('title','Dashboard')

@section('content')
<div class="container py-5">
    {{-- Welcome Message --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold">Welcome to Library System</h2>
        <p class="lead">
            Hello, <strong>{{ auth()->user()->name }}</strong> 👋 <br>
            You are logged in as <span class="badge bg-dark text-capitalize">{{ auth()->user()->role ?? 'user' }}</span>.
        </p>
    </div>

    {{-- Library Info --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">📚 About This Library</h5>
                    <p class="card-text text-muted">
                        This is a simple Library Management System. 
                        You can browse book collections, explore genres, and leave comments on your favorite books.
                    </p>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">🚀 Quick Access</h5>
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-dark btn-lg">Browse Books</a>
                        <a href="{{ route('genres.index') }}" class="btn btn-outline-primary btn-lg">Explore Genres</a>
                    </div>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-lg">Manage Users</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- {{-- Footer Info --}}
    <div class="mt-5 text-center text-muted small">
        <p>&copy; {{ date('Y') }} Library System — All rights reserved.</p>
    </div> -->
</div>
@endsection

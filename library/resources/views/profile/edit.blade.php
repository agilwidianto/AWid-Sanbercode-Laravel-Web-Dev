@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Edit Profile</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.upsert') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="age" class="form-label fw-bold">Age</label>
                            <input type="number" class="form-control" id="age" name="age" 
                                   value="{{ old('age', $profile->age ?? '') }}" placeholder="Enter your age">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="{{ old('address', $profile->address ?? '') }}" placeholder="Enter your address">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-muted small">
                    Last updated: {{ now()->format('d M Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

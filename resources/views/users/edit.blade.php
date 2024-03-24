@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter username" value="{{ old('name', $user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email', $user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email_verified_at">Email Verified At:</label>
                        <input type="datetime-local" class="form-control @error('email_verified_at') is-invalid @enderror" id="email_verified_at" name="email_verified_at" value="{{ old('email_verified_at', $user->email_verified_at ? $user->email_verified_at->format('Y-m-d\TH:i') : null) }}">
                        @error('email_verified_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label">Phone Number:</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number', $user->phone_number) }}">
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="subscription_end_date">Subscription End Date:</label>
                        <input type="datetime-local" class="form-control @error('subscription_end_date') is-invalid @enderror" id="subscription_end_date" name="subscription_end_date" value="{{ old('subscription_end_date', $user->subscription_end_date ? $user->subscription_end_date->format('Y-m-d\TH:i') : null) }}">
                        @error('subscription_end_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="avatar">User's profile picture: (Leave empty to keep current picture)</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                        @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password: (Leave empty to keep current password)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password: (Leave empty to keep current password)</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="mb-3">
                        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" {{ $user->is_admin ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="is_admin">Make this user admin</label>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
            </form>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h3>Edit Profile</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <label for="name" class="col-md-2 col-form-label">Name</label>
                <div class="col-md-6">
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="col-md-2 col-form-label">Username</label>
                <div class="col-md-6">
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-6">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="bio" class="col-md-2 col-form-label">Bio</label>
                <div class="col-md-6">
                    <textarea name="bio" rows="3" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="avatar" class="col-md-2 col-form-label">Avatar</label>
                <div class="col-md-6">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="No image" class="img-thumbnail mb-2" width="100">
                    @endif
                    <input type="file" name="avatar" class="form-control" >
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label for="password" class="col-md-2 col-form-label">Password</label>
                <div class="col-md-6">
                    <input type="password" name="password"  class="form-control">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="password_confirmation" class="col-md-2 col-form-label">Confirm Password</label>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation"  class="form-control">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
            </div>
            <div class="row">
                <div class="offset-md-2 col-md-6">
                    <button class="btn btn-primary">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
@endsection
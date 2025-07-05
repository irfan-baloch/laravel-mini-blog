@extends('layouts.app');
@section('content')
    <div class="container mt-4">
        <h2>Update Tag</h2>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.tags.update', $tag->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Tag name" value="{{ old('name', $tag->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Update Tag</button>
        </form>
    </div>
@endsection
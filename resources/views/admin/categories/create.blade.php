@extends('layouts.app');
@section('content')
    <div class="container mt-4">
        <h2>Create New Category</h2>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Category Name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Submit Category</button>
        </form>
    </div>
@endsection
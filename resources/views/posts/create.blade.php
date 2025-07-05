@extends('layouts.app');
@section('content')
    <div class="container mt-4">
        <h2>Create New Post</h2>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Post Title" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body">Content</label>
                <textarea name="body" rows="5" class="form-control" placeholder="Enter Content">{{ old('body') }}</textarea>
                @error('body')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title">Tags (Select multiple)</label>
                <select name="tags[]" multiple class="form-control">
                    {{-- <option value="">Select Category</option> --}}
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image">Featured Image</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary">Submit Post</button>
        </form>
    </div>
@endsection
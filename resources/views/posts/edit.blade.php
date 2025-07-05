@extends('layouts.app');
@section('content')
    <div class="container mt-4">
        <h2>Update Post</h2>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Post Title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body">Content</label>
                <textarea name="body" rows="5" class="form-control" placeholder="Enter Content">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title">Tags (Select multiple)</label>
                <select name="tags[]" multiple class="form-control">
                    {{-- <option value="">Select Category</option> --}}
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if ($post->tags->contains($tag->id)) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Current Image</label><br>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" width="200" class="mb-2">
                @else
                    <p>No image</p>
                @endif
            </div>
            <div class="mb-3">
                <label>Change Image (optional)</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
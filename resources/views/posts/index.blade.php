@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>My Posts</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success">+ New Post</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
        @endif

        @if ($posts->count())
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                @if ($post->category)
                                    <span class="badge bg-info mb-2">
                                        <a href="{{ route('category.posts', $post->category->slug) }}" class="text-white text-decoration-none">
                                            {{ $post->category->name }}
                                        </a>
                                    </span>
                                @endif
                                <h5 class="card-title"> {{ $post->title }} </h5>
                                <p class="card-text text-truncate"> {{ Str::limit($post->body, 100) }}</p>
                                <span class="badge
                                    @if($post->status == 'pending') bg-warning
                                    @elseif ($post->status == 'published') bg-success
                                    @else bg-danger
                                    @endif
                                "> {{ $post->status }} </span>
                                @if ($post->tags->count())
                                    <p>
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-secondary"><a href="{{ route('tag.posts',$tag->slug) }}"class="text-white text-decoration-none">{{ $tag->name }}</a></span>
                                        @endforeach
                                    </p>
                                @endif
                                <div class="mb-3">
                                    <small class="text-muted">
                                        By <a href="{{ route('user.profile', $post->user->username) }}" class="text-black text-decoration-none">{{ $post->user->name }}</a>
                                    </small>
                                </div>
                                <div class="mt-3">
                                    <a href="" class="btn btn-primary btn-sm disabled">View</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">You have not written any post yet.</p>
        @endif

    </div>
@endsection
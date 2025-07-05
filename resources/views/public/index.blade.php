@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4"> Latest Blog Posts</h2>

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
                                <p class="card-text text-muted">
                                    By <strong> {{ $post->user->name }} </strong> on {{ $post->created_at->format('M d, Y') }}
                                </p>
                                <p class="card-text"> {{ Str::limit($post->body, 100) }} </p>
                                @if ($post->tags->count())
                                    <p>
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-secondary"><a href="{{ route('tag.posts',$tag->slug) }}"class="text-white text-decoration-none">{{ $tag->name }}</a></span>
                                        @endforeach
                                    </p>
                                @endif
                                <div class=" mb-3">
                                    <small class="text-muted">
                                        By <a href="{{ route('user.profile', $post->user->username) }}" class="text-black text-decoration-none">{{ $post->user->name }}</a>
                                    </small>
                                </div>
                                <a href="{{ route('public.post', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <p>No published posts yet.</p>
        @endif

    </div>
@endsection
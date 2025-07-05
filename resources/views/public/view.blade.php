@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @if ($post->image)
            <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" style="max-height: 400px;">
        @endif
        <h2 class="mb-3"> {{ $post->title }} </h2>
        <p class="text-muted">
            By <strong> {{ $post->user->name }} </strong> on {{ $post->created_at->format('F d, Y') }}
        </p>
        <div class="mb-5">
            {!! nl2br(e($post->body)) !!}
        </div>
        <h4>Comments</h4>
        @foreach ($post->comments as $comment)
            <div class="bg-light p-2 mb-2 border rounded">
                <strong> {{ $comment->user->name }} </strong>
                <small class="text-muted"> {{ $comment->created_at->diffForHumans() }} </small>
                <p> {{ $comment->body }} </p>
            </div>
        @endforeach

        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="3" placeholder="Add comment..."></textarea>
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror    
                </div>            
                <button class="btn btn-primary mt-2">Post Comment</button>
            </form>
        @endauth
       
        <a href="{{ route('home') }}" class="btn btn-secondary mt-5">Back to Blog</a>
    </div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('storage/avatars/' . ($user->avatar ?? 'default.png')) }}" alt="No Image" class="rounded-circle me-3" width="80" height="80">
                <div>
                    <h4 class="mb-0"> {{ $user->name }} </h4>
                    <small class="text-muted">{{ $user->username }}</small>
                    <p class="mt-2"> {{ $user->bio }} </p>
                </div>
            </div>
        </div>
        <h5 class="mb-3">Posts By {{ $user->name }}</h5>
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5><a href="{{ route('public.post', $post->slug) }}">{{ $post->title }}</a></h5>
                    <small class="text-muted">{{ $post->created_at->timezone('Asia/Karachi')->format('M d, Y h:i:s A') }}</small>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}

        <h5>Recent Comments</h5>
        @if ($comments->count())
            <ul class="list-group mb-4">
                @foreach ($comments as $comment)
                    <li class="list-group-item">
                        <strong>On:</strong> <a href="{{ route('public.post', $comment->post->slug) }}">{{ $comment->post->title }}</a><br>
                        {{ $comment->body }}
                        <small class="text-muted d-block">{{ $comment->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No comments yet.</p>
        @endif

    </div>
@endsection
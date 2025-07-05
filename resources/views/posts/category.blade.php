@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Category : {{ $category->name }}</h2>
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h4><a href="{{ route('public.post', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="text-muted">By {{ $post->user->name }} . {{ $post->created_at->timezone('Asia/Karachi')->format('M d, Y h:i:s A') }}</p>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
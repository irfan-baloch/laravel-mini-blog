@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="display-4">404 - Not Found</h1>
    <p>The post you're looking for doesn't exist or hasn't been published.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Go to Blog</a>
</div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2>All Posts</h2>
        <form method="GET" action="{{ route('admin.posts.index') }}" class="mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search Title or Author</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="e.g. Laravel Tips" >
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">-- All Statuses --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <span class="badge
                                @if($post->status == 'published') bg-success
                                @elseif($post->status == 'pending') bg-warning
                                @else bg-danger
                                @endif
                            "> {{ ucfirst($post->status) }} </span>
                        </td>
                        <td> {{ $post->created_at->format('M d, Y') }} </td>
                        <td>
                            @if ($post->status == 'pending')
                                <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <small class="text-muted">No actions</small>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@endsection
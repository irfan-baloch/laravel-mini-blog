@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>All Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ New Category</a>
        </div>
        
        <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-8">
                    <label for="search" class="form-label">Search Name</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="e.g. Laravel Tips" >
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-bordered mt-3 text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td> {{ $category->created_at->timezone('Asia/Karachi')->format('M d, Y h:i:s A') }}
                        </td>
                        <td>
                            <div class="mt-1">
                                <a href="" class="btn btn-primary btn-sm disabled">View</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No category found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
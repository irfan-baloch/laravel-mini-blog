@extends('layouts.app')
@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h3>All Registered Users</h3>

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $user->name }} </td>
                        <td> {{ $user->email }} </td>
                        <td>
                            <span class="badge bg-{{ $user->role == 'admin' ? 'primary':'secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->status == 'active' ? 'success':'danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td> {{ $user->created_at->format('d M Y') }} </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.toggleRole', $user->id) }}" style="display: inline;" >
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Change role of this user?')">{{ $user->role == 'admin' ? 'Make User' : 'Make Admin' }}
                                </button> 
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
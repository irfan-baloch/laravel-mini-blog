@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="mb-4">Contact Messages</h2>
        @if ($messages->count())
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}</td>
                            <td> {{ $message->name }} </td>                                                        
                            <td> {{ $message->email }} </td>                                                        
                            <td> {{ $message->subject ?? '-' }} </td>
                            <td> {{ Str::limit($message->message, 60) }} </td>                            
                            <td> {{ $message->created_at->format('d M Y h:i A') }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $messages->links() }}
        @else
            <p>No messages found.</p>
        @endif
    </div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h1>Contact Us</h1>
        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="subject">Subject (Optional)</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="message">Message</label>
                <textarea name="message" rows="5" class="form-control">{{ old('message') }}</textarea>
                @error('message')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror                
            </div>
            <button class="btn btn-primary">Send Message</button>
        </form>

    </div>
@endsection
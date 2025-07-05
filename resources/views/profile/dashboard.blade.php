@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Welcome {{ auth()->user()->name }} to Mini-Blog </h1>
    </div>
@endsection
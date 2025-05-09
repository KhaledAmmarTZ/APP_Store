@extends('layout.admin')

@section('title')
    Admin Profile
@endsection

@section('content')
<style>
    .blurry-card {
        position: relative;
        background-color: rgba(248, 249, 250, 0.5); 
        backdrop-filter: blur(2px);
    }
    .card-text {
        font-size: 0.8rem;
        color: rgb(255, 255, 255);
    }
    .card-title {
        color: rgb(255, 255, 255);
    }
</style>

<div class="container mt-4">
    <a href="{{ url('/') }}" class="btn btn-primary">Go to Welcome Page</a>
</div>

@endsection
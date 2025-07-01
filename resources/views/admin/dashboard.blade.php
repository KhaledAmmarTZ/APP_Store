@extends('layout.admin')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<style>
    .blurry-card {
        position: relative;
        background-color: rgba(248, 249, 250, 0.5); 
        backdrop-filter: blur(2px);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .card-title {
        color: #333;
        font-weight: bold;
        font-size: 1.3rem;
    }
    .card-text {
        font-size: 1rem;
        color: #555;
    }
    .dashboard-links a {
        margin-right: 1rem;
        margin-bottom: 1rem;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Welcome, Admin!</h2>
    <div class="dashboard-links mb-4">
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Welcome Page</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">View All Products</a>
        <a href="{{ route('admin.vendors') }}" class="btn btn-info">Manage Vendors</a>
        <a href="{{ route('admin.profiles') }}" class="btn btn-success">Admin Profile</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="blurry-card">
                <div class="card-title">Total Products</div>
                <div class="card-text display-6">{{ \App\Models\Product::count() }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="blurry-card">
                <div class="card-title">Total Vendors</div>
                <div class="card-text display-6">{{ \App\Models\Vendor::count() }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="blurry-card">
                <div class="card-title">Total Users</div>
                <div class="card-text display-6">{{ \App\Models\User::count() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
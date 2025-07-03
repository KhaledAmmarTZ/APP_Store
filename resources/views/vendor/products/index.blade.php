@extends('layout.vendor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold">My Products</h1>
    <a href="{{ route('vendor.products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Product
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($products->isEmpty())
    <div class="alert alert-info">No products found. Start by adding a new product!</div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        @php
                            $mainImage = $product->images->where('status', 'main')->first();
                        @endphp
                        @if($mainImage)
                            <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="{{ $product->product_name }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                        @else
                            <span class="text-muted fst-italic">No image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vendor.products.individual', $product->id) }}" class="fw-semibold text-decoration-none">
                            {{ $product->product_name }}
                        </a>
                    </td>
                    <td>${{ number_format($product->product_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            @if($product->status === 'active')
                                <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-sm btn-primary rounded d-flex align-items-center justify-content-center me-1" title="Edit" style="width: 36px; height: 36px;">
                                    <span class="bi bi-pencil"></span>
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary rounded d-flex align-items-center justify-content-center me-1" disabled title="Edit disabled" style="width: 36px; height: 36px;">
                                    <span class="bi bi-pencil"></span>
                                </button>
                            @endif

                            <a href="{{ route('vendor.products.individual', $product->id) }}" class="btn btn-sm btn-success rounded d-flex align-items-center justify-content-center me-1" title="View" style="width: 36px; height: 36px;">
                                <span class="bi bi-eye"></span>
                            </a>

                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded d-flex align-items-center justify-content-center" title="Delete" style="width: 36px; height: 36px;">
                                    <span class="bi bi-trash"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
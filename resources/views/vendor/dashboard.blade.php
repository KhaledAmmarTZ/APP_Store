@extends('layout.vendor')

@section('content')
<main class="col-md-10 ms-sm-auto px-md-4 py-4">
                <h2 class="mb-4">Welcome, {{ Auth::guard('vendor')->user()->name }}!</h2>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="dashboard-card text-center">
                            <h5>Total Products</h5>
                            <div class="display-6">
                                {{ \App\Models\Product::where('created_by', Auth::guard('vendor')->id())->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-card text-center">
                            <h5>Total Sales</h5>
                            <div class="display-6">
                                {{ \App\Models\Product::where('created_by', Auth::guard('vendor')->id())->sum('total_sold') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-card text-center">
                            <h5>Average Rating</h5>
                            <div class="display-6">
                                {{
                                    number_format(
                                        \App\Models\Product::where('created_by', Auth::guard('vendor')->id())->avg('average_rating'),
                                        2
                                    )
                                }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <h5>Quick Actions</h5>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-primary">
                            Product Index
                        </a>
                        <a href="{{ route('vendor.products.create') }}" class="btn btn-outline-success">
                            Add New Product
                        </a>
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-warning">
                            Edit Product
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
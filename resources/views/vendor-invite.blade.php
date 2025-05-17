@extends('layout.home')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="mb-3">Become a Vendor on Our Platform</h2>
        <p class="text-muted mb-4 fs-5">
            Partner with us and take your business to the next level. Reach more customers, increase sales, and build your brand with our support.
        </p>
        <!-- Trigger Modal -->
        <button type="button" class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#vendorModal">
            Register as Vendor
        </button>
    </div>

    <!-- Benefits Section -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h4>Why Join as a Vendor?</h4>
            <ul class="list-group list-group-flush mt-3">
                <li class="list-group-item">🚀 Expand your reach with thousands of daily visitors.</li>
                <li class="list-group-item">📈 Analytics to grow your business smarter.</li>
                <li class="list-group-item">📦 Manage products and orders with ease.</li>
                <li class="list-group-item">🤝 Friendly support from our vendor success team.</li>
                <li class="list-group-item">💳 Secure and fast payouts.</li>
            </ul>
        </div>
        
    </div>

    <!-- Disclaimer Section -->
    <div class="alert alert-warning mt-5" role="alert">
        <h5 class="alert-heading">Important Disclaimer</h5>
        <p class="mb-0">
            By registering, you agree to our <a href="#">terms and conditions</a>. We may review and approve vendor accounts to ensure quality and trust.
        </p>
    </div>
</div>

<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="vendorModalLabel">Vendor Registration Rules</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-rules">
            <p>Please read the following rules carefully before proceeding with registration:</p>
            <ul>
                <li>✅ You must provide accurate and up-to-date business information.</li>
                <li>📦 All products listed must meet our quality and safety standards.</li>
                <li>🚫 Counterfeit or illegal items are strictly prohibited.</li>
                <li>🔁 You are responsible for fulfilling orders and handling returns efficiently.</li>
                <li>📃 You agree to abide by our marketplace terms, including commission rates and delivery SLAs.</li>
            </ul>
            <p class="mt-3">
                By proceeding, you agree to follow these rules and our 
                <a href="#" class="theme-link">Vendor Terms and Conditions</a>.
            </p>
        </div>

        <div class="modal-footer">
            <a href="{{ route('vendor.register.form') }}" class="btn btn-success">
                I Agree & Register
            </a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>
@endsection


@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h1>Request to Become a Vendor</h1>
    <form method="POST" action="{{ route('vendor.request') }}">
        @csrf
        <p>By submitting this request, you agree to our vendor terms and conditions.</p>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
@endsection
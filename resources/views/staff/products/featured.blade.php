<div class="container">
    <h2>Select up to 6 Featured Products</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('staff.products.featured.update') }}">
        @csrf
        <div style="display: flex; flex-wrap: wrap;">
            @foreach($products as $product)
                <div style="margin: 10px; border: 1px solid #ccc; padding: 10px;">
                    <label>
                        <input type="checkbox" name="featured_ids[]" value="{{ $product->id }}" {{ $product->is_featured === 'yes' ? 'checked' : '' }}>
                        {{ $product->product_name }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit">Save Featured Products</button>
    </form>
</div>
<div class="container">
    <h2>Select up to 6 Featured Products and up to 2 Free Products</h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('staff.products.featured.update') }}" id="featuredForm">
        @csrf
        <div style="display: flex; flex-wrap: wrap;">
            @foreach($products as $product)
                <div style="margin: 10px; border: 1px solid #ccc; padding: 10px; min-width: 250px;">
                    <div>
                        <strong>{{ $product->product_name }}</strong>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" class="featured-checkbox" name="featured_ids[]" value="{{ $product->id }}" {{ $product->is_featured === 'yes' ? 'checked' : '' }}>
                            Featured
                        </label>
                        <label style="margin-left: 10px;">
                            <input type="checkbox" class="free-checkbox" name="free_ids[]" value="{{ $product->id }}" {{ $product->is_free === 'yes' ? 'checked' : '' }}>
                            Free
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit">Save Featured Products</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const featuredLimit = 6;
    const freeLimit = 2;

    function enforceLimit(selector, limit, message) {
        document.querySelectorAll(selector).forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const checked = document.querySelectorAll(selector + ':checked').length;
                if (checked > limit) {
                    this.checked = false;
                    alert(message);
                }
            });
        });
    }

    enforceLimit('.featured-checkbox', featuredLimit, 'You can select up to 6 featured products only.');
    enforceLimit('.free-checkbox', freeLimit, 'You can select up to 2 free products only.');
});
</script>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" required>
    </div>

    <div class="mb-3">
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', auth()->user()->phoneNumber) }}" required>
    </div>

    <div class="mb-3">
        <label for="place" class="form-label">Place</label>
        <input type="text" class="form-control" id="place" name="place" value="{{ old('place', auth()->user()->place) }}" required>
    </div>

    <div class="mb-3">
        <label for="user_nid" class="form-label">User NID</label>
        <input type="text" class="form-control" id="user_nid" name="user_nid" value="{{ old('user_nid', auth()->user()->user_nid) }}" required>
    </div>

    <div class="mb-3">
        <label for="user_image" class="form-label">User Image</label>
        <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
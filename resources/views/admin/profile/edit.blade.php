<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <!-- Back Button -->
    <a href="{{ route('admin.profiles') }}" class="btn btn-secondary mb-4">Back</a>

    <!-- Profile Header -->
    <div class="mb-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Profile
        </h2>
    </div>

    <!-- Profile Update Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Update Profile Information</h5>
            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $admin->name) }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $admin->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $admin->date_of_birth) }}">
                    @error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="text" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $admin->phoneNumber) }}">
                    @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Address (place) -->
                <div class="mb-3">
                    <label for="place" class="form-label">Address</label>
                    <input type="text" name="place" class="form-control" value="{{ old('place', $admin->place) }}">
                    @error('place') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- NID -->
                <div class="mb-3">
                    <label for="admin_nid" class="form-label">NID</label>
                    <input type="text" name="admin_nid" class="form-control" value="{{ old('admin_nid', $admin->admin_nid) }}">
                    @error('admin_nid') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Profile Image -->
                <div class="mb-3">
                    <label for="admin_image" class="form-label">Profile Image</label>
                    <input type="file" name="admin_image" class="form-control">
                    @error('admin_image') <small class="text-danger">{{ $message }}</small> @enderror

                    @if ($admin->admin_image)
                        <div class="mt-3">
                            <p>Current Image:</p>
                            <img src="{{ asset('storage/' . $admin->admin_image) }}" alt="Admin Image" width="120" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Update Password Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Update Password</h5>
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                @method('put')
                
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Password</button>
            </form>
        </div>
    </div>

    <!-- Delete admin Account Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Delete Account</h5>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>

            <!-- Delete Button -->
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</button>
            
            <!-- Modal -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">Are you sure you want to delete your account?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="{{ route('admin.profile.destroy') }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

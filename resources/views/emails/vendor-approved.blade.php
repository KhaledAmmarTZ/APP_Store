<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Approved</title>
</head>
<body>
    <h1>Congratulations, {{ $vendor->name }}!</h1>
    <p>Your vendor account has been approved. Please set your password to access your account.</p>
    <p>
        <a href="{{ $url }}">Set Your Password</a>
    </p>
</body>
</html>
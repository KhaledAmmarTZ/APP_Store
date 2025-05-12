
<!DOCTYPE html>
<html>
<head>
    <title>Staff Invitation</title>
</head>
<body>
    <p>Hello {{ $staff->name }},</p>
    <p>You have been added as a staff member. Please confirm your email and set your password by clicking the link below:</p>
    <a href="{{ $url }}">{{ $url }}</a>
    <p>Thank you!</p>
</body>
</html>
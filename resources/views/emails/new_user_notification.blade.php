<!DOCTYPE html>
<html>
<head>
    <title>New User Registration Notification</title>
</head>
<body>
    <h1>New User Registered!</h1>
    <p>A new user has registered with the following details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $user->fullname }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Username:</strong> {{ $user->username }}</li>
        <!-- Add more user details here as needed -->
    </ul>
    <p>Please take necessary actions if required.</p>
    <p>Regards,</p>
    <p>Your Application Admin</p>
</body>
</html>

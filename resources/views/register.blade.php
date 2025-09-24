<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register Page</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>

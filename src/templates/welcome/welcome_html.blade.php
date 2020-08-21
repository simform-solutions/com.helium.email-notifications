<html lang="en">
<body>
<h1>Hello, {{$name}}!</h1>
<p>Thank you for joining {{config('app.name')}}!</p>
<p>Your account has been created, and you may login at {{config('app.url') . '/login'}}.</p>
</body>
</html>
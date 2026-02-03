<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5 text-center">
    <h1>Woodlet store</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger mt-4">ออกจากระบบ</button>
    </form>
</div>
</body>
</html>

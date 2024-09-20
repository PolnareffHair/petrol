<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<body>
    <h2>Вход</h2>
    <form method="POST" action="/login">
        <!-- Важно: Laravel требует CSRF-токен для защиты от CSRF-атак -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label for="phone_number">Номер телфона:</label>
        <input type="" id="phone_number" name="phone_number" required>
        <br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Вход</button>
    </form>
</body>

</html>
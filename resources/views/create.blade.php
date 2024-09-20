<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>

<body>
    <h2>Регистрация</h2>
    <form method="POST" action="/register">
        <!-- Важно: Laravel требует CSRF-токен для защиты от CSRF-атак -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="phone_number">Номер телфона:</label>
        <input type="" id="phone_number" name="phone_number" required>
        <br>

        <label for="email">Электронная почта:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="password_confirmation">Подтверждение пароля:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>

        <button type="submit">Регистрация</button>
    </form>
</body>

</html>
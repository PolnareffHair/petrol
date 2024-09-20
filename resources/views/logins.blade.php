<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в аккаунт</title>
</head>

<body>
    <h2>Вход в аккаунт</h2>
    <form method="POST" action="/login">
        <!-- Важно: Laravel требует CSRF-токен для защиты от CSRF-атак -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label for="email">Электронная почта:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Войти</button>
    </form>
</body>

</html>
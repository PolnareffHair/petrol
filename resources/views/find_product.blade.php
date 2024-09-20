<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск товара</title>
</head>

<body>
    <h2>Поиск товара</h2>
    <form method="GET" action="/find">
        <!-- Важно: Laravel требует CSRF-токен для защиты от CSRF-атак -->
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

        <label for="max_price">Макс цена:</label>
        <input type="text" id="max_price" name="max_price">
        <br>

        <label for="min_price">Мин цена:</label>
        <input type="text" id="min_price" name="min_price">
        <br>

        <button type="submit">Go</button>
    </form>

    {{$products }}
    <table>


    </table>
</body>

</html>
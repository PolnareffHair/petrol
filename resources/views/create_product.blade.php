<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>

<body>
    <h2>Регистрация</h2>
    <form method="POST" action="/create_product">
        <!-- Важно: Laravel требует CSRF-токен для защиты от CSRF-атак -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{$i[2]["country_name_ua"]}}
        @php
        $params = [
        'product_country_id',
        'product_show_country',
        'product_order_priority',
        'product_category_id',
        'article',
        'product_price',
        'product_best_seller',
        'product_price_discount',
        'product_price_discount_date_expires',
        'product_price_discount_type',
        'product_avalible_state',
        'product_rating',
        'product_name_ua',
        'product_name_ru',
        'product_title_ua',
        'product_title_ru',
        'product_url_ua',
        'product_url_ru',
        'product_description_ua',
        'product_description_ru',
        'product_meta_description_ua',
        'product_meta_description_ru'
        ];
        @endphp
        <style>
            .SomeDIV {
                display: flex;
                flex-direction: column;
            }

            .SomeDIV label,
            .SomeDIV input {
                display: block;
                width: 200px;


            }
        </style>


        @foreach($params as $param)

        <div class="SomeDIV">
            <label for="{{ $param }} ">{{ $param }} </label>
            <input type="text" id="{{ $param }}" name="{{ $param }}">
        </div>
        <br>
        @endforeach`



        <button type="submit">Создать</button>
    </form>
</body>

</html>
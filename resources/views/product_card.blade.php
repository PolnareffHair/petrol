<!DOCTYPE html>
<html lang="ua">

<head>

    @php
    $lang="ua";

    @endphp

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <html prefix="og: https://ogp.me/ns#">

    <meta name="robots" content="all">

    <title>{{$data["product_title_$lang"]}}</title>

    <link rel="canonical" hreflang="ru" href="https://petroline.ua/mini-zapravka-40-l-khv-220v/">
    <link rel="alternate" hreflang="uk" href="https://petroline.ua/ua/mini-zapravka-40-l-khv-220v/">

    <meta name="description" content="{{$data["product_meta_description_$lang"]}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{$data["product_title_$lang"]}}" />
    <meta property="og:description" content="{{$data["product_meta_description_$lang"]}}" />

    <meta property="og:image" content="https://yourshop.com/images/samsung-galaxy-s21.jpg" />
    <meta property="og:url" content="https://yourshop.com/product/samsung-galaxy-s21" />
    <meta property="og:site_name" content="Petrol-mini" />
    <meta property="og:locale" content="ua_UA">


    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{$data["product_title_$lang"]}}" />
    <meta name="twitter:description" content="{{$data["product_meta_description_$lang"]}}" />
    <meta name="twitter:image" content="https://yourshop.com/images/samsung-galaxy-s21.jpg" />

    <!-- Canonical -->
    <link rel="canonical" href="https://yourshop.com/product/samsung-galaxy-s21" />
    @php


    if ( $data["product_price_discount"] != null ){
    $price = $data["product_price_discount"];
    }
    else {
    $price = $data["product_price"];
    }
    $productData = [
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => htmlspecialchars_decode($data["product_name_$lang"]),
    "image" => "https://yourshop.com/images/samsung-galaxy-s21.jpg", /* */
    "description" => $data["product_meta_description_$lang"], /* */
    "brand" => [
    "@type" => "Brand",
    "name" => "Samsung", /* */
    ],
    "offers" => [
    "@type" => "Offer",
    "url" => "https://yourshop.com/product/samsung-galaxy-s21", /* */
    "priceCurrency" => "UAH",
    "price" => "69999", /* */
    "itemCondition" => "https://schema.org/NewCondition",
    "availability" => "https://schema.org/InStock",
    "seller" => [
    "@type" => "Organization",
    "name" => "Petrol-mobile",
    ],
    ],
    "aggregateRating" => [
    "@type" => "AggregateRating",
    "ratingValue" => "4.8", /* */
    "reviewCount" => "250", /* */
    ],
    "review" => [
    [
    "@type" => "Review",
    "reviewRating" => [
    "@type" => "Rating",
    "ratingValue" => "5", /* */
    ],
    "author" => [
    "@type" => "Person", /* */
    "name" => "Иван Иванов", /* */
    ],
    "reviewBody" => "Отличный смартфон с великолепной камерой и производительностью!", /* */
    ],
    ],
    ];
    @endphp

    <!-- Structured Data / Schema.org -->

    @php

    Echo '<script type="application/ld+json">
        ';

        Echo json_encode($productData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        Echo '
    </script>';
    @endphp
</head>

<body>
    <header>
        <!-- Навигация и прочие элементы -->
    </header>

    <main>
        <article>
            <h1>Смартфон Samsung Galaxy S21</h1>
            <img src="https://yourshop.com/images/samsung-galaxy-s21.jpg" alt="Смартфон Samsung Galaxy S21" />
            <p>
                Смартфон Samsung Galaxy S21 с 8 ГБ оперативной памяти, 128 ГБ
                внутренней памяти и поддержкой 5G.
            </p>
            <p>Цена: 69,999 руб.</p>
            <!-- Дополнительная информация о товаре -->
        </article>

        <nav aria-label="breadcrumb">
            <ol>
                <li><a href="https://yourshop.com/">Главная</a></li>
                <li>
                    <a href="https://yourshop.com/category/smartphones">Смартфоны</a>
                </li>
                <li>Samsung Galaxy S21</li>
            </ol>
        </nav>
    </main>

    <footer>
        <!-- Контактная информация и прочее -->
    </footer>
</body>

@php

var_dump($data->toArray());
@endphp

</html>
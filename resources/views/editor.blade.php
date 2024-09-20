<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>






    @php

    foreach ($response as $key => $value) {

    @endphp
    <h3>{{$value["atribute_ID"]}}</h3>
    <div>{{$value["atribute_name_ua"]}}</div>
    <div>{{$value["atribute_name_ru"]}}</div>
    @php
    }



    @endphp

</body>

</html>
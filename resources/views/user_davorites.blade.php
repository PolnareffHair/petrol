<!DOCTYPE html>
<html lang="ua">

<head>


    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/fiera.css">
    <link rel="stylesheet" href="css/login_style.css">

    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
</head>


<body>

    @include("common.header")

    @include("common.footer")
</body>

<script src="open_window.js"></script>


<script src="catalog.js"></script>
<script src="imask.js"></script>


<script src="js/user_operations.js">

</script>

<script>
    var maskOptions = {
        mask: '+3(800)000-00-000',
        lazy: false
    }
    var element1 = document.getElementById('pnum_input');
    var mask1 = new IMask(element1, maskOptions);
    var element2 = document.getElementById('pnum_input_login');
    var mask2 = new IMask(element2, maskOptions);
</script>
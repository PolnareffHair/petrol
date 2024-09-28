<head>

    @php

    $token =csrf_token();
    echo " <script>
        csrf_token = '$token';
    </script>";
    @endphp
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/admin_svg/logo.svg" sizes="any" type="image/svg+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>    const csrf_token = '{{ csrf_token() }}';</script>
    <script src="/js/loading_animation.js"></script>
    <script defer src="/admin_js/colapse.js"></script>
    <script defer src="/admin_js/alpine.js"></script>
    <script src="/js/jquery-3.6.min.js"></script>

    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/summernote-bs4.min.js"></script>
    <script src="/js/Sortable.min.js"></script>


    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/summernote-bs4.min.css" rel="stylesheet">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/admin_css/style.css">

    <title>Панель адміністратора</title>   
    
    <script  src="/admin_js/formbuilder.js"></script>
</head>
   

    



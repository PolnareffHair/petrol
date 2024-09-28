@php

$name = "categoties";

$get_link = '/admin/product_edit/cats_edit/content';

$delete_link = '/admin/product_edit/cats_edit/delete';

$uppdate_link = '/admin/product_edit/cats_edit/uppdate';

$add_link = '/admin/product_edit/cats_edit/add';

@endphp


<div class="tag_selector" id="item{{$id_item}}">

</div>
<script>
            $(document).on('change', '.{{$name}}avsel', function() {

                // Получаем выбранное значение

                var selectedValueid = $(this).val();

                if (selectedValueid == "empty") return 0; // Выводим значение в консоль

                StartLoading('#item{{$id_item}}');


                id = $(this).data("id");
                $.ajax({
                    url: '{{$add_link}}',
                    type: 'POST',
                    data: {
                        _token:csrf_token,
                        id: selectedValueid,
                        pid:'{{$id_item}}',
                    },
                    success: function(response) {
                        console.log(response);
                        showNotification(response)
                        refresh_categories()
                        StartLoading('#item{{$id_item}}');
                        $.ajax({
                            url: '{{$get_link}}',
                            type: 'POST',
                            data: {
                                _token:csrf_token,
                                id:'{{$id_item}}',
                                name: '{{$name}}',
                            },
                            success: function(response) {

                                $("#item{{$id_item}}").html(response);

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                showNotification("Помилка " + error, duration = 5000, 0)
                            },
                            complete: function() {
                                StopLoading('#item{{$id_item}}');
                            }
                        });

                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                    },
                    complete: function() {
                        StopLoading('#item{{$id_item}}');
                    }
                });
            });
            $(document).on('click', ".delete_item{{$id_item}}", function() {

                // Получаем выбранное значение
                var id = $(this).data("id");

                StartLoading('#item{{$id_item}}');

                $.ajax({
                    url: '{{$delete_link}}',
                    type: 'POST',
                    data: {
                        _token:csrf_token,
                        id: id,
                        pid:'{{$id_item}}',

                    },
                    success: function(response) {
                        console.log(response);
                        refresh_categories()
                        showNotification(response, duration = 5000)

                        StartLoading('#item{{$id_item}}');

                        $.ajax({
                            url: '{{$get_link}}',
                            type: 'POST',
                            data: {
                                _token:csrf_token,
                                id:'{{$id_item}}',
                                name: '{{$name}}',
                            },
                            success: function(response) {
                                $("#item{{$id_item}}").html(response);                            
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                showNotification("Помилка " + error, duration = 5000, 0)
                            },
                            complete: function() {
                                StopLoading('#item{{$id_item}}');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        showNotification("Помилка " + error, duration = 5000, 0)
                    },
                    complete: function() {
                        StopLoading('#item{{$id_item}}');
                    }
                });
            });

            function refresh_categories() {
                StartLoading('#item{{$id_item}}');
                $.ajax({
                    url: '{{$get_link}}',
                    type: 'POST',
                    data: {
                        _token:csrf_token,
                        id:'{{$id_item}}',
                        name: '{{$name}}',
                    },
                    success: function(response) {
                        $("#item{{$id_item}}").html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                    },
                    complete: function() {
                        StopLoading('#item{{$id_item}}');
                    }
                });
            }
            setTimeout(refresh_categories(), 300);
        
</script>
@php

    $name = "categoties";

    $get_link = '/admin/product_edit/cats_edit/content';

    $delete_link = '/admin/product_edit/cats_edit/delete';

    $uppdate_link = '/admin/product_edit/cats_edit/uppdate';

    $add_link = '/admin/product_edit/cats_edit/add';

    $id_name  = $name."item";

@endphp


<div class="tag_selector" id="item{{$id_name}}">
    
</div>
<script>
            $(document).on('change', '.{{$name}}avsel', function() {

                // Получаем выбранное значение

                var selectedValueid = $(this).val();

                if (selectedValueid == "empty") return 0; // Выводим значение в консоль

                StartLoading('#product_edit_field');


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
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    complete: function() {
                        StopLoading('#product_edit_field');
                    }
                });
            });
            $(document).on('click', ".delete_item{{$id_item}}", function() {

                // Получаем выбранное значение
                var id = $(this).data("id");

                StartLoading('#product_edit_field');

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

                        refresh_categories()
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        showNotification("Помилка " + error, duration = 5000, 0)
                    },
                    complete: function() {
                        StopLoading('#product_edit_field');
                    }
                });
            });

            function refresh_categories() {
                StartLoading('#product_edit_field');
                $.ajax({
                    url: '{{$get_link}}',
                    type: 'POST',
                    data: {
                        _token:csrf_token,
                        id:'{{$id_item}}',
                        name: '{{$name}}',
                    },
                    success: function(response) {
                        $("#item{{$id_name}}").html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                    },
                    complete: function() {
                        StopLoading('#product_edit_field');
                    }
                });
            }
</script>
<button class="up" style="display:none;" onclick="refresh_categories()">⟳</button>

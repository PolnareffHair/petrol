@php
//unique for each editror IMPORTANT
    $name = "tagger";
//

$get_link = '/admin/product_edit/tags/content';

$delete_link = '/admin/product_edit/tags_edit/delete';

$uppdate_link = '/admin/product_edit/tags_edit/uppdate';

$add_link = '/admin/product_edit/tags_edit/add';

$id_name  = $name."item".$id_item;
@endphp
<script>
    id_item = '{{$id_item}}'
</script>

<div class="tag_selector" id="{{$id_name}}">
  
</div>
<script>
    

  
        $(document).on('change', '.{{$name}}sel', function() {
            // Получаем выбранное значение
            var selectedValue = $(this).val();

            if (selectedValue == "empty") return 0; // Выводим значение в консоль

            StartLoading('#product_edit_field');

            id = $(this).data("id");
            $.ajax({
                url: '{{$uppdate_link}}',
                type: 'POST',
                data: {
                    _token: csrf_token,
                    attr_val: selectedValue,
                    attr: id,
                    id: id_item,
                },
                success: function(response) {
      
                    showNotification("Успішно змінено")
                    refresh_tags()
             
                },
                error: function(xhr, status, error) {
                    console.log(error);


                },
                complete: function() {
                    StopLoading('#product_edit_field');
                }
            });
            });
    $(document).on('change', '.{{$name}}avsel', function() {


        // Получаем выбранное значение
        var selectedValue = $(this).val();

        if (selectedValue == "empty") return 0; // Выводим значение в консоль

        StartLoading('#product_edit_field');


        id = $(this).data("id");
        $.ajax({
            url: '{{$add_link}}',
            type: 'POST',
            data: {
                _token: csrf_token,
                name: selectedValue,
                id: id,
                pid: id_item,
            },
            success: function(response) {
                console.log(response);
                refresh_tags()
                StartLoading('#product_edit_field');
                $.ajax({
                    url: '{{$get_link}}',
                    type: 'POST',
                    data: {
                        _token: csrf_token,
                        id: id_item,
                        name: '{{$name}}',
                    },
                    success: function(response) {

                        $("#{{$id_name}}").html(response);

                        showNotification("Успішно додано")
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        showNotification("Помилка " + error, duration = 5000, 0)
                    },
                    complete: function() {
                        StopLoading('#product_edit_field');
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(error);

            },
            complete: function() {
                StopLoading('#product_edit_field');
            }
        });
    });
    $(document).on('click', ".delete_{{$id_name}}", function() {

        // Получаем выбранное значение
        var id = $(this).data("id");
        StartLoading('#product_edit_field');
        $.ajax({
            url: '{{$delete_link}}',
            type: 'POST',
            data: {
                _token: csrf_token,
                attr: id,
                id: id_item,
            },
            success: function(response) {
                console.log(response);

                refresh_tags()
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

    function refresh_tags() {
        StartLoading('#product_edit_field');

        if(  csrf_token == undefined    ) return setTimeout( refresh_tags(), 300);


        $.ajax({
            url: '{{$get_link}}',
            type: 'POST',
            data: {
                _token: csrf_token,
                id: id_item,
                name: '{{$name}}',
            },
            success: function(response) {
                $("#{{$id_name}}").html(response);
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
<button class="up" style="display:none;" onclick="refresh_tags()">⟳</button>
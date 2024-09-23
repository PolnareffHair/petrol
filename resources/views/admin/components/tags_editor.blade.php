@php
$name = "tagger";

$save_id = "refresh_sort_product";

$add_id = "add_img_product";

$sorter_name = "sortable-list";

$get_link = '/admin/product_edit/tags/content';

$delete_link = '/admin/product_edit/tags_edit/delete';

$uppdate_link = '/admin/product_edit/tags_edit/uppdate';

$add_link = '/admin/product_edit/tags_edit/add';

$path_base = "" . "_";

$end_prefix = "_small.webp";

@endphp
<script>
    id_item = '{{$id_item}}'
</script>



<div class="tag_selector" id="item{{$id_item}}">

</div>
<script>
  $( document ).ready(
    function(){
        $(document).on('change', '.{{$name}}sel', function() {
            // Получаем выбранное значение
            var selectedValue = $(this).val();

            if (selectedValue == "empty") return 0; // Выводим значение в консоль

            StartLoading('#item{{$id_item}}');

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
                    console.log(response);
                    refresh()
             
                },
                error: function(xhr, status, error) {
                    console.log(error);

                },
                complete: function() {
                    StopLoading('#item{{$id_item}}');
                }
            });
            });
    $(document).on('change', '.{{$name}}avsel', function() {


        // Получаем выбранное значение
        var selectedValue = $(this).val();

        if (selectedValue == "empty") return 0; // Выводим значение в консоль

        StartLoading('#item{{$id_item}}');


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
                refresh()
                StartLoading('#item{{$id_item}}');
                $.ajax({
                    url: '{{$get_link}}',
                    type: 'POST',
                    data: {
                        _token: csrf_token,
                        id: id_item,
                        name: '{{$name}}',
                    },
                    success: function(response) {

                        $("#item{{$id_item}}").html(response);

                        showNotification("Успішно додано")
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
                _token: csrf_token,
                attr: id,
                id: id_item,

            },
            success: function(response) {
                console.log(response);
                refresh()


                StartLoading('#item{{$id_item}}');

                $.ajax({
                    url: '{{$get_link}}',
                    type: 'POST',
                    data: {
                        _token: csrf_token,
                        id: id_item,
                        name: '{{$name}}',
                    },
                    success: function(response) {

                        $("#item{{$id_item}}").html(response);

                        showNotification("Успішно видалено", duration = 5000)
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


    function refresh() {
        StartLoading('#item{{$id_item}}');

        if(  csrf_token == undefined    ) return setTimeout( refresh(), 300);


        $.ajax({
            url: '{{$get_link}}',
            type: 'POST',
            data: {
                _token: csrf_token,
                id: id_item,
                name: '{{$name}}',
            },
            success: function(response) {
                $("#item{{$id_item}}").html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
                setTimeout( refresh(),200);
            },
            complete: function() {
                StopLoading('#item{{$id_item}}');
            }
        });
    }setTimeout( refresh(),200);
    
   


    });
</script>
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
    
  $( document ).ready(
    function(){
        $(document).on('change', '.{{$name}}sel', function() {
            // Получаем выбранное значение
            var selectedValue = $(this).val();

            if (selectedValue == "empty") return 0; // Выводим значение в консоль

            StartLoading('#{{$id_name}}');

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
                    refresh()
             
                },
                error: function(xhr, status, error) {
                    console.log(error);


                },
                complete: function() {
                    StopLoading('#{{$id_name}}');
                }
            });
            });
    $(document).on('change', '.{{$name}}avsel', function() {


        // Получаем выбранное значение
        var selectedValue = $(this).val();

        if (selectedValue == "empty") return 0; // Выводим значение в консоль

        StartLoading('#{{$id_name}}');


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
                StartLoading('#{{$id_name}}');
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
                        StopLoading('#{{$id_name}}');
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(error);

            },
            complete: function() {
                StopLoading('#{{$id_name}}');
            }
        });
    });
    $(document).on('click', ".delete_{{$id_name}}", function() {

        // Получаем выбранное значение
        var id = $(this).data("id");

        StartLoading('#{{$id_name}}');

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


                StartLoading('#{{$id_name}}');

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

                        showNotification("Успішно видалено", duration = 5000)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        showNotification("Помилка " + error, duration = 5000, 0)
                    },
                    complete: function() {
                        StopLoading('#{{$id_name}}');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
                showNotification("Помилка " + error, duration = 5000, 0)
            },
            complete: function() {
                StopLoading('#{{$id_name}}');
            }
        });
    });

    function refresh() {
        StartLoading('#{{$id_name}}');

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
                $("#{{$id_name}}").html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);

            },
            complete: function() {
                StopLoading('#{{$id_name}}');
            }
        });
    }
    setTimeout( refresh(),300);

    });
</script>

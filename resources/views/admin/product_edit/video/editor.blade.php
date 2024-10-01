
@php


$add_id = "add_video_product";

$sorter_name = "sortable-list-video";

$get_link = '/admin/product_edit/Video/get';

$delete_link = '/admin/product_edit/Video/delete';

$uppdate_link = '/admin/product_edit/Video/uppdate';

$add_link = '/admin/product_edit/Video/add';

$path_base = "/images/product/$id_item" . "_";

$end_prefix = "_small.webp";

@endphp

<div class="sort_editor" >
    <p>Посилання на відео (youtube -> Поділитись -> Код). Приклад посилання :www.youtube.com/embed/ri4SR2cZeIA</p>
    <div>
        <div class="img_sorter" id="{{$sorter_name}}" >
        </div>
        <div class="top_buttons">
            <input type="text" id="{{ $add_id}}_input" style="height: 3em; width :300px;">
            <button class="add_item" id="{{ $add_id }}">
                <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                        sketch:type="MSPage">
                        <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)"
                            fill=" white">
                            <path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 
                            C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z 
                            M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 
                            C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 
                            Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 
                            479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,
                            1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 
                            C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,
                            1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" id="plus-circle"
                                sketch:type="MSShapeGroup">
                            </path>
                        </g>
                    </g>
                </svg>
                Додати
            </button>
        </div>
    </div>

</div>
<script>   
        //download //delete
        document.getElementById('{{$sorter_name}}').addEventListener('click', function(event) {
            DeletedButton = event.target.closest('.delete_img');
            if (DeletedButton) {
                id = DeletedButton.getAttribute('data-link');
                // Второй AJAX-запрос для обновления корзины
    
                $.ajax({
                    url: '{{$delete_link}}',
                    type: 'POST',
                    data: {
                        video: id,
                        id: "{{$id_item}}",
                        _token: csrf_token
                    },
                    success: function(response) {

                        get_video_editor()

                        showNotification(response, duration = 5000)
                    },
                    error: function(xhr, status, error) {

                        get_video_editor()

                        showNotification("Помилка " + error, duration = 5000, 0)
                    },
                  
                });
            }
        });
        
        // Инициализация SortableJS
        const sortable = new Sortable(document.getElementById('{{$sorter_name}}'), {
            animation: 100,
            onEnd: function (evt) {
                StartLoading("#product_edit_field"); 

                items = document.querySelectorAll('#{{$sorter_name}} .sortable-item');
                order = Array.from(items).map(item => item.getAttribute('data-id'));
               
                $.ajax({
                    url: '{{$uppdate_link}}',
                    type: 'POST',
                    data: {
                        img: order,
                        product_id: "{{$id_item}}",
                        _token: csrf_token
                    },
                    success: function(response) {
                       
                        get_video_editor()
                        showNotification("Послідовність успішно збережено", duration = 5000)

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        get_video_editor();
                        showNotification("Помилка " + error, duration = 5000, 0);

                    },
                    complete: function() {
      
                        StopLoading("#product_edit_field");
                    }
                });
            }
        });

        // Открыть окно выбора файла при нажатии кнопки
        document.getElementById('{{$add_id}}').addEventListener('click', function() {
            links = $("#{{$add_id}}_input").val();
            StartLoading("#product_edit_field"); 
            $.ajax({
                    url: '{{$add_link}}',
                    type: 'POST',
                    data: {
                  
                        product_id: "{{$id_item}}",
                        link: links,
                        _token: csrf_token
                    },
                    success: function(response) {
                       
                        get_video_editor()
                        showNotification(response, duration = 5000)

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        get_video_editor();
                        showNotification("Помилка " + error, duration = 5000, 0);

                    },
                    complete: function() {
      
                        StopLoading("#product_edit_field");
                    }
                });

        });

        // Function to get the current order of items
    //get img list for editor
    function get_video_editor() {
        StartLoading("#product_edit_field");
        $.ajax({
            url: '{{$get_link}}',
            type: 'post',
            data: {
                _token: csrf_token,
                product_id : "{{$id_item}}",
            },
            success: function(response) {
                StopLoading("#product_edit_field"); 
                document.getElementById("{{$sorter_name}}").innerHTML = response;       
                document.getElementById('{{$sorter_name}}').classList.remove("on_loading");
                document.getElementById('{{$sorter_name}}').classList.add('loaded');
            },
            error: function(xhr, status, error) {   
                StopLoading("#product_edit_field");
                document.getElementById('{{$sorter_name}}').classList.remove("on_loading");
                document.getElementById('{{$sorter_name}}').classList.add('loaded');
            }
        });
    }


        
 


 
</script>
<button class="up" style="display:none;" onclick="get_video_editor()">⟳</button>
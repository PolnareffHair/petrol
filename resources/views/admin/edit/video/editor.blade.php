@php
    ///  $id_n  - getting from outside 
    /// $path_link - getting from outside 


    $id_n = $id_n. "_item_".$id_item; 

    $sorter_name = $id_n."_list-img";

    $id_name = $id_n. "item".$id_item; 

    $id_btn = $id_name . "load"; 

    


    $read_link = $path_link .'/read';

    $delete_link = $path_link .'/delete';

    $update_link = $path_link .'/uppdate';

    $create_link = $path_link .'/create';

    $path_base = "/images/product/$id_item" . "_";

    $end_prefix = "_small.webp";
@endphp

<div class="sort_editor" >
    <p>Посилання на відео (youtube -> Поділитись -> Код). Приклад посилання :www.youtube.com/embed/ri4SR2cZeIA</p>
    <div>
        <div class="img_sorter" id="{{$sorter_name}}" >
        </div>
        <div class="top_buttons">
            <input type="text" id="{{ $id_name}}_input" style="height: 3em; width :300px;">
            <button class="add_item" id="{{ $id_name }}">
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
<button class="up" id="{{$id_btn}}" style="display:none;">⟳</button>

<script>   

        //update on click
        $('#{{$id_btn}}').on("click",  function() {
            ajax_item_get(
                "{{$read_link}}",
                {
                    product_id: "{{$id_item}}"
                },    
                "{{$sorter_name}}"
            );}
        )
            //download //delete
        document.getElementById('{{$sorter_name}}').addEventListener('click', function(event) {
            DeletedButton = event.target.closest('.delete_img');
            if (DeletedButton) {
                id = DeletedButton.getAttribute('data-link');
                ajax_item_action('{{$delete_link}}',
                    {
                        video: id,
                        id: "{{$id_item}}",
                    },
                    function(){ $('#{{$id_btn}}').click();  }
                );
            }
        });
        // Инициализация SortableJS
        const sortable = new Sortable(document.getElementById('{{$sorter_name}}'), {
            animation: 100,
            onEnd: function (evt) {
                items = document.querySelectorAll('#{{$sorter_name}} .sortable-item');
                
                order = Array.from(items).map(item => item.getAttribute('data-id'));

                ajax_item_action('{{$update_link}}',{
                    img: order,
                        product_id: "{{$id_item}}",
                    },
                    function(){ $('#{{$id_btn}}').click();  }
                );
              
            }
        });
        

        // Открыть окно выбора файла при нажатии кнопки
        document.getElementById('{{$id_name}}').addEventListener('click', function() {
            links = $("#{{$id_name}}_input").val();
                ajax_item_action('{{$create_link}}',
                    {
                        product_id: "{{$id_item}}",
                        link: links,
                    },
                    function(){ $('#{{$id_btn}}').click();  }
                );
        });


   
 
</script>

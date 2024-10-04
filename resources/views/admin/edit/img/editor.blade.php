@php
    ///  $id_n  - getting from outside 
    /// $path_link - getting from outside 

$id_n = $id_n. "item".$id_item;

$add_id = "add_img_$id_n"; //add img button

$sorter_name = "$id_n-list-img";

$id_name = $id_n. "item".$id_item; 

$id_btn = $id_name . "load"; // button for gettin editor

$file_input_id = $sorter_name ."_file_input";


$read_link = $path_link.'/read';
$delete_link = $path_link.'/delete';
$update_link = $path_link.'/update';
$create_link = $path_link.'/create';

//img
$prefix_img_path= "/images/product/$id_item" . "_";
$postfix_img_path = "_small.webp";
@endphp

<div class="sort_editor">
    <p>Перше зліва зображення відображатиметься як головне. Зображення зберігаються в розмірі 700x700 пікселів.</p>
    <div>
        <div class="img_sorter" id="{{$sorter_name}}">
        </div>
        <div class="top_buttons">
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
                <form style="display:none;" enctype="multipart/form-data">
                    <input type="file" id="{{$sorter_name}}FileInput" name="file" style="display:none;" />
                </form>
            </button>
        </div>
    </div>

</div>
<button class="up" id="{{$id_btn}}" style="display:none;">⟳</button>
<script>
    //download //delete
    document.getElementById('{{$sorter_name}}').addEventListener('click', function(event) {
        DownloadButton = event.target.closest('.download_img');
        if (DownloadButton) {
            console.log("123");
            var id = DownloadButton.getAttribute('data-id');
            const fileUrl = '{{$prefix_img_path}}' + id + '{{$postfix_img_path}}'; // Ссылка на файл
            const fileName = "{{$id_item}}" + '_' + id + '.webp'; // Имя файла, которое будет отображено
            const a = document.createElement('a'); // Создаём ссылку
            a.href = fileUrl; // Устанавливаем URL файла
            a.download = fileName; // Устанавливаем имя файла для загрузки
            document.body.appendChild(a); // Добавляем ссылку в DOM
            a.click(); // Программно кликаем на ссылку для инициации загрузки
            document.body.removeChild(a); // Удаляем ссылку после скачивания
        }
        DeletedButton = event.target.closest('.delete_img');
        if (DeletedButton) {
            console.log("12"); 
                ajax_item_action('{{$delete_link}}', 
                    {
                        img: DeletedButton.getAttribute('data-id'),
                        id: "{{$id_item}}",
                    },
                    function() {
                        $('#{{$id_btn}}').click();
                    }
                );
        }

    });


    // Function to get the current order of items
    function getOrder_img() {
        const items = document.querySelectorAll('#{{$sorter_name}} .sortable-item');
        const order = Array.from(items).map(item => item.getAttribute('data-id'));
        return order;
        //console.log('Current order:', order);
    }
    // Инициализация SortableJS
    const sortable_img = new Sortable(document.getElementById('{{$sorter_name}}'), {
        animation: 100,
        onEnd: function() {
            ajax_item_action('{{$update_link}}', 
                    {
                        img: getOrder_img(),
                        product_id: "{{$id_item}}"
                    },
                    function() {
                        $('#{{$id_btn}}').click();
                    }
                );
        }
    });

    //send img
    fileInput = document.getElementById('{{$sorter_name}}FileInput');
    // Открыть окно выбора файла при нажатии кнопки
    document.getElementById('{{$add_id}}').addEventListener('click', function() {
        fileInput = document.getElementById('{{$sorter_name}}FileInput');
        fileInput.click(); // Имитируем клик по скрытому input
    });
    // Отправляем файл сразу после выбора
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            formData = new FormData();
            formData.append('file', fileInput.files[0]); // Добавляем файл в formData
            formData.append('product_id', "{{$id_item}}"); // Добавляем product_id
            formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Добавляем CSRF токен
            StartLoading('#product_edit_field');
            $.ajax({
                url: '{{$create_link}}',
                type: 'POST',
                data: formData,
                processData: false, // Не обрабатывать данные
                contentType: false, // Не устанавливать заголовок contentType
                success: function(response) {
                    $('#{{$id_btn}}').click();
                    showNotification(response, duration = 5000);
                },
                error: function(xhr, status, error) {
                    $('#{{$id_btn}}').click();
                    showNotification("Помилка " + error, duration = 5000, 0);
                },
                complete: function() {
                    StopLoading('#product_edit_field');
                }
            });
        }
    });
 
    $('#{{$id_btn}}').on("click", function() {
        console.log();
        ajax_item_get("{{$read_link }}", {
            product_id: "{{$id_item}}",
            path_start: "{{$prefix_img_path}}",
            path_end: "{{$postfix_img_path}}",
        }, "{{$sorter_name}}");
    });



</script>
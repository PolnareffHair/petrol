@php

use App\Services\FormBuilder;
$form = new FormBuilder();

$form->create($product,$form_object);

@endphp

@php

    $Pid = $product["product_id"];
    echo " <script>

        const product_id = $Pid;
    </script>";
    @endphp
@include("admin.header")

<body>

    @include("admin.menu")

    <div id="notification-container"></div>

    <script>
        $(document).ready(function() {
            //download //delete
            document.getElementById('sortable-list').addEventListener('click', function(event) {
                DownloadButton = event.target.closest('.download_img');
                if (DownloadButton) {
                    var id = DownloadButton.getAttribute('data-id');
                    console.log("download" + id);
                    const fileUrl = '/images/product/' + product_id + '_' + id + '_big.webp'; // Ссылка на файл
                    const fileName = product_id + '_' + id + '_big.webp'; // Имя файла, которое будет отображено
                    const a = document.createElement('a'); // Создаём ссылку
                    a.href = fileUrl; // Устанавливаем URL файла
                    a.download = fileName; // Устанавливаем имя файла для загрузки
                    document.body.appendChild(a); // Добавляем ссылку в DOM
                    a.click(); // Программно кликаем на ссылку для инициации загрузки
                    document.body.removeChild(a); // Удаляем ссылку после скачивания
                }
                DeletedButton = event.target.closest('.delete_img');
                if (DeletedButton) {
                    id = DeletedButton.getAttribute('data-id');
                    // Второй AJAX-запрос для обновления корзины
                    document.getElementById('sortable-list').classList.remove("loaded");
                    document.getElementById('sortable-list').classList.add('on_loading');

                    $.ajax({
                        url: '/admin/product_edit/img/delete',
                        type: 'POST',
                        data: {
                            img: id,
                            id: product_id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            get_img_editor()
                            document.getElementById('sortable-list').classList.remove("loaded");
                            document.getElementById('sortable-list').classList.add('on_loading');
                            showNotification("Успішно видалено", duration = 5000)
                        },
                        error: function(xhr, status, error) {

                            get_img_editor()
                            document.getElementById('sortable-list').classList.remove("on_loading");
                            document.getElementById('sortable-list').classList.add('loaded');
                            showNotification("Помилка " + error, duration = 5000, 0)
                        },
                        complete: function() {}
                    });
                }
            });
            // Initialize SortableJS
            const sortable = new Sortable(document.getElementById('sortable-list'), {
                animation: 100,
            });
            //send img
            console.log("alive");


            fileInput = document.getElementById('ImgFileInput');

            uploadButton = document.getElementById('add_img_product');

            // Открыть окно выбора файла при нажатии кнопки
            uploadButton.addEventListener('click', function() {
                fileInput.click(); // Имитируем клик по скрытому input
                console.log("alive");
            });
            // Отправляем файл сразу после выбора
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    formData = new FormData();
                    formData.append('file', fileInput.files[0]); // Добавляем файл в formData
                    formData.append('product_id', product_id); // Добавляем product_id
                    formData.append('_token', $('meta[name="csrf-token"]').attr(
                        'content')); // Добавляем CSRF токен

                    document.getElementById('sortable-list').classList.remove("loaded");
                    document.getElementById('sortable-list').classList.add('on_loading');

                    $.ajax({
                        url: '/admin/product_edit/img/add',
                        type: 'POST',
                        data: formData,
                        processData: false, // Не обрабатывать данные
                        contentType: false, // Не устанавливать заголовок contentType
                        success: function(response) {
                            get_img_editor();
                            showNotification("Файл успішно додано", duration = 5000);
                        },
                        error: function(xhr, status, error) {
                            get_img_editor();
                            showNotification("Помилка " + error, duration = 5000, 0);
                        }
                    });
                }

            });
            // Function to get the current order of items
            function getOrder() {
                const items = document.querySelectorAll('#sortable-list .sortable-item');
                const order = Array.from(items).map(item => item.getAttribute('data-id'));
                return order;
                //console.log('Current order:', order);
            }
            //set order img 
            document.getElementById('refresh_sort_product').addEventListener('click', function(event) {

                document.getElementById('sortable-list').classList.remove("loaded");
                document.getElementById('sortable-list').classList.add('on_loading');

                $('#add_img_product').fadeTo("0.15", 0.33);
                $('#refresh_sort_product').fadeTo("0.15", 0.33);
                $('#add_img_product').attr("disabled", true)
                $('#refresh_sort_product').attr("disabled", true)
                $.ajax({
                    url: '/admin/product_edit/img/uppdate',
                    type: 'POST',
                    data: {
                        img: getOrder(),
                        product_id: product_id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        get_img_editor()
                        showNotification("Послідовність успішно збережено", duration = 5000)
                        $('#add_img_product').attr("disabled", false)
                        $('#refresh_sort_product').attr("disabled", false)
                        $('#add_img_product').fadeTo("0.15", 1);
                        $('#refresh_sort_product').fadeTo("0.15", 1);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        get_img_editor();
                        showNotification("Помилка " + error, duration = 5000, 0);
                        $('#add_img_product').attr("disabled", false)
                        $('#refresh_sort_product').attr("disabled", false)
                        $('#add_img_product').fadeTo("0.15", 1);
                        $('#refresh_sort_product').fadeTo("0.15", 1);
                    },
                    complete: function() {}
                });
            });

        });
    </script>



    <div id="product_edit_field" class="main_plate">
        <div class="fixed_buttons" x-data="{open_img_edit:false,open_cat_edit:false,open_attr_edit:false}">
            <div id="expand_menu">
                <svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" transform="scale(-1, 1)">
                    <path fill="white" d="M452.864 149.312a29.12 29.12 0 0 1 41.728.064L826.24 489.664a32 32 0 0 1 0 44.672L494.592 874.624a29.12 29.12 0 0 1-41.728 0 30.592 30.592 0 0 1 0-42.752L764.736 512 452.864 192a30.592 30.592 0 0 1 0-42.688zm-256 0a29.12 29.12 0 0 1 41.728.064L570.24 489.664a32 32 0 0 1 0 44.672L238.592 874.624a29.12 29.12 0 0 1-41.728 0 30.592 30.592 0 0 1 0-42.752L508.736 512 196.864 192a30.592 30.592 0 0 1 0-42.688z" />
                </svg>

            </div>






            <script>
                jQuery.fn.rotate = function(degrees) {
                    $(this).css({
                        'transform': 'rotate(' + degrees + 'deg)'
                    });
                    return $(this);
                };

                if (window.innerWidth < 740) {
                    $("#main_menu").hide();
                    $("#expand_menu").rotate(180);
                } else $("#close_menu_button").hide();


                $("#expand_menu").on("click", function() {

                    let currentRotation = $(this).data('rotation') || 0;
                    let newRotation = currentRotation === 180 ? 0 : 180;
                    // Вращаем элемент
                    $(this).rotate(newRotation);
                    $(this).data('rotation', newRotation);
                    $("#main_menu").toggle();
                    $("#close_menu_button").show();
                });
                $("#close_menu_button").on("click", function() {
                    let currentRotation = $(this).data('rotation') || 0;
                    let newRotation = currentRotation === 180 ? 0 : 180;
                    $(this).rotate(newRotation);
                    $(this).data('rotation', newRotation);
                    $("#main_menu").toggle();
                    $("#close_menu_button").hide();
                });
            </script>
            <button class="save_button" onclick="" id="save_product"> <svg viewBox="0 0 20 21" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.707 5.47104L14.707 0.47104C14.5195 0.28349 14.2652 0.178096 14 0.17804H1C0.734784 0.17804 0.48043 0.283396 0.292893 0.470933C0.105357 0.658469 0 0.912823 0 1.17804V19.178C0 19.4433 0.105357 19.6976 0.292893 19.8851C0.48043 20.0727 0.734784 20.178 1 20.178H19C19.2652 20.178 19.5196 20.0727 19.7071 19.8851C19.8946 19.6976 20 19.4433 20 19.178V6.17804C19.9999 5.91284 19.8946 5.65853 19.707 5.47104ZM6 18.178V11.178H14V18.178H6ZM18 18.178H16V10.178C16 9.91282 15.8946 9.65847 15.7071 9.47093C15.5196 9.2834 15.2652 9.17804 15 9.17804H5C4.73478 9.17804 4.48043 9.2834 4.29289 9.47093C4.10536 9.65847 4 9.91282 4 10.178V18.178H2V2.17804H13.5859L18 6.59214V18.178Z"
                        fill="white"></path>
                    <path d="M13 12.178H7V14.178H13V12.178Z" fill="white"></path>
                </svg>Зберегти
            </button>
            <button class="neutral_button" onclick="        " id="save_product">
                <svg fill="white" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21,10V20a1,1,0,0,1-1,1H10a1,1,0,0,1-1-1V10a1,1,0,0,1,1-1H20A1,1,0,0,1,21,10ZM6,14H5V5h9V6a1,1,0,0,0,2,0V4a1,1,0,0,0-1-1H4A1,1,0,0,0,3,4V15a1,1,0,0,0,1,1H6a1,1,0,0,0,0-2Z" />
                </svg>
                Дублювати
            </button>

            <button class="delete_button" onclick="delete_product()" id="save_product"><svg viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433284 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C19.997 7.34876 18.9424 4.80697 17.0677 2.93226C15.193 1.05755 12.6512 0.00301726 10 0ZM10 18C8.41775 18 6.87104 17.5308 5.55544 16.6518C4.23985 15.7727 3.21447 14.5233 2.60897 13.0615C2.00347 11.5997 1.84504 9.99113 2.15372 8.43928C2.4624 6.88743 3.22433 5.46197 4.34315 4.34315C5.46197 3.22433 6.88743 2.4624 8.43928 2.15372C9.99113 1.84504 11.5997 2.00346 13.0615 2.60896C14.5233 3.21447 15.7727 4.23984 16.6518 5.55544C17.5308 6.87103 18 8.41775 18 10C17.9976 12.121 17.1539 14.1544 15.6542 15.6542C14.1544 17.1539 12.121 17.9976 10 18Z"
                        fill="white" />
                    <path d="M14 9H6V11H14V9Z" fill="white" />
                </svg>
                Видалити</button>
        </div>
        <h1>Товар</h1>

        <div class="product_operation">

            <div id="tags_selector" x-data="tagSelector()" style="padding: 20px;">
                <div>
                    <template x-for="(tag, index) in availableTags" :key="index">   
                        <button @click="selectTag(index)" style="padding: 5px 10px; cursor: pointer;">
                            <span x-text="tag.name">Tag1</span>
                        </button>
                        <button @click="selectTag(index)" style="padding: 5px 10px; cursor: pointer;">
                            <span x-text="tag.name">Tag2</span>
                        </button>
                        <button @click="selectTag(index)" style="padding: 5px 10px; cursor: pointer;">
                            <span x-text="tag.name">Tag3</span>
                        </button>
                       
                    </template>
                </div>
                <div  id="tag_list">
                        <template x-for="(tag, index) in selectedTags" :key="index">
                            <div>
                                <span x-text="tag.name"></span>
                                <button @click="removeTag(index)" class="remove_tag">
                                    <svg width="800px" height="800px" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <!-- Выпадающий список для выбора значения -->
                                <div>
                                    <select x-model="tag.value" style="padding: 5px;">
                                        <template x-for="value in tag.availableValues" :key="value.id">
                                            <option :value="value.id" x-text="value.value"></option>
                                        </template>
                                    </select>
                                </div>
                                <!-- Кнопка для удаления тега -->       
                            </div>
                        </template>
                </div>

                <script>
                    function tagSelector() {
                        return {
                            availableTags: [{
                                    name: 'Tag1',
                                    availableValues: [{
                                        id: 1,
                                        value: 'Value1'
                                    }, {
                                        id: 2,
                                        value: 'Value2'
                                    }, {
                                        id: 3,
                                        value: 'Value3'
                                    }]
                                },
                                {
                                    name: 'Tag2',
                                    availableValues: [{
                                        id: 4,
                                        value: 'ValueA'
                                    }, {
                                        id: 5,
                                        value: 'ValueB'
                                    }, {
                                        id: 6,
                                        value: 'ValueC'
                                    }]
                                },
                                {
                                    name: 'Tag3',
                                    availableValues: [{
                                        id: 4,
                                        value: 'ValueA'
                                    }, {
                                        id: 5,
                                        value: 'ValueB'
                                    }, {
                                        id: 6,
                                        value: 'ValueC'
                                    }]
                                }
                            ], // Уникальные наборы значений с ID для каждого тега
                            selectedTags: [],

                            // Функция для выбора тега
                            selectTag(index) {
                                const tag = this.availableTags.splice(index, 1)[0]; // Удаляем тег из доступных
                                this.selectedTags.push({
                                    ...tag,
                                    value: ''
                                }); // Добавляем тег в выбранные с пустым значением
                            },

                            // Функция для удаления тега
                            removeTag(index) {
                                const tag = this.selectedTags.splice(index, 1)[0]; // Удаляем тег из выбранных
                                this.availableTags.push({
                                    name: tag.name,
                                    availableValues: tag.availableValues
                                }); // Возвращаем тег в список доступных
                            }
                        }
                    }
                </script>
            </div>




            <div class="sort_editor">
                <p>Перше зліва зображення відображатиметься як головне. Зображення зберігаються в розмірі 700x700 пікселів.</p>

                <div class="img_sorter" id="sortable-list" data-pid="{{$product["product_id"]}}">

                </div>
                <div class="top_buttons">

                    <button class="add_item" id="add_img_product">
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
                            <input type="file" id="ImgFileInput" name="file" style="display:none;" />
                        </form>
                    </button>
                    <button class="refresh_sort" id="refresh_sort_product">
                        <svg fill="white" width="800px" height="800px" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.59 3.03h12.2v1.26H3.59zm0 4.29h12.2v1.26H3.59zm0 4.35h12.2v1.26H3.59zM.99 4.79h.49V2.52H.6v.45h.39v1.82zm.87 3.88H.91l.14-.11.3-.24c.35-.28.49-.5.49-.79A.74.74 0 0 0 1 6.8a.77.77 0 0 0-.81.84h.52A.34.34 0 0 1 1 7.25a.31.31 0 0 1 .31.31.6.6 0 0 1-.22.44l-.87.75v.39h1.64zm-.36 3.56a.52.52 0 0 0 .28-.48.67.67 0 0 0-.78-.62.71.71 0 0 0-.77.75h.5a.3.3 0 0 1 .27-.32.26.26 0 1 1 0 .51H.91v.38H1c.23 0 .37.11.37.29a.29.29 0 0 1-.33.29.35.35 0 0 1-.36-.35H.21a.76.76 0 0 0 .83.8.74.74 0 0 0 .83-.72.53.53 0 0 0-.37-.53z" />
                        </svg>
                        Зберегти послідовність
                    </button>

                </div>

            </div>


            {!!$form->get_html()!!}
        </div>
    </div>
    {!!$form->get_scrits()!!}
    <script>
        //get img list for editor
        function get_img_editor() {
            $.ajax({
                url: '/admin/product_edit/img/get/' + product_id,
                type: 'GET',
                data: {
                    _token: csrf_token
                },
                success: function(response) {
                    document.getElementById("sortable-list").innerHTML = response;
                    document.getElementById('sortable-list').classList.remove("on_loading");
                    document.getElementById('sortable-list').classList.add('loaded');
                },
                error: function(xhr, status, error) {
                    alert(error);
                    document.getElementById('sortable-list').classList.remove("on_loading");
                    document.getElementById('sortable-list').classList.add('loaded');
                }
            });
        }
        get_img_editor();




        //save product info
        document.getElementById("save_product").addEventListener("click", function() {
            let result = {};
            for (let key in form_options) {
                if (form_options.hasOwnProperty(key)) {
                    result[key] = eval(form_options[key]); // Выполняем код в значении
                }
            }
            // console.log(result);
            $.ajax({
                url: '/admin/uppdate_product',
                type: 'POST',
                data: {
                    productchange: result,
                    _token: csrf_token
                },
                success: function(response) {
                    document.getElementById('refresh_sort_product').click();
                    showNotification("Продукт успішно оновлено", duration = 5000);
                },
                error: function(xhr, status, error) {
                    showNotification("Помилка " + error, duration = 5000, 0);
                }
            });
        });



        //delete product 
        function delete_product($id) {
            if (window.confirm("Ви впевнені що хочете видалити продукт?")) {
                $.ajax({
                    url: '/admin/delete_product',
                    type: 'POST',
                    data: {
                        product_id: "{{ $product['product_id']}}",
                        _token: csrf_token
                    },
                    success: function(response) {
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        alert(response);
                    }
                });
            }
        }
    </script>
</body>

</html>

<script>
    $("#product_edit_field").scrollTop(0);
</script>
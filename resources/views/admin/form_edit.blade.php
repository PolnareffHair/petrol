@php



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



    <div id="product_edit_field" class="main_plate">
        <div class="fixed_buttons" x-data="{open_img_edit:false,open_cat_edit:false,open_attr_edit:false}">
            <div id="expand_menu">
                <svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" transform="scale(-1, 1)">
                    <path fill="white" d="M452.864 149.312a29.12 29.12 0 0 1 41.728.064L826.24 489.664a32 32 0 0 1 0 44.672L494.592 874.624a29.12 29.12 0 0 1-41.728 0 30.592 30.592 0 0 1 0-42.752L764.736 512 452.864 192a30.592 30.592 0 0 1 0-42.688zm-256 0a29.12 29.12 0 0 1 41.728.064L570.24 489.664a32 32 0 0 1 0 44.672L238.592 874.624a29.12 29.12 0 0 1-41.728 0 30.592 30.592 0 0 1 0-42.752L508.736 512 196.864 192a30.592 30.592 0 0 1 0-42.688z" />
                </svg>
            </div>

            <button class="save_button" onclick="" id="save_item"> <svg viewBox="0 0 20 21" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.707 5.47104L14.707 0.47104C14.5195 0.28349 14.2652 0.178096 14 0.17804H1C0.734784 0.17804 0.48043 0.283396 0.292893 0.470933C0.105357 0.658469 0 0.912823 0 1.17804V19.178C0 19.4433 0.105357 19.6976 0.292893 19.8851C0.48043 20.0727 0.734784 20.178 1 20.178H19C19.2652 20.178 19.5196 20.0727 19.7071 19.8851C19.8946 19.6976 20 19.4433 20 19.178V6.17804C19.9999 5.91284 19.8946 5.65853 19.707 5.47104ZM6 18.178V11.178H14V18.178H6ZM18 18.178H16V10.178C16 9.91282 15.8946 9.65847 15.7071 9.47093C15.5196 9.2834 15.2652 9.17804 15 9.17804H5C4.73478 9.17804 4.48043 9.2834 4.29289 9.47093C4.10536 9.65847 4 9.91282 4 10.178V18.178H2V2.17804H13.5859L18 6.59214V18.178Z"
                        fill="white"></path>
                    <path d="M13 12.178H7V14.178H13V12.178Z" fill="white"></path>
                </svg>Зберегти
            </button>
            <button class="neutral_button" onclick="" id="duplicate_item">
                <svg fill="white" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21,10V20a1,1,0,0,1-1,1H10a1,1,0,0,1-1-1V10a1,1,0,0,1,1-1H20A1,1,0,0,1,21,10ZM6,14H5V5h9V6a1,1,0,0,0,2,0V4a1,1,0,0,0-1-1H4A1,1,0,0,0,3,4V15a1,1,0,0,0,1,1H6a1,1,0,0,0,0-2Z" />
                </svg>
                Дублювати
            </button>
            <button class="delete_button" onclick="delete_item()" id="delete_item"><svg viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433284 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C19.997 7.34876 18.9424 4.80697 17.0677 2.93226C15.193 1.05755 12.6512 0.00301726 10 0ZM10 18C8.41775 18 6.87104 17.5308 5.55544 16.6518C4.23985 15.7727 3.21447 14.5233 2.60897 13.0615C2.00347 11.5997 1.84504 9.99113 2.15372 8.43928C2.4624 6.88743 3.22433 5.46197 4.34315 4.34315C5.46197 3.22433 6.88743 2.4624 8.43928 2.15372C9.99113 1.84504 11.5997 2.00346 13.0615 2.60896C14.5233 3.21447 15.7727 4.23984 16.6518 5.55544C17.5308 6.87103 18 8.41775 18 10C17.9976 12.121 17.1539 14.1544 15.6542 15.6542C14.1544 17.1539 12.121 17.9976 10 18Z"
                        fill="white" />
                    <path d="M14 9H6V11H14V9Z" fill="white" />
                </svg>
                Видалити</button>

        </div>
        <h1>Товар</h1>
        <div class="product_operation" id ="product_operation">
            <h1>tags</h1>
            <h1>cats 2 lvls</h1>
            @include("admin.components.tags_editor",['id_item'=>$Pid])
            @include("admin.components.img_editor")
            {!!$form->get_html()!!}
        </div>
    </div>
    {!!$form->get_scrits()!!}
</body>

</html>

<script>
            //save product info
            document.getElementById("save_item").addEventListener("click", function() {
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
        function delete_item($id) {
            if (window.confirm("Ви впевнені що хочете видалити продукт?")) {
                $.ajax({
                    url: '/admin/delete_product',
                    type: 'POST',
                    data: {
                        product_id: "{{ $product['product_id']}}",
                        _token: csrf_token
                    },
                    success: function(response) {
                        console.log(response);
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        alert(response);
                    }
                });
            }
        }
</script>

<script>
    //scroll to top
    $("#product_edit_field").scrollTop(0);


    //some ajustment for menu
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
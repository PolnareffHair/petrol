<!DOCTYPE html>
<html lang="en">
@php
$token =csrf_token();
echo " <script>
    csrf_token = '$token';
</script>"
@endphp
@include("admin.header")

<body>

    <div id="main_menu">

        <h2> <img class="logo" src="/admin_svg/logo.svg" alt=""> K.Y.F. adm</h2>
        <button type="button"><img src="/admin_svg/Home.svg" alt=""><span>Головна сторінка</span><img
                class="/admin_svg/svg_arrow" src="/admin_svg/arrow.svg" alt=""></button>
        <button type="button"><img src="/admin_svg/product.svg" alt=""><span>Продукція</span><img class="svg_arrow"
                src="/admin_svg/arrow.svg" alt=""></button>
        <button type="button"><img src="/admin_svg/Layout.svg" alt=""><span>Категорії</span><img class="svg_arrow"
                src="/admin_svg/arrow.svg" alt=""></button>

        <button type="button"><img src="/admin_svg/Grid.svg" alt=""><span>Атрибути</span><img class="svg_arrow"
                src="/admin_svg/arrow.svg" alt=""></button>

        <button type="button"><img src="/admin_svg/Diagram.svg" alt=""><span>Аналітика</span><img class="svg_arrow"
                src="/admin_svg/arrow.svg" alt=""></button>


    </div>


    <div class="main_plate">
        <span id="report_status"></span>
        <h1>Головна сторінка</h1>

        <div class="product_operation">

            <div x-data="{ expanded: false }" class="basik_uppdate_field">
                <h2 x-data="{ drop_down1_rotation: 0, rotation: 0}" @click=" drop_down1_rotation ? rotation += 180 : rotation -= 180;
                    drop_down1_rotation = !drop_down1_rotation;
                    expanded = !expanded " style="cursor: pointer;">
                    Налаштування тексту
                    головної сторінки
                    <img :style="'transform: rotate(' + rotation + 'deg)'" class="drop_down" src="admin_svg/play.svg"
                        alt="">
                </h2>


                <div x-show="expanded" x-collapse>

                    <h3>Ua</h3>

                    <textarea class="editor" id="editorUA"></textarea>

                    <h3>Ru</h3>

                    <textarea class="editor" id="editorRU"></textarea>

                    <button class="save_button" onclick="sendText()"> <svg viewBox="0 0 20 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.707 5.47104L14.707 0.47104C14.5195 0.28349 14.2652 0.178096 14 0.17804H1C0.734784 0.17804 0.48043 0.283396 0.292893 0.470933C0.105357 0.658469 0 0.912823 0 1.17804V19.178C0 19.4433 0.105357 19.6976 0.292893 19.8851C0.48043 20.0727 0.734784 20.178 1 20.178H19C19.2652 20.178 19.5196 20.0727 19.7071 19.8851C19.8946 19.6976 20 19.4433 20 19.178V6.17804C19.9999 5.91284 19.8946 5.65853 19.707 5.47104ZM6 18.178V11.178H14V18.178H6ZM18 18.178H16V10.178C16 9.91282 15.8946 9.65847 15.7071 9.47093C15.5196 9.2834 15.2652 9.17804 15 9.17804H5C4.73478 9.17804 4.48043 9.2834 4.29289 9.47093C4.10536 9.65847 4 9.91282 4 10.178V18.178H2V2.17804H13.5859L18 6.59214V18.178Z"
                                fill="black" />
                            <path d="M13 12.178H7V14.178H13V12.178Z" fill="black" />
                        </svg>Зберегти
                        зміни</button>
                </div>

            </div>


            <div style="display: none;" ></div>
            <script>
                $('#editorUA').summernote('code', @json($page_text_ua));
                $('#editorUA').summernote({
                    toolbar: [
                        // Настраиваем панель инструментов без кнопки видео
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview']]
                    ]
                });


                $('#editorRU').summernote('code', @json($page_text_ru));
                $('#editorRU').summernote({
                    toolbar: [
                        // Настраиваем панель инструментов без кнопки видео
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview']]
                    ]
                });


                function sendText() {

                    htmlContentUA = $('#editorUA').summernote('code');
                    htmlContentRU = $('#editorRU').summernote('code');
                    console.log(csrf_token);
                    $.ajax({
                        url: '/uppdate_main_page_text',
                        type: 'POST',
                        data: {
                            textUA: JSON.stringify(
                                [htmlContentUA]
                            ),
                            textRU: JSON.stringify(
                                [htmlContentRU]
                            ),
                            _token: csrf_token,

                        },
                        success: function(response) {
                            $("#report_status").removeClass();
                            $("#report_status").text("Збережено");

                            $("#report_status").css("opacity", "1");
                            $("#report_status").addClass("result_sucess");

                            // Убираем класс через время, чтобы вернуться в состояние 1
                            setTimeout(function() {
                                $("#report_status").removeClass();
                                $("#report_status").css("opacity", "0");
                            }, 2000); // Время возврата в состояние 1 (совпадает с длительностью анимации)

                        },
                        error: function(xhr, status, error) {
                            $("#report_status").removeClass();
                            $("#report_status").text("Помилка");

                            $("#report_status").css("opacity", "1");
                            $("#report_status").addClass("result_fail");

                            // Убираем класс через время, чтобы вернуться в состояние 1
                            setTimeout(function() {
                                $("#report_status").removeClass();
                                $("#report_status").css("opacity", "0");
                            }, 2000); // Время возврата в состояние 1 (совпадает с длительностью анимации)

                        }
                    });
                }
            </script>

        </div>

    </div>

</body>

</html>

@include("common.header")
@php

if ($page_options["currentUser"]!= null) {
$attributes = $page_options["currentUser"]->getAttributes( );
}
@endphp



<div id="background_header_top">

</div>
<div id="background_header_bottom">

</div>




    <main id=user_page>
        <section id="user_page_buttons">
            <h1>Сторінка користувача</h1>

            <a class="user_page_button">
                <div class="user_page_svg_container">
                    <svg id="person_button_svg_icon" width="150" height="150" viewBox="0 0 150 150" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M55.4305 90.0233C55.8577 86.261 45.2989 71.8454 43.3703 64.9414C39.2322 57.9857 37.7674 46.9186 42.2717 39.5621C44.0661 36.6402 43.297 34.1062 43.297 30.0595C43.297 -10.0198 109.543 -10.0198 109.543 30.0595C109.543 35.1276 108.456 36.317 111.032 40.312C115.365 46.9703 113.144 58.7873 109.482 64.9672C107.126 72.2203 96.0543 85.9378 96.8233 90.0491C97.5191 110.606 55.3206 109.921 55.4305 90.0491V90.0233ZM79.5753 125.577H81.9067C82.9137 125.574 83.8787 125.15 84.5919 124.397C85.3051 123.644 85.7088 122.623 85.7152 121.557V115.002C85.7152 114.472 85.6167 113.947 85.4253 113.458C85.2339 112.969 84.9534 112.524 84.5997 112.149C84.2461 111.775 83.8262 111.478 83.3642 111.275C82.9021 111.072 82.4069 110.968 81.9067 110.968H68.101C67.0919 110.971 66.1251 111.397 65.4115 112.153C64.698 112.909 64.2957 113.933 64.2925 115.002V121.557C64.2989 122.624 64.7022 123.646 65.4151 124.401C66.1279 125.156 67.0929 125.584 68.101 125.59H70.4691L65.916 150H83.933L79.5753 125.577ZM0 150C1.79438 125.435 -2.75871 126.431 16.6621 118.738C26.2044 114.865 35.3463 109.965 43.944 104.116L60.5451 150H0ZM106.857 102.034C114.678 107.579 123.131 112.049 132.015 115.338C150.142 121.725 150.142 122.617 149.971 150H89.658L106.857 102.034Z"
                            fill="#272727" />
                    </svg>

                </div>
                <span>Особисті данні</span>
            </a>
            <a class="user_page_button">
                <div class="user_page_svg_container">
                    <svg id="orders_button_svg_icon" width="150" height="160" viewBox="0 0 150 160" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M48.2943 49.1175H101.235M48.2943 84.4118H101.235M48.2943 119.706H83.5884M30.6471 5H118.882C128.629 5 136.529 12.9009 136.529 22.6471V137.353C136.529 147.099 128.629 155 118.882 155H30.6471C20.9009 155 13 147.099 13 137.353V22.6471C13 12.9009 20.9009 5 30.6471 5Z"
                            stroke="#222222" stroke-width="10" stroke-linecap="round" />
                    </svg>

                </div>
                <span>Мої замовлення</span>
            </a>
            <a class="user_page_button">
                <div class="user_page_svg_container">
                    <svg id="wishes_button_svg_icon" width="28" height="28" viewBox="0 0 28 28" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.9166 6.70353C14.7616 6.87391 14.6067 7.04664 14.4153 7.25251L13.8889 7.82278L13.342 7.27144C13.1802 7.10817 13.0161 6.94016 12.8566 6.77689C11.1658 5.04951 9.89197 3.74806 7.26915 3.71256C7.16661 3.7102 7.05723 3.71256 6.9433 3.7173C5.47579 3.77172 4.12223 4.33253 3.13326 5.29087C2.15796 6.23738 1.53587 7.57905 1.51536 9.21178C1.51308 9.31353 1.51536 9.42002 1.51991 9.53596C1.67715 14.0958 5.87913 18.0735 9.36331 21.3697C10.0355 22.0062 10.6804 22.6167 11.298 23.2343L13.8638 25.8017L17.0882 22.4795C17.6078 21.9447 18.1957 21.3602 18.8246 20.7355C19.8933 19.6707 21.0828 18.4899 22.1903 17.2997C22.9856 16.4455 23.7398 15.5865 24.3801 14.7607C25.0091 13.9514 25.5241 13.1824 25.8545 12.4962C26.3968 11.3698 26.5677 10.2435 26.4515 9.19049C26.3376 8.15169 25.9434 7.18152 25.3532 6.35333C24.7539 5.5133 23.9563 4.81761 23.0425 4.34199C21.9898 3.79775 20.7843 3.53983 19.5515 3.68653C17.4255 3.94209 16.2929 5.18912 14.9166 6.70353ZM13.8479 5.58665C15.4202 3.85691 16.7259 2.43951 19.3783 2.12479C20.9096 1.94259 22.409 2.25967 23.7148 2.94116C24.8427 3.52799 25.8271 4.38459 26.5655 5.41865C27.3106 6.46454 27.8096 7.69264 27.9555 9.01302C28.1036 10.3523 27.8894 11.7792 27.2035 13.199C26.8161 14.0011 26.2419 14.8624 25.556 15.7451C24.8837 16.6111 24.0999 17.5056 23.2772 18.3882C22.1493 19.6021 20.9507 20.7947 19.8705 21.869C19.2393 22.496 18.6491 23.0829 18.1524 23.594L14.4016 27.4581L13.8752 28L13.342 27.4676L10.2429 24.3678C9.67549 23.8022 9.01922 23.1799 8.33788 22.5339C4.64406 19.0342 0.184577 14.8151 0.00455746 9.59039C0 9.46261 0 9.3301 0 9.19285C0.0273448 7.09634 0.834016 5.36422 2.09871 4.13849C3.35201 2.92459 5.05423 2.21471 6.88633 2.14609C7.01166 2.14136 7.14382 2.13899 7.28283 2.14136C10.4822 2.18632 11.9451 3.64158 13.8479 5.58665Z"
                            fill="black" />
                    </svg>
                </div>
                <span>Список бажань</span>
            </a>
            @if($page_options["currentUser"]["adm"] == 1)
            <a href="/admin" class="user_page_button">
            <div class="user_page_svg_container">
                    <svg  width="800px" height="800px"  fill="#000000"  viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                        <path d="m773.596 1069.654 711.086 711.085c39.632 39.632 104.336 39.632 144.078 0l138.276-138.385c19.268-19.269 29.888-44.778 29.888-71.93 0-27.26-10.62-52.77-29.888-72.039l-698.714-698.714 11.495-32.625c63.5-178.675 18.284-380.45-115.284-514.018-123.715-123.605-305.126-171.01-471.648-128.313l272.281 272.282c32.516 32.406 50.362 75.652 50.362 121.744 0 45.982-17.846 89.227-50.362 121.744L654.48 751.17c-67.222 67.003-176.375 67.003-243.488 0L138.711 478.889c-42.589 166.522 4.707 347.934 128.313 471.648 123.714 123.715 306.22 172.325 476.027 127.218l30.545-8.101ZM1556.611 1920c-54.084 0-108.168-20.692-149.333-61.857L740.095 1190.96c-198.162 41.712-406.725-19.269-550.475-163.019C14.449 852.771-35.256 582.788 65.796 356.27l32.406-72.696 390.194 390.193c24.414 24.305 64.266 24.305 88.68 0l110.687-110.686c11.824-11.934 18.283-27.59 18.283-44.34 0-16.751-6.46-32.516-18.283-44.34L297.569 84.207 370.265 51.8C596.893-49.252 866.875.453 1041.937 175.515c155.026 155.136 212.833 385.157 151.851 594.815l650.651 650.651c39.961 39.852 61.967 92.95 61.967 149.443 0 56.383-22.006 109.482-61.967 149.334l-138.275 138.385c-41.275 41.165-95.36 61.857-149.553 61.857Z" fill-rule="evenodd"/>
                    </svg>
            </div>
                <span>Адмін панель</span>         
            </a>
            @endif
            <a href="/logout" class="user_page_button">
                <div class="user_page_svg_container">
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg width="800px" height="800px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                        stroke-width="3" stroke="#000000" fill="none">
                        <polyline points="46.02 21.95 55.93 31.86 46.02 41.77" />
                        <line x1="55.93" y1="31.86" x2="19.59" y2="31.86" />
                        <path
                            d="M40,38.18V52a2.8,2.8,0,0,1-2.81,2.8H12A2.8,2.8,0,0,1,9.16,52V11.77A2.8,2.8,0,0,1,12,9H37.19A2.8,2.8,0,0,1,40,11.77V25" />
                    </svg>
                </div>
                <span>Вийти</span>
            </a>

           
            <style>
                #questions_button_svg_icon svg {
                    fill: blue;
                    stroke: blue;
                    color: blue;
                }

                #questions_button_svg_icon+span {
                    color: blue;
                }
            </style>

        </section>

        <form method="POST" action="/dashboards" style="align-items: center;flex-direction: column;"
            class="user_page_fields">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2>
                Особисті данні
            </h2>
            @php
            $changes= "fail";
            @endphp

            @if($changes=="sucsess")


            @elseif($changes=="fail")
            <P style=" transition: opacity 0.2s ease-in-out;opacity:0;" id="report"> &nbsp;</P>
            <Br>
            @endif


            <div class=" user_page_field_container" id="user_edit_form">

                <div class="user_page_field_container_flex_block">
                    <h3>
                        Прізвище та ім'я <span style="font-weight:400;color:grey;">(Від 5-ти символів)</span>
                    </h3>
                    <div class="user_page_field_container_flex_block_box">
                        <label for="name">Ім'я та Прізвище</label>
                        <input name="name" id="name_user_change" class="name" type="text"
                            value="{{$attributes["name"]}}">
                    </div>


                </div>
                <div class="user_page_field_container_flex_block">
                    <h3>
                        Контакти
                    </h3>
                    <div class="user_page_field_container_flex_block_box">
                        <label for="user_number_change">Номер телефону</label>
                        <input class="user_number_change" type="text" value="{{$attributes["phone_number"]}}"
                            name="phone_number" id="phone_number_user_change">
                    </div>
                    <div class="user_page_field_container_flex_block_box">

                        <label for="email">Електронна пошта</label>
                        <input class="email" type="email" value="{{$attributes["email"]}}" name="email">
                    </div>

                </div>
                <div class="user_page_field_container_flex_block">
                    <h3>
                        Пароль <span style="font-weight:400;color:grey;">(Від 8-ми символів, мінімум 1 буква та
                            цифра)</span>
                    </h3>
                    <div class="user_page_field_container_flex_block_box">
                        <label for="user_password_new_change">Новий пароль</label>
                        <input class="user_password_new_change" type="password" name="password" id="change_password">
                    </div>
                    <div class="user_page_field_container_flex_block_box">
                        <label for="user_password_new_copy_change">Новий пароль знову</label>
                        <input class="user_password_new_copy_change" type="password" id="second_password"
                            name="Password_Duplicate">
                    </div>
                </div>

            </div>
            <button type="button" id="user_page_save_changes_button" disabled="true" style="opacity:0.5;">Зберегти
                зміни</button>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js">
            </script>





        </form>

    </main>

    @include("common.footer")

</body>


<script>
    // Сохраняем текущее состояние полей при загрузке страницы
    var originalData = {
        name: $('#name_user_change').val(),
        phone_number: $('#phone_number_user_change').val(),
        email: $('input[name="email"]').val(),
        password: $('#change_password').val()
    };

    function checkForChanges() {
        $('#user_page_save_changes_button').prop('disabled', false);
        $('#user_page_save_changes_button').css('opacity', "1");

    }

    // Назначаем обработчик событий на все нужные поля
    $('#name_user_change, #phone_number_user_change, input[name="email"], #change_password').on('click input',
        checkForChanges);


    // Change user data script 
    $('#user_page_save_changes_button').click(function() {
        $('#user_edit_form').css("opacity", "0.5");

        var newData = {
            name: $('#name_user_change').val(),
            phone_number: $('#phone_number_user_change').val(),
            email: $('input[name="email"]').val(),
            password: $('#change_password').val()
        };


        //cons  ole.log(newData);
        var dataToSend = {};
        // Проверяем, какие данные изменились и добавляем их в dataToSend
        $.each(newData, function(key, value) {
            if (originalData[key] !== value) {
                dataToSend[key] = value;
            }
        });


        // Если нет измененных данных, ничего не отправляем
        if ($.isEmptyObject(dataToSend)) {
            $('#user_edit_form').css("opacity", "1");

            $('#report').css("opacity", "1");
            $('#report').html('Відсутні зміни');
            $('#report').css("color", "red");

            return null;
        }

        //Проверка пароля 
        if (newData.password != "") {
            const pattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
            pass = String(newData.password);
            pass2 = String($('#second_password').val());

            if (pass2 != pass) {
                $('#user_edit_form').css("opacity", "1");
                $('#report').css("color", "red");
                $('#report').css("opacity", "1");
                $('#report').html('Помилка: паролі не співпадають'); // Обработка ошибки
                return null;
            }
            if (!pattern.test(pass)) {
                $('#user_edit_form').css("opacity", "1");
                $('#report').css("color", "red");
                $('#report').css("opacity", "1");
                $('#report').html('Помилка: пароль не відповідає правилам'); // Обработка ошибки
                return null;
            }
        }
        if (newData.phone_number != "" && newData.phone_number.includes('_')) {

            $('#user_edit_form').css("opacity", "1");
            $('#report').css("color", "red");
            $('#report').css("opacity", "1");
            $('#report').html('Помилка: не повний номер телефону'); // Обработка ошибки
            return null;
        }
        $.ajax({


            url: '/dashboards', // Укажите маршрут на ваш контроллер
            type: 'POST',
            data: $.extend(dataToSend, {
                _token: csrf_token
            }), // Добавляем CSRF-токен
            success: function(response) {
                $('#user_edit_form').css("opacity", "1");

                response = response;

                console.log(response.answer);

                $('#report').html(response.answer); // Обработка успешного ответа
                $('#report').css("color", "green");
                $('#report').css("opacity", "1");
                if (response.type == 1) $('#report').css("color", "green");
                originalData = newData;
                $('#user_page_save_changes_button').prop('disabled', true);
                $('#user_page_save_changes_button').css('opacity', "0.5");
            },
            error: function(xhr) {
                $('#user_edit_form').css("opacity", "1");
                $('#report').css("color", "red");
                $('#report').css("opacity", "1");
                $('#report').html('Ошибка: ' + xhr.status + ' ' + xhr.statusText); // Обработка ошибки
            }

        });
    });
</script>

</html>
let debounceTimer;

//add to favorite
function sendAjaxRequestFavorite(event) {
    const product_id = event.currentTarget.getAttribute('data-variable');
    let element = event.currentTarget;
    if (!product_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }
    element.disabled = true;
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    element.style.opacity = '0';

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function () {
        $.ajax({
            url: '/fav_add',
            type: 'POST',
            data: {
                _token: csrf_token,
                product_id: product_id
            },
            success: function (response) {
                element.classList.remove('add_favorite');
                element.classList.add('remove_favorite');

                let img = element.querySelector('.p_ico');
                img.src = '/img/svg/favorite_sel.svg';

                let msg = element.querySelector('.added');
                msg.classList.add('msg_on');

                setTimeout(function() {
                    msg.classList.remove('msg_on');
                }, 1500);

                
                // Удаление старого слушателя и добавление нового
                element.removeEventListener('click', sendAjaxRequestFavorite);
                element.addEventListener('click', sendAjaxRequestRemoveFavorite);

                element.style.opacity = '1';
                element.disabled = false;
            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                element.style.opacity = '1';
                element.disabled = false; // Включаем кнопку в случае ошибки
            }
        });
    }, 200);
}
//remove from favorite
function sendAjaxRequestRemoveFavorite(event) {
    const product_id = event.currentTarget.getAttribute('data-variable');
    let element = event.currentTarget;
    if (!product_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }
    element.disabled = true;
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    element.style.opacity = '0';
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
        $.ajax({
            url: '/fav_remove',
            type: 'POST',
            data: {
                _token: csrf_token,
                product_id: product_id
            },
            success: function (response) {


                let img = element.querySelector('.p_ico');
                img.src = '/img/svg/favorite.svg';


                let msg = element.querySelector('.remove');
                msg.classList.add('msg_on');

                setTimeout(function() {
                    msg.classList.remove('msg_on');
                }, 1500);

                element.classList.add('add_favorite');
                element.classList.remove('remove_favorite');

                // Удаление старого слушателя и добавление нового
                element.removeEventListener('click', sendAjaxRequestRemoveFavorite);
                element.addEventListener('click', sendAjaxRequestFavorite);

                element.style.opacity = '1';
                element.disabled = false;
            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                element.style.opacity = '1';
                element.disabled = false; // Включаем кнопку в случае ошибки
            }
        });
    }, 200);
}

const addFavorite = document.querySelectorAll('.add_favorite');
addFavorite.forEach(function (button) {
        button.addEventListener('click', sendAjaxRequestFavorite);
    });

const removeFavorite = document.querySelectorAll('.remove_favorite');
removeFavorite.forEach(function (button) {
        button.addEventListener('click', sendAjaxRequestRemoveFavorite);
});


//send call / question
$('#send_call_button').on('click', function() {

    $('#call_report').css({
        "color": "white",
        "opacity": "1"
    }).html('');

    // Проверка на неполный номер телефона
    if ($('#pnum_input').val().includes('_')) {  

        if($('#pnum_input').hasClass("input_error")){

            $('#pnum_input').removeClass( "input_error");

            setTimeout(function(){  $('#pnum_input').addClass( "input_error");},200)
        }
        else $('#pnum_input').addClass( "input_error");
             

        return; // Прекращаем выполнение, если номер неполный
    }

    StartLoading('#send_call_button');


    $('#pnum_input').removeClass( "input_error");

    $('#call_question').addClass( "input_sccsess");

    $('#pnum_input').addClass( "input_sccsess");
    // Выполнение AJAX-запроса
    $.ajax({
        url: '/call_me', // Укажите URL для обработки запроса на сервере
        type: 'POST', // Метод запроса (POST, GET и т.д.)
        data: {
            phone_number: $('#pnum_input')
                .val(), // Данные, отправляемые на сервер
            text: $('#call_question').val(),
            _token: $('meta[name="csrf-token"]').attr(
                'content') // Добавлен CSRF-токен
        },
        success: function(response) {

            $(".remover_call").css("display", "none");
            $('#call_window_response').toggle();
            $('#call_window_main').css("height", "auto");
        },
        error: function(xhr, status, error) {
            $('#send_call_button').toggleClass("loading");
            // Обработка ошибок
            $('#call_report').css({
                "color": "red",
                "opacity": "1"
            }).html('Помилка: ' + error);
            console.log(error)
        } ,
        complete: function(){       StopLoading('#send_call_button');
            
        }

    });
});


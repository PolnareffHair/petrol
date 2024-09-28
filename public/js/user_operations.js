let debounceTimer;
const csrf_token_user  = $('meta[name="csrf-token"]').attr('content');
//add to favorite
function sendAjaxRequestFavorite(event) {
    const product_id = event.currentTarget.getAttribute('data-variable');
    let element = event.currentTarget;
    if (!product_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }
    element.disabled = true;
    element.style.opacity = '0';



    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function () {
        $.ajax({
            url: '/fav_add',
            type: 'POST',
            data: {
                _token: csrf_token_user ,
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
                setTimeout( element.style.opacity = '',200);
                element.disabled = false;
            },
            error: function (xhr, status, error) {
                window.location.reload();
                console.log('Произошла ошибка:', error);
                element.style.opacity = '1';
                setTimeout( element.style.opacity = '',200);    
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
    element.style.opacity = '0';
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
        $.ajax({
            url: '/fav_remove',
            type: 'POST',
            data: {
                _token: csrf_token_user,
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
                setTimeout( element.style.opacity = '',200);
                element.disabled = false;
            },
            error: function (xhr, status, error) {
                window.location.reload();
                console.log('Произошла ошибка:', error);
                element.style.opacity = '1';
                setTimeout( element.style.opacity = '',200);
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
$('#send_call_button').on('click', function(event) {
    event.preventDefault(); // предотвращает отправку формы
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
            _token:  csrf_token_user
        },
        success: function(response) {

            $(".remover_call").css("display", "none");
            $('#call_window_response').toggle();
            $('#call_window_main').css("height", "auto");
        },
        error: function(xhr, status, error) {
            window.location.reload();
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






$(".product_order").click( function (e) { 
    
    $("#order_product_open").click();
    $(".remover_order").show();
    $("#order_window_main").css("height", "355px");
            
    $("#order_window_response").css("display", "none");
    $('#pnum_input_order').removeClass( "input_sccsess");
    $('#pnum_input_order').val("+3(80_)___-__-___");
    id =  $(this).data("variable");

    StartLoading("#order_window");
    $.ajax({
        url: '/get_product_order',
        type: 'POST',
        data: {
            lang:$('html').attr('lang'),
            _token:
             csrf_token_user,
            id: id
        },
        success: function (response) { 

            $("#order_product_response").html(response);
            StopLoading("#order_window")
        },
        error: function (xhr, status, error) {
            console.log('Произошла ошибка:', error);
        }
    });
});

//sewnd order product 
$('#send_order_button').on('click', function(  event) {

    event.preventDefault(); // предотвращает отправку формы
    // Проверка на неполный номер телефона
    if ($('#pnum_input_order').val().includes('_')) {  

        if($('#pnum_input_order').hasClass("input_error")){

            $('#pnum_input_order').removeClass( "input_error");

            setTimeout(function(){  $('#pnum_input_order').addClass( "input_error");},200)
        }
        else $('#pnum_input_order').addClass( "input_error");
             
        return; // Прекращаем выполнение, если номер неполный
    }

    StartLoading('#order_window');

    $('#pnum_input_order').removeClass( "input_error");
    $(".remover_order").hide();
    $('#pnum_input_order').addClass( "input_sccsess");

    // Выполнение AJAX-запроса
    $.ajax({
        url: '/order_product', // Укажите URL для обработки запроса на сервере
        type: 'POST', // Метод запроса (POST, GET и т.д.)
        data: {
            _token: csrf_token_user ,

            pn: $('#pnum_input_order').val(), // Данные, отправляемые на сервер

            id: $('#get_product_order_id').data("id"),

        },
        success: function(response) {
            $("#order_window_main").css("height", "200px");
            
            $("#order_window_response").css("display", "flex");
        },
        error: function(xhr, status, error) {
            window.location.reload();
            console.log(error)
        } ,
        complete: function(){       StopLoading('#order_window');
            
        }

    });
});



//scroll up
$(window).on("scroll", function() {
    if ($(this).scrollTop() > 100) {  // When the scroll is greater than 100px
        $("#up_button").fadeIn();  // Show the button
    } else {
        $("#up_button").fadeOut(); // Hide the button
    }
});
$("#up_button").fadeIn();  // Show the button



$(document).ready(function() {
    // Пример кнопки с ID "scrollTopButton"
    $('#up_button').click(function() {
        // Анимация прокрутки к верху страницы
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
});

$("#login_in_button").click(function (e) { 
    StartLoading("#login_window_f");
    e.preventDefault();
    $.ajax({
    url: '/login',
    type: 'POST',
    data: {
        _token: csrf_token_user,
        password: $("#password_input").val(),
        phone_number: $("#pnum_input_login").val(),
    },
    success: function(response) {

       console.log(response);
       
       if(response == 0) window.location.href = '/dashboards';

    },
    error: function(xhr, status, error) {
        window.location.reload();
        console.log(error);
    }
    ,
    complete: function(){
        StopLoading("#login_window_f");
    }
});
});

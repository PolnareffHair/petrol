
$("#user_compare").on("click", function () {
    StartLoading('#compare_basis');
    $.ajax({
        url: '/comp_show',
        type: 'POST',
        data: {
            lang: $('html').attr('lang'),
            _token: csrf_token,
        },
        success: function (response) {
            $("#compare_basis").html(response);
        },
        error: function (xhr, status, error) {
            console.log('Произошла ошибка:', error);
        },
        complete: function () {
            StopLoading('#compare_basis');
        }
    });
});
$("main").on("click", ".remove_compare", function() {
    const compare_id = $(this).data('variable');
    const item = $(this); // Сохраняем ссылку на элемент, чтобы использовать в таймере
    let debounceTimerCompare;

    if (!compare_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }

    item.prop('disabled', true);
    item.css('opacity', '0');

    const csrf_token = $('meta[name="csrf-token"]').attr('content');

    // Локальный таймер для каждого элемента
    clearTimeout(debounceTimerCompare);
    debounceTimerCompare = setTimeout(function () {
        $.ajax({
            url: '/remove_compare',
            type: 'POST',
            data: {
                _token: csrf_token,
                compare_id: compare_id
            },
            success: function (response) {
                item.addClass('add_compare').removeClass('remove_compare');

                const img = item.find('.p_ico');
                img.attr('src', '/img/svg/compare.svg');
                
                item.css('opacity', '1');
                
                setTimeout(item.css('opacity', ''),200)

                const msg = item.find('.remove');
                msg.addClass('msg_on');

                setTimeout(function() {
                    msg.removeClass('msg_on');
                }, 1500);

                $("#compare_counter").text(response.compare_counter);
                item.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                window.location.reload();
                console.log('Произошла ошибка:', error);
                item.css('opacity', '1');
                setTimeout(item.css('opacity', ''),200)
                item.prop('disabled', false); // Включаем кнопку в случае ошибки
            }
        });
    }, 200);
});


$("main").on("click", ".add_compare", function () {
    const compare_id = $(this).data('variable');
    const item = $(this); // Сохраняем ссылку на элемент
    let debounceTimerCompareAdd;

    if (!compare_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }

    item.prop('disabled', true);
    item.css('opacity', '0');

    const csrf_token = $('meta[name="csrf-token"]').attr('content');

    // Локальный таймер для каждого элемента
    clearTimeout(debounceTimerCompareAdd);
    debounceTimerCompareAdd = setTimeout(function () {
        $.ajax({
            url: '/add_compare',
            type: 'POST',
            data: {
                _token: csrf_token,
                compare_id: compare_id
            },
            success: function (response) {
                item.addClass('remove_compare').removeClass('add_compare');

                $("#compare_counter").text(response.compare_counter);

                const img = item.find('.p_ico');
                img.attr('src', '/img/svg/compare_sel.svg');

                const msg = item.find('.added');
                msg.addClass('msg_on');

                setTimeout(function () {
                    msg.removeClass('msg_on');
                }, 1500);

                item.css('opacity', '1');

                setTimeout(item.css('opacity', ''),200)

                item.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                window.location.reload();
                console.log('Произошла ошибка:', error);
                item.css('opacity', '1');
                setTimeout(item.css('opacity', ''),200)
                item.prop('disabled', false);
            }
        });
    }, 200);
});






// delete compare in window
$("#compare_basis").on("click", ".delete", function () {

    container = $(this).parent().parent();
    let id = $(this).data("id");
    container.addClass('load');

    $.ajax({
        url: '/remove_compare',
        type: 'POST',
        data: {
            _token: csrf_token,
            compare_id: id
        },
        success: function (response) {


            remove = $('.remove_compare[data-variable="' + id + '"]')
            console.log(1);
            // Удаляем класс remove_compare
            remove.removeClass('remove_compare');
            // Добавляем класс add_compare
            remove.addClass('add_compare');
            img = remove.find('.p_ico');
            img.attr('src', '/img/svg/compare.svg');

            container.removeClass('load');
            $("#compare_counter").text(response.compare_counter);
            $("#user_compare").click();
        },
        error: function (xhr, status, error) {
            window.location.reload();
            console.log(error);
            container.removeClass('load');
        }
    });

});

$(document).on("click", "#clear_compare", function () {
    console.log("clear compare clicked");

    $.ajax({
        url: '/clear_compare',
        type: 'POST',
        data: {
            _token: csrf_token,  // Убедись, что csrf_token определён
        },
        success: function (response) {
            console.log('Success:', response);
            $("#user_compare").click();  // Выполняем клик по #user_compare
            $("#compare_counter").text(response.compare_counter);

            $('.remove_compare').each(function () {
                // Удаляем класс remove_compare
                $(this).removeClass('remove_compare');

                // Добавляем класс add_compare
                $(this).addClass('add_compare');
                
                img = $(this).find('.p_ico');
                img.attr('src', '/img/svg/compare.svg');

                setTimeout(function () {
                    $("#fade").click();
                }, 1500);
            });
        },
        error: function (xhr, status, error) {
            window.location.reload();
            console.log('Произошла ошибка:', error);
        }
    });
});

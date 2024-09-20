let debounceTimerCompare;

$("#user_compare").on( "click",function(){
    StartLoading('#compare_basis');
    $.ajax({
    url: '/comp_show',
    type: 'POST',
    data: {
        lang: lang,
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
    }});
    });

$("main").on("click", ".add_compare", function() {
    compare_id = $(this).data('variable');

    if (!compare_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }

    $(this).prop('disabled', true);

    const csrf_token = $('meta[name="csrf-token"]').attr('content');

    $(this).css('opacity', '0');
    item =  $(this);



    clearTimeout(debounceTimerCompare);

    debounceTimerCompare = setTimeout(function () {
        $.ajax({
            url: '/add_compare',
            type: 'POST',
            data: {
                _token: csrf_token,
                compare_id: compare_id
            },
            success: function (response) {

                item.addClass('remove_compare');
                item.removeClass('add_compare');

                $("#compare_counter").text(response.compare_counter) ;

                let img =  item.find('.p_ico');
                img.attr('src', '/img/svg/compare_sel.svg');

                
         
                let msg =  item.find('.added');

                msg.addClass('msg_on');

                setTimeout(function() {
                    msg.removeClass('msg_on');
                }, 1500);

                item.css('opacity', '1');
                item.prop('disabled', false); 

            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                item.css('opacity', '1');
                item.prop('disabled', false); 
            }
        });
    }, 200);

});     





$("main").on("click", ".remove_compare", function() {
     compare_id = $(this).data('variable');

    if (!compare_id) {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }
    $(this).prop('disabled', true);

    const csrf_token = $('meta[name="csrf-token"]').attr('content');

    $(this).css('opacity', '0');

    clearTimeout(debounceTimerCompare);
    item =  $(this);
    debounceTimerCompare = setTimeout(function () {
        $.ajax({
            url: '/remove_compare',
            type: 'POST',
            data: {
                _token: csrf_token,
                compare_id: compare_id
            },
            success: function (response) {

             
   
                item.addClass('add_compare');
                item.removeClass('remove_compare');
            
                let img =  item.find('.p_ico');
                img.attr('src', '/img/svg/compare.svg');
                
                item.css('opacity', '1');
          
                let msg =  item.find('.remove');

                msg.addClass('msg_on');

                setTimeout(function() {
                    msg.removeClass('msg_on');
                }, 1500);

                $("#compare_counter").text(response.compare_counter) ;
    
                item.prop('disabled', false);

            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                 item.css('opacity', '1');
                 item.prop('disabled', false); // Включаем кнопку в случае ошибки
            }
        });
    }, 200);

});     








// delete compare in window
$("#compare_basis").on("click", ".delete", function() {
                    
    container= $(this).parent().parent();
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


            remove = $('.remove_compare[data-variable="'+ id+'"]')
            console.log(1);
            // Удаляем класс remove_compare
            remove .removeClass('remove_compare');
            // Добавляем класс add_compare
            remove .addClass('add_compare');
            img =  remove.find('.p_ico');
            img.attr('src', '/img/svg/compare.svg');
            





            container.removeClass('load');
            $("#compare_counter").text(response.compare_counter);
            $("#user_compare").click();
        },
        error: function (xhr, status, error) {
            console.log(error);
            container.removeClass('load');
        }
    });

});

$(document).on("click", "#clear_compare", function() {
    console.log("clear compare clicked");

    $.ajax({
        url: '/clear_compare',
        type: 'POST',
        data: {
            _token: csrf_token,  // Убедись, что csrf_token определён
        },
        success: function(response) {
            console.log('Success:', response);
            $("#user_compare").click();  // Выполняем клик по #user_compare
            $("#compare_counter").text(response.compare_counter);

            $('.remove_compare').each(function() {
                // Удаляем класс remove_compare
                $(this).removeClass('remove_compare');

                // Добавляем класс add_compare
                $(this).addClass('add_compare');
                img =  $(this).find('.p_ico');
                img.attr('src', '/img/svg/compare.svg');

                setTimeout(function() {
                    $("#fade").click();  
                }, 1500);
            });
        },
        error: function(xhr, status, error) {
            console.log('Произошла ошибка:', error);
        }
    });
});

var current_window;

function set_window(fade_id, window_id, open_button_id, close_button_id, close_button_id_second) {

    var fade = document.getElementById(fade_id);
    var modal = document.getElementById(window_id);
    var btn = document.getElementById(open_button_id);
    if (typeof close_button_id !== undefined) {
        var close = document.getElementById(close_button_id);
    }


    if (typeof close_button_id_second !== 'undefined') {

        var btn_second = document.getElementById(close_button_id_second)
        btn_second.onclick = function () {
            document.body.style.overflowY = "scroll";
            fade.style.display = "none";
            modal.style.display = "none";
        }
    }
    btn.onclick = function () {
        document.body.style.overflowY = "hidden";

        if (current_window != undefined) {
            current_window.style.display = "none";
        }
        fade.style.display = "block";
        modal.style.display = "block";
        current_window = modal;
    }
    // Закрываем модальное окно при клике на крестик
    close.onclick = function () {
        // console.log("cls.click");
        document.body.style.overflowY = "scroll";

        fade.style.display = "none";
        modal.style.display = "none";
    }
    // Закрываем модальное окно при клике вне его
    window.onclick = function (event) {

        // console.log("win.click");

        if (event.target == fade) {
            if (current_window.style.display == "block") {
                document.body.style.overflowY = "scroll";
            }
            fade.style.display = "none";
            if (current_window !== undefined) {
                current_window.style.display = "none";
            }

        }
    }
}
function cls_all(){
    $('#fade').click(); 
}


//Установка общих кнопок для открытия окон пользователя и фейда

set_window("fade", "call_window", "call", "close_call_btton");

set_window("fade", "basket_window", "user_basket", "close_basket_btton", "basket_back");

if (auth == 0) {
    set_window("fade", "login_window", "user_log", "close_login_btton");
}

set_window("fade", "catalog_window", "catalog_button", "close_catalog_btton", "close_catalog_btton_subcategory");

set_window("fade", "contacts_window", "show_contacts_button", "close_contact_btton");

set_window("fade", "compare_window", "user_compare", "compare_close");


set_window("fade", "menu_burger", "burger", "close_burger");

set_window("fade", "order_window", "order_product_open", "close_order_button");





//Получение счетчиков корзины и сравнения, при открытии мобильного меню
$('#burger').on("click",function(){  
    $("#basket_counter_dup").html( $("#basket_counter").html());
 $("#compare_counter_dup").html( $("#compare_counter").html());
})

// Дубль нажатия кнопки в меню бургера и хидера 
function relaph(id,OriginalId){
    $(id).on('click', function() {
        $(OriginalId).click(); // Программное нажатие на кнопку
    });
}
relaph('#menu_catalog','#catalog_button');
relaph('#show_contacts_button_dupl','#show_contacts_button');
relaph('#menu_profile','#user_log');
relaph('#menu_call','#call');
relaph('#menu_basket','#user_basket');
relaph('#menu_compare','#user_compare');
relaph('#call_button','#call');
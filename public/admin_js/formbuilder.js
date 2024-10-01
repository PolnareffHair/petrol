
const lang_map = {
    'А': 'A',
    'Б': 'B',
    'В': 'V',
    'Г': 'G',
    'Д': 'D',
    'Е': 'E',
    'Ё': 'E',
    'Ж': 'Zh',
    'З': 'Z',
    'И': 'I',
    'І': 'I',
    'Й': 'Y',
    'К': 'K',
    'Л': 'L',
    'М': 'M',
    'Н': 'N',
    'О': 'O',
    'П': 'P',
    'Р': 'R',
    'С': 'S',
    'Т': 'T',
    'У': 'U',
    'Ф': 'F',
    'Х': 'Kh',
    'Ц': 'Ts',
    'Ч': 'Ch',
    'Ш': 'Sh',
    'Щ': 'Shch',
    'Ы': 'Y',
    'Э': 'E',
    'Ю': 'Yu',
    'Я': 'Ya',
    'а': 'a',
    'б': 'b',
    'в': 'v',
    'г': 'g',
    'д': 'd',
    'е': 'e',
    'ё': 'e',
    'ж': 'zh',
    'з': 'z',
    'и': 'i',
    'і': 'i',
    'й': 'y',
    'к': 'k',
    'л': 'l',
    'м': 'm',
    'н': 'n',
    'о': 'o',
    'п': 'p',
    'р': 'r',
    'с': 's',
    'т': 't',
    'у': 'u',
    'ф': 'f',
    'х': 'kh',
    'ц': 'ts',
    'ч': 'ch',
    'ш': 'sh',
    'щ': 'shch',
    'ы': 'y',
    'э': 'e',
    'ю': 'yu',
    'я': 'ya',
    'ь': '',
    'ъ': ''
};

function set_number_limit(id, min, max) {

    document.getElementById(id).addEventListener('input', function () {
        var value = this.value;
        console.log(value);
        if (value == '') {
            this.value = 0;
        }
        if (value < min) this.value = min; // Если значение меньше минимального, установи минимальное значение
        if (value > max) this.value = max; // Если значение больше максимального, установи максимальное значение
    });
}

function set_copy_text_ru_ua(id, copy, name) {
    document.getElementById(name).addEventListener('click', function () {

        $(('input[id=\"' + id + '_ru\"]')).val($('input[id=\"' + copy + '_ru\"]').val());
        $(('input[id=\"' + id + '_ua\"]')).val($('input[id=\"' + copy + '_ua\"]').val());
    });
}

function set_copy_text_trans_ru_ua(id, copy, name) {
    document.getElementById(name).addEventListener('click', function () {
        // Используем правильный селектор для jQuery
        var ru_url = $(('#' + copy + '_ru')).val();
        var ua_url = $(('#' + copy + '_ua')).val();
        // Заменяем каждую букву согласно карте для русского
        $('#' + id + '_ru').val(ru_url.split('').map(function (char) {
            return lang_map[char] || char; // Используем карту для замены символов
        }).join('')
            .toLowerCase() // Преобразуем в нижний регистр
            .replace(/\s+/g, '-') // Заменяем пробелы на дефисы
            .replace(/[^a-z0-9\-]/g, '') // Убираем неразрешенные символы
            .replace(/-+/g, '-') // Убираем лишние дефисы
            .replace(/^-+|-+$/g, '') // Убираем дефисы в начале и конце строки
        );
        // Заменяем каждую букву согласно карте для украинского
        $('#' + id + '_ua').val(ua_url.split('').map(function (char) {
            return lang_map[char] || char;
        }).join('')
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^a-z0-9\-]/g, '')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '')
        );
    });
}
function set_lenght_limit(id, max) {
    document.getElementById(id).addEventListener('input', function () {
        var value = this.value;
        if (value.length > max) {
            this.value = value.slice(0, max);
        }
        if (value === '') {
            value = 0;
        }
    });

}

function set_html_field(id) {
    var text = document.getElementById('DATA' + id + '_ua').getAttribute('data-text');

    $('#ID' + id + "_ua")
        .summernote({
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
            ],
            placeholder: 'Write your blog content here...',
            tabsize: 1,
            height: 300,
            focus: true,
            followingToolbar: true,
        });
    $('#ID' + id + "_ua").summernote('code', text);

    var text = document.getElementById('DATA' + id + '_ru').getAttribute('data-text');
    $('#ID' + id + "_ru")
        .summernote({
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
            ],
            placeholder: 'Write your blog content here...',
            tabsize: 1,
            height: 300,
            focus: true,
            followingToolbar: true,
        });
    $('#ID' + id + "_ru").summernote('code', text);
}

function showNotification(message, duration = 5000, state = 1, type = 1) {
    // Создаем контейнер для уведомления
    const container = document.getElementById('notification-container');
    const notification = document.createElement('div');

    if (state == 1) notification.classList.add('notification_on');
    else notification.classList.add('notification_off');
    notification.classList.add('notification');
    notification.innerText = message;

    container.appendChild(notification);

    // Убираем уведомление после заданного времени
    setTimeout(() => {
        notification.classList.add('hide');
        setTimeout(() => {
            notification.remove();
        }, 500); // Убираем элемент после анимации
    }, duration);
}

function set_input_novoid(id) {

    document.getElementById(id).addEventListener('input', function () {
        var value = this.value;

        if (value == '') {
            this.style.borderColor = 'red'; // Изменение цвета границы на красный
            $(this).prev('label').css("color", 'red');

            $("#save_item").hide();
        } else {
            $(this).prev('label').css("color", '');
            $("#save_item").show();
            this.style.borderColor = ''; // Убираем цвет границы, если поле не пустое
        }
    });
}


function ajax_item_get(link,data_json,on_end){
    $.ajax({
        url: link,
        type: 'POST',
        data: data_json,
        beforeSend: function() {
            StartLoading("#product_edit_field"); 
        },
        success: function(response) {
            on_end(response);
        },
        error: function(xhr, status, error) {
            ////
            console.log(error);
            showNotification("Помилка " + error, duration = 5000, 0);
        },
        complete: function() {
            StopLoading("#product_edit_field");
        }
    });
}
function ajax_item_action(link,data_json,on_end){
    $.ajax({
        url: link,
        type: 'POST',
        data:data_json,
        beforeSend: function() {
            StartLoading("#product_edit_field"); 
        },
        success: function(response) {
            on_end();
            showNotification(response, duration = 5000)
        },
        error: function(xhr, status, error) {
            on_end();
            console.log(error);
            showNotification("Помилка " + error, duration = 5000, 0);
        },
        complete: function() {
            StopLoading("#product_edit_field");
        }
    });
}
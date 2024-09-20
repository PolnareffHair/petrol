previousValues = {};
//remove add product listener from product buttons that bought
const selectedProductButtons = document.querySelectorAll('.product_add_basket_selected');
selectedProductButtons.forEach(function (button) {
    button.removeEventListener("click", sendAjaxBasketAdd)
    button.addEventListener('click', function () { document.querySelector('#user_basket').click(); });

});

//add product to basket
function sendAjaxBasketAdd(event) {
    productId = event.currentTarget.getAttribute('data-variable');

    let element = event.currentTarget;

    if (productId === null || productId === '') {
        console.error('Ошибка: идентификатор продукта не найден или пустой.');
        return;
    }

    element.disabled = true; // Отключаем только текущую кнопку

    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    $(element).css("opacity", 0);
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function () {
        $.ajax({
            url: '/guest_basket_add',
            type: 'POST',
            data: {
                lang:lang,
                _token: csrf_token,
                productId: productId
            },
            success: function (response) { 


                document.querySelector("#basket_counter").textContent = response.product_count;

                /*Имитирует клик на корзину после добавления товара */
                document.querySelector('#user_basket').click();
                element.textContent = "У кошику";
                element.classList.add('product_add_basket_selected');
                element.style.opacity = '1';

                element.removeEventListener("click", sendAjaxBasketAdd);

                element.addEventListener("click", function () {
                    document.querySelector('#user_basket').click();
                })
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
const buttons = document.querySelectorAll('.product_add_basket');
buttons.forEach(function (button) {
    button.addEventListener('click', sendAjaxBasketAdd);
});



// Функция для проверки изменения значения
function checkValueChange(input) {
    currentValue = input.value;
    id = input.getAttribute('data-id');

    if (currentValue !== previousValues[id]) {
        parentElement = input.closest(
            '.basket_product'
        ); // Предполагается, что родительский элемент имеет класс 'basket_item'

        // Устанавливаем непрозрачность родительского элемента
        parentElement.style.opacity = '0.5';


        // AJAX-запрос для удаления товара из корзины
        $.ajax({
            url: '/guest_change',
            type: 'POST',
            data: {
                lang:lang,
                productId: id,
                productChange: currentValue,
                _token: $('meta[name="csrf-token"]').attr('content'),

            },
            success: function (response) {
                // Второй AJAX-запрос для обновления корзины
                $.ajax({
                    url: '/guest_basket_get',
                    type: 'POST',
                    data: {
                        lang:lang,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#basket_list').html(response);
                        $('#basket_prcie').html("До сплати " + fullprice +
                            " ₴");
                        inputs = document.querySelectorAll('.tracked-input');

                        // Назначаем обработчики события focus и blur для каждого поля ввода
                        inputs.forEach(input => {
                            input.addEventListener('focus', onFocus);
                            input.addEventListener('blur', onBlur);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    },
                    complete: function () {
                        // Восстанавливаем прозрачность родительского элемента после получения ответа
                        parentElement.style.opacity = '1';
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                // Восстанавливаем прозрачность родительского элемента в случае ошибки
                parentElement.style.opacity = '1';
            }
        });
        previousValues[id] = currentValue;
    }
}

// Обработчик события focus
function onFocus(event) {
    input = event.target;
    id = input.getAttribute('data-id');
    previousValues[id] = input.value; // Инициализируем предыдущее значение

    // Запускаем интервал для проверки изменений
    input.checkInterval = setInterval(() => checkValueChange(input), 1800);
}
// Обработчик события blur
function onBlur(event) {
    input = event.target;
    clearInterval(input.checkInterval);
}

inputs = document.querySelectorAll('.tracked-input');

// Словарь для хранения предыдущих значений

// Назначаем обработчики события focus и blur для каждого поля ввода
inputs.forEach(input => {
    input.addEventListener('focus', onFocus);
    input.addEventListener('blur', onBlur);
});

///Запит по натиску на кнопку кошика

$('#user_basket').on('click', function () {
    // Выполнение AJAX-запроса
    StartLoading('#basket_list');
    $.ajax({
        url: '/guest_basket_get', // Укажите URL для обработки запроса на сервере
        type: 'POST', // Метод запроса (POST, GET и т.д.)
        data: {
            _token: $('meta[name="csrf-token"]').attr(
                'content'), // Добавлен CSRF-токен
            lang:  lang
        },
        success: function (response) {
            // Обновляем содержимое элемента с id="basket_list"
            $('#basket_list').html(response);

            $('#basket_prcie').html("До сплати " + fullprice +
                " ₴");

            inputs = document.querySelectorAll('.tracked-input');
            // Назначаем обработчики события focus и blur для каждого поля ввода
            inputs.forEach(input => {
                input.addEventListener('focus', onFocus);
                input.addEventListener('blur', onBlur);
            });
            StopLoading('#basket_list');
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
});


///Запит по натиску на видалення з кошика
document.getElementById('basket_list').addEventListener('click', function (event) {
   

    var removeButton = event.target.closest('.basket_remove_button');
    if (removeButton) {
        var parentElement = removeButton.closest(
            '.basket_product'
        ); // Предполагается, что родительский элемент имеет класс 'basket_item'
        // Устанавливаем непрозрачность родительского элемента
        parentElement.style.opacity = '0.5';
        var ids = removeButton.getAttribute('data-id');

        // AJAX-запрос для удаления товара из корзины
        StartLoading(parentElement);
        $.ajax({
            url: '/guest_basket_del',
            type: 'POST',
            data: {
                lang:lang,
                _token: $('meta[name="csrf-token"]').attr('content'),
                productId: ids
            },
            success: function (response) {

                document.querySelector("#basket_counter").textContent = response.product_count;
                ///restore deafult state of button
                elementButton = document.querySelector('[data-variable="' + ids +
                    '"].product_add_basket_selected');
                if (elementButton != null) {

                    if (elementButton.children !== null) {
                        elementButton.children.textContent = "Купити";

                        elementButton.classList.remove(
                            'product_add_basket_selected');
                        elementButton.addEventListener("click", sendAjaxBasketAdd)
                    }

                }

                // Второй AJAX-запрос для обновления корзины
                $.ajax({
                    url: '/guest_basket_get',
                    type: 'POST',
                    data: {
                        lang:lang,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {


                        $('#basket_list').html(response);

                        $('#basket_prcie').html("До сплати " + fullprice +
                            " ₴");
                        inputs = document.querySelectorAll(
                            '.tracked-input');

                        // Назначаем обработчики события focus и blur для каждого поля ввода
                        inputs.forEach(input => {
                            input.addEventListener('focus',
                                onFocus);
                            input.addEventListener('blur', onBlur);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    },
                    complete: function () {
                        StopLoading(parentElement);
                        // Восстанавливаем прозрачность родительского элемента после получения ответа
                        parentElement.style.opacity = '1';
                    }
                });
            },
            error: function (xhr, status, error) {
                StopLoading(parentElement);
                console.log('Произошла ошибка:', error);
                // Восстанавливаем прозрачность родительского элемента в случае ошибки
                parentElement.style.opacity = '1';
            }
        });
    }
    //Запит на зміну кількості 
    var basket_change = event.target.closest('.basket_change');
    if (basket_change) {
        var parentElement = basket_change.closest(
            '.basket_product'
        ); // Предполагается, что родительский элемент имеет класс 'basket_item'
        StartLoading(parentElement);

        // Устанавливаем непрозрачность родительского элемента
        parentElement.style.opacity = '0.5';
        


        var ids = basket_change.getAttribute('data-id');

        if (basket_change.classList.contains("basket_plus")) change = "+";

        if (basket_change.classList.contains("basket_minus")) change = "-";


        // AJAX-запрос для удаления товара из корзины
        $.ajax({
            url: '/guest_change',
            type: 'POST',
            data: {
                lang:lang,
                productId: ids,
                productChange: change,
                _token: $('meta[name="csrf-token"]').attr('content'),

            },
            success: function (response) {


                //sets deafault state if item being removed 
                if (document.querySelector('[data-id="' + ids + '"].tracked-input').value == 1 &
                    change == "-") {
                    elementButton = document.querySelector('[data-variable="' + ids +
                        '"].product_add_basket_selected');
                    if (elementButton.children !== null) {
                        elementButton.children.textContent = "Купити";

                        elementButton.classList.remove(
                            'product_add_basket_selected');
                        elementButton.addEventListener("click", sendAjaxBasketAdd)
                    }
                }

                document.querySelector("#basket_counter").textContent = response.product_count;

                // Второй AJAX-запрос для обновления корзины
                $.ajax({
                    url: '/guest_basket_get',
                    type: 'POST',
                    data: {
                        lang:lang,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {


                        $('#basket_list').html(response);
                        let total = 0;


                        $('#basket_prcie').html("До сплати " + fullprice +
                            " ₴");
                        inputs = document.querySelectorAll(
                            '.tracked-input');

                        // Назначаем обработчики события focus и blur для каждого поля ввода
                        inputs.forEach(input => {
                            input.addEventListener('focus',
                                onFocus);
                            input.addEventListener('blur', onBlur);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    },
                    complete: function () {
                        StopLoading(parentElement);
                        // Восстанавливаем прозрачность родительского элемента после получения ответа
                        parentElement.style.opacity = '1';
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log('Произошла ошибка:', error);
                StopLoading(parentElement);
        
                // Восстанавливаем прозрачность родительского элемента в случае ошибки
                parentElement.style.opacity = '1';
            }
        });
    }
});


function set_counter_basket() {
    csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/guest_basket_counter',
        type: 'POST',
        data: {
            lang:lang,
            _token: csrf_token,
        },
        success: function (response) {
            document.querySelector("#basket_counter").textContent = response.product_count;
        },
        error: function (xhr, status, error) {
            console.log('Произошла ошибка:', error);
        },
     
    });
}
set_counter_basket();
function StartLoading(id){

    if($(id).hasClass("unloading")){
        $(id).toggleClass("unloading");
    }
    $(id).toggleClass("loading");

    const overlay = document.createElement('div');

    overlay.id = 'pageOverlay';

    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100vw';

    overlay.style.height = '100vh';

    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.0)'; // Полупрозрачный фон

    overlay.style.zIndex = '9999'; // Убедитесь, что оверлей поверх всего

    overlay.style.pointerEvents = 'all'; // Блокирует все клики
    
    // Добавляем оверлей в документ
    document.body.appendChild(overlay);

}

function StopLoading(id){

    $(id).toggleClass("unloading");
    
    setTimeout(function(){ $(id).toggleClass("loading");

    $(id).toggleClass("unloading");},300);

    // Ищем элемент оверлея по id и удаляем его
    const overlay = document.getElementById('pageOverlay');
    if (overlay) {
        overlay.remove();
    }

}

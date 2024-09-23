{{ App::setLocale($lang)}}
<div class="basket_product">
    <div class="basket_product_content">
        <img src="images/product/{{$id}}_0_small.webp" alt="">
        <div class="basket_text_buttos">
            <span class="basket_text">{{$name}}</span>
            <div class="basket_button_price">
                <span class="basket_product_price">{{$price}}₴</span>
            </div>
        </div>
    </div>
</div>
<div style="display: none;" id="get_product_order_id" data-id="{{$id}}" ></div>

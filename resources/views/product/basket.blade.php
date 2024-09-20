@foreach($page_options as $id => $product )
@if(isset($product->product_img_urls) )

<div class="basket_product">
    <div class="basket_product_content">
        <img src="{{$product->product_img_urls}}" alt="">
        <div class="basket_text_buttos">
            <span
                class="basket_text">{{isset( $product->product_name_ru)? $product->product_name_ru: $product->product_name_ua }}</span>
            <div class="basket_button_price">
                <button data-id="{{$id}}" class="basket_remove_button" type="button"><svg width="18" height="18"
                        viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_725_9426)">
                            <path
                                d="M16.0436 2.34784H11.9349V0.586969C11.9349 0.262828 11.6721 0 11.3479 0H6.65224C6.3281 0 6.06527 0.262793 6.06527 0.586969V2.34784H1.9566C1.63246 2.34784 1.36963 2.61063 1.36963 2.93481V5.28265C1.36963 5.60679 1.63242 5.86962 1.9566 5.86962H2.54357V17.4131C2.54357 17.7372 2.80636 18.0001 3.13054 18.0001H14.8697C15.1938 18.0001 15.4566 17.7373 15.4566 17.4131V5.86958H16.0436C16.3677 5.86958 16.6306 5.60679 16.6306 5.28261V2.93477C16.6305 2.61063 16.3677 2.34784 16.0436 2.34784ZM7.23921 1.1739H10.761V2.3478H7.23921V1.1739ZM14.2827 16.8261H3.71747V5.86958H14.2827V16.8261ZM15.4566 4.69565C14.0842 4.69565 3.89089 4.69565 2.54357 4.69565V3.52174C2.81585 3.52174 15.1845 3.52174 15.4566 3.52174V4.69565Z"
                                fill="#272727"></path>
                            <path
                                d="M9.00005 7.04346C8.67591 7.04346 8.41309 7.30625 8.41309 7.63043V15.0652C8.41309 15.3893 8.67588 15.6522 9.00005 15.6522C9.3242 15.6522 9.58702 15.3894 9.58702 15.0652V7.63039C9.58702 7.30625 9.32423 7.04346 9.00005 7.04346Z"
                                fill="#272727"></path>
                            <path
                                d="M5.47857 7.04346C5.15443 7.04346 4.8916 7.30625 4.8916 7.63043V15.0652C4.8916 15.3893 5.15439 15.6522 5.47857 15.6522C5.80271 15.6522 6.06554 15.3894 6.06554 15.0652V7.63039C6.0655 7.30625 5.80271 7.04346 5.47857 7.04346Z"
                                fill="#272727"></path>
                            <path
                                d="M12.522 7.04346C12.1979 7.04346 11.9351 7.30625 11.9351 7.63043V15.0652C11.9351 15.3893 12.1979 15.6522 12.522 15.6522C12.8462 15.6522 13.109 15.3894 13.109 15.0652V7.63039C13.109 7.30625 12.8462 7.04346 12.522 7.04346Z"
                                fill="#272727"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_725_9426">
                                <rect width="18" height="18" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg><span>{{__("header.remove")}} </span></button>


                @if($product->product_price_discount != 0)
                <span>
                    <span class="basket_product_price"
                        style="text-decoration: line-through;color:rgb(255, 94, 94);">{{$product->product_price }}
                        ₴</span>
                    <span class="basket_product_price">{{$product->product_price_discount }}
                        ₴</span></span>

                @else
                <span class="basket_product_price">{{$product->product_price }}
                    ₴</span>
                @endif

            </div>

        </div>

    </div>
    <div class="basket_product_quantity">


        <button type="button" class="basket_change basket_plus " data-id="{{$id}}">+</button>

        <input class="basket_product_number tracked-input" min="1" max="100" step="1" type="number" data-id="{{$id}}"
            value="{{$product->quantity }}">
            

        <button @if($product->quantity == 1) disabled="true" style="opacity: 0.5;"  @endif  type="button" class="basket_change basket_minus" data-id="{{$id}}">-</button>


    </div>
</div>



@endif
@endforeach
<script>
    //here all right
fullprice = @JSON($fullprice);
document.querySelectorAll('.tracked-input').forEach(function(input) {
    input.addEventListener('input', function() {
        const min = parseInt(this.min);
        const max = parseInt(this.max);
        let value = parseInt(this.value);

        if (value < min) {
            this.value = min;
        } else if (value > max) {
            this.value = max;
        }
    });
});
</script>
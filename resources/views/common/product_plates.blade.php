<div class="products">
  @foreach($page_options["products"] as $value)
                <div class="product_item">
                    <div class="product_item_inside_block">
                        <div class="product_item_butons_discount">
                            @if($value["product_best_seller"] == 1)
                            <div class="product_item_high_sales_label">
                               {{__("header.bestseller")}}
                            </div>
                            @endif
                            @if($value["product_price_discount"]!= 0)
                            <div class="product_item_discount_label">
                            {{__("header.discount")}}
                                <!-- {{$value["discount_uah"]}} ₴ -->
                            </div>
                            @endif
                            <div class="product_item_flag_label">
                                @if( $value["product_show_country"] == 1)
                                @if( isset($value["attributes"]["Страна производства"]) )
                                <img src="images/flags/{{$value["attributes"]["Страна производства"]}}.svg" alt="">
                                @endif
                                @if(isset($value["attributes"]["Країна виробництва"]))
                                <img src="images/flags/{{$value["attributes"]["Країна виробництва"]}}.svg" alt="">
                                @endif
                                @if(isset ($value["product_video_link"]))
                                <div class="product_item_video_label"> </div>@endif
                                @endif
                            </div>
                        </div>
                        <div class="product_item_user_buttons">
                            <style>

                               
                                .msg_pbtn{
                                    opacity: 0;
                                    font-size: 0.8em;
                                    position: absolute;
                                    margin-right: 12em;
                                    width: 7em;
                                    padding: 0.5em;
                                    background-color: white;
                                    outline: solid 1px #f5f5f5;
                                    transition: all 0.2s ease-in-out;
                                }
                                .msg_on{
                                    opacity: 1 !important; 
                                    margin-right: 13em !important; 
                                }


                            </style>

                            @if($page_options["isAuth"])
                                @if(!in_array( $value["product_id"],$favorites))

                                <button title="Додати до бажаного" type="button" data-variable="{{$value["product_id"]}}"
                                    class="product_item_favorite_button add_favorite">
                                    <img class="p_ico" src="/img/svg/favorite.svg" alt="">
                                    <div class="added msg_pbtn" >{{__('product.added_favorive')}}</div>
                                    <div class="remove msg_pbtn" >{{__('product.remove_favorive')}}</div>
                                </button>
                                @else
                                <button title="Додати до бажаного" type="button" data-variable="{{$value["product_id"]}}"
                                    class="product_item_favorite_button remove_favorite" style="opacity: 1;">
                                    <img class="p_ico" src="/img/svg/favorite_sel.svg" alt="">
                                    <div class="added msg_pbtn" >{{__('product.added_favorive')}}</div>
                                    <div class="remove msg_pbtn" >{{__('product.remove_favorive')}}</div>
                                    
                                </button>
                                @endif
                        
                           
                            @endif


                            @if(!in_array( $value["product_id"],$compare))

                            <button type="button" data-variable="{{$value["product_id"]}}" class="product_item_favorite_button add_compare">
                                <img class="p_ico" src="/img/svg/compare.svg" alt="">
                        
                                <div class="added msg_pbtn" >{{__('product.added_compare')}}</div>
                                <div class="remove msg_pbtn" >{{__('product.remove_compare')}}</div>
                            </button>
                            @else
                            <button type="button" data-variable="{{$value["product_id"]}}" class="product_item_favorite_button remove_compare">
                                <img class="p_ico" src="/img/svg/compare_sel.svg" alt="">
                                
                                <div class="added msg_pbtn" >{{__('product.added_compare')}}</div>
                                <div class="remove msg_pbtn" >{{__('product.remove_compare')}}</div>
                            </button>
                            @endif
                        


                        </div>
                        @if($page_options["lang"] == 'ru')
                        <a href="product/{{$value["product_url_".$page_options["lang"]] }}" @else <a
                            href="ua/product/{{$value["product_url_".$page_options["lang"]] }}" @endif
                            title=" {{$value["product_name_". $page_options["lang"]] }}" class="product_item_link">

                            @if(file_exists("images/product/" . $value["product_id"]."_1_small.webp"))

                            <img class="product_img1" src="images/product/{{$value["product_id"]}}_0_small.webp" alt="">

                            <img class="product_img2" src="images/product/{{$value["product_id"]}}_1_small.webp" alt="">
                            @else
                            <img class="product_img" src="images/product/{{$value["product_id"]}}_0_small.webp" alt="">
                            @endif
                            <span class="product_item_name">
                                {{htmlspecialchars_decode($value["product_name_". $page_options["lang"]]) }}
                            </span>

                        </a>
                        @if($value["product_avalible_state"]==1)
                        <div title="Буде відправленно найближчим часом" class="product_delivery_status_ready">
                            <img src="img/icon/novapost.png" alt="">
                            {{__("header.ready_to_delivery")}}
                        </div>
                        @elseif($value["product_avalible_state"]==2)
                        <div class="product_delivery_status_ready">
                            <img src="img/icon/order.png" alt="">
                            {{__('header.on_order')}}
                        </div>
                        @elseif($value["product_avalible_state"]==0)
                        <div class="product_delivery_status_ready">
                        {{__("header.no_product")}}
                        </div>
                        @endif

                        <div class="product_price_rating_container">

                            <div class="product_rating">

                                @for($i=0;$i<$value["product_rating"]["main_peace"];$i++) <svg width="18" height="16"
                                    viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                        fill="#557EE3" />
                                    </svg>
                                    @endfor

                                    @if( $value["product_rating"]["small_piece"] >0.7)

                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                            fill="#D2D2D2" />
                                        <mask id="mask0_1211_9997" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="11" height="16">
                                            <rect width="11" height="16" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#mask0_1211_9997)">
                                            <path
                                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                                fill="#557EE3" />
                                        </g>
                                    </svg>

                                    @elseif( $value["product_rating"]["small_piece"] >0.5)

                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                            fill="#D2D2D2" />
                                        <mask id="mask0_1211_9995" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="9" height="16">
                                            <rect width="9" height="16" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#mask0_1211_9995)">
                                            <path
                                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                                fill="#557EE3" />
                                        </g>
                                    </svg>

                                    @elseif( $value["product_rating"]["small_piece"]>0)

                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                            fill="#D2D2D2" />
                                        <mask id="mask0_1211_10002" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="7" height="16">
                                            <rect width="7" height="16" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#mask0_1211_10002)">
                                            <path
                                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                                fill="#557EE3" />
                                        </g>
                                    </svg>

                                    @endif

                                    @if($value["product_rating"]["empty_peace"] > 1)
                                        @for($i = 0; $i < $value["product_rating"]["empty_peace"]; $i++) <svg width="18"
                                            height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                                fill="#D2D2D2" />
                                            </svg>
                                        @endfor
                                    @endif
                                        <span class="review_container">
                                            <svg style="width: 17px; height:auto;" viewBox="0 0 30 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.25 3.34582V3.3459V23.3048C0.25 23.3049 0.25 23.3049 0.25 23.3049C0.250044 23.4532 0.294044 23.5981 0.376448 23.7214C0.458862 23.8447 0.575985 23.9409 0.713009 23.9976C0.850035 24.0544 1.00081 24.0692 1.14627 24.0403C1.29173 24.0114 1.42534 23.94 1.53022 23.8351C1.53023 23.8351 1.53024 23.8351 1.53025 23.8351L6.43722 18.9281L6.43735 18.928C6.6766 18.6891 7.00089 18.5549 7.339 18.5549H26.459H26.4591C26.8256 18.555 27.1886 18.4829 27.5273 18.3427C27.8659 18.2025 28.1736 17.9969 28.4328 17.7377C28.692 17.4785 28.8976 17.1708 29.0378 16.8322C29.178 16.4935 29.2501 16.1305 29.25 15.764V15.7639V3.3459L29.25 3.34582C29.2501 2.97928 29.178 2.6163 29.0378 2.27764C28.8976 1.93897 28.692 1.63126 28.4328 1.37207C28.1736 1.11289 27.8659 0.907315 27.5273 0.767101C27.1886 0.626887 26.8256 0.554781 26.4591 0.554901H26.459H3.041L3.04092 0.554901C2.67438 0.554781 2.3114 0.626887 1.97274 0.767101C1.63407 0.907315 1.32636 1.11289 1.06717 1.37207C0.807987 1.63126 0.602413 1.93897 0.4622 2.27764C0.321985 2.6163 0.24988 2.97928 0.25 3.34582Z"
                                                    stroke="black" stroke-width="1" />

                                            </svg>
                                            @php
                                            if(isset($value["product_reviews"])){
                                            echo ($value["product_reviews"]);
                                            }
                                            else {
                                            echo(0);
                                            }
                                            @endphp
                                        </span>
                            </div>
                            @if($value["product_price_discount"] != 0)
                            <div class="product_discount_previous_price ">
                                {{$value["product_price"]}} ₴
                            </div>
                            <div class="product_discount_currrent_price">
                                {{$value["product_price_discount"]}} ₴
                            </div>
                            @else
                            <div class="product_price ">
                                {{$value["product_price"]}} ₴
                            </div>
                            @endif

                        </div>
                        @if($value["product_avalible_state"]==1)

                            @if(!isset($cart[$value["product_id"]]))
                            <button data-variable="{{$value["product_id"]}}" type="button"
                                class="product_add_basket product_add">
                                <span>{{__("header.buy")}}</span>
                                <img src="/img/svg/order_cart.svg" alt="">
                            </button>
                            @else
                            <button data-variable="{{$value["product_id"]}}" type="button"
                                class="product_add_basket product_add product_add_basket_selected" style="opacity: 1;">
                                {{__("header.in_basket")}}</button>
                            @endif

                        @elseif ($value["product_avalible_state"]==2)     
                            <button data-variable="{{$value["product_id"]}}" type="button"
                                class="product_order" style="opacity: 1;">
                                {{__("header.order")}}
                            </button>

                        @endif
                        <div class="product_atributes">

                            @foreach($value["attributes"] as $nameAttr=>$valueAttr)


                            {{$nameAttr}}: <strong>{{$valueAttr}}</strong><br>

                            @endforeach
                        </div>

                        <div class="hidden_params">
                            <!-- Порівняти
                                додати до улюбленого
                                3 головні характеристики -->

                        </div>
                    </div>

                </div>
                @endforeach
</div>
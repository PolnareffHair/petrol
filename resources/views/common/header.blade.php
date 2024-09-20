

@php
$lang =$page_options["lang"] ;
echo ("<script>
    lang =  '$lang';
</script>");
$lang = $page_options["lang"] == "ua" ? "/ua" : "";

@endphp


<!DOCTYPE html>
<html lang="{{ $page_options["lang"]}}">

<head>
    <link rel="icon" href="/images/icon/ico.svg?v=1" type="image/svg+xml">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="/js/jquery-3.6.min.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? "title"}}</title>
    <!-- font load -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="/css/swiper-bundle.min.css" />
</head>
<div id="background_header_top">

</div>
<div id="background_header_bottom">
</div>


@php
$token =csrf_token();
echo " <script>
    csrf_token = '$token';
</script>"
@endphp

<body>

    <header>
 

        <nav id="H_info_links">
            <div id="link_container">
                <a href="{{$lang}}/">{{__('header.news')}}</a>
                <div>
                    <button id="show_contacts_button">{{__('header.contacts')}}
                    </button>
                </div>
                <a href="{{$lang}}/">{{__('header.yotube')}}</a>
                <a href="{{$lang}}/">{{__('header.delivery_pay')}}</a>
                <a href="{{$lang}}/">{{__('header.about_us')}}</a>
                <a href="{{$lang}}/">{{__('header.return_swap')}}</a>
            </div>
        </nav>
        <div id="Head_buttons">
            <button id="burger"><img src alt></button>

            <a href="/">
                <div id="logo"></div>
            </a>

            <button id="catalog_button"> <img src="/img/svg/catalog_button.svg" alt="catalog_button">Каталог
            </button>

            <div id="search_field">
                <img id="search_img" src="/img/svg/search_ico.svg" alt="search icon">
                <input id="search_input" type="text" placeholder="{{__('header.i_find')}}">
                <button id="search_button">{{__('header.find')}}</button>
            </div>

            <button id="call"><span>{{__('header.call_me')}}</span></button>
            @if( $page_options["isAuth"])
            <script>
                auth = 1;
            </script>

            <a href="{{$lang}}/dashboards">
                <button id="user_log">
                    <span>{{__('header.profile')}}</span>
                </button>
            </a>

            @else
            <button id="user_log">
                <span>{{__('header.profile_unlogged')}}</span>
            </button>

            <script>
                auth = 0;
            </script>
            @endif
            <button id="user_basket">
                <span>{{__('header.basket')}}</span>
                <div id="basket_counter" style="
                    /* position: absolute; */
                    margin-left: -20px;
                    transform: translate(15px, -10px);
                    background-color: #567cd9;
                    border-radius: 10px;
                    height: 22px;
                    width: 22px;
                        ">{{$basket_counter ?? 0}}
                </div>
            </button>
            <button id="user_compare">
                
                <div id="compare_counter" style="
                    /* position: absolute; */
                    margin-left: -20px;
                    transform: translate(15px, -10px);
                    background-color: #567cd9;
                    border-radius: 10px;
                    height: 22px;
                    width: 22px;
                        ">{{$compare_counter ?? 0}}
                </div>
                
            </button>

            <div id="lang">
              
            @if($lang == "/ua")
                                <a href="{{(url()->current())}}"   class="ua" >UA</a><span>  |   </span><a href="         {{ str_replace("/ua","", (url()->current()))}}" class="ru">RU</a>
                @else
                    <a href="{{'/'.'ua/' . request()->path() }}"   class="ua" >UA</a><span>  |   </span><a href="" class="ru">RU</a>
                @endif
            </div>

        
        </div>
        <div id="fade">
        </div>
        <div id = 'menu_burger'>  
            
            <div id="menu_top"> 
            
          
                <div id="mobile_logo">   </div>
               
                 <svg id = "close_burger"  class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#b4b4b4"></path>
                    </svg>
                </div>
                <div>
                 
                </div>
                <div id="burger_links">
                    <a  id="menu_catalog" class="menu_button"  ><img src="/img/svg/catalog_button.svg" alt="catalog button"> <span>{{__('header.catalog')}}</span>    </a>

                    <a  id="menu_compare" class="menu_button " ><img src="/img/svg/compare_ico.svg" alt="aompares button">    <span> {{__('header.compares')}}</span>  
                        <div id="compare_counter_dup" class="counter_dup"    >0</div>   
                    </a>

                    <a  id="menu_basket" class="menu_button " ><img src="/img/svg/basket.svg"  alt="basket button"> <span> {{__('header.basket')}}</span>  
                    <div id="basket_counter_dup"  
                    class="counter_dup" >0</div>   
                    </a>

                    <a  id="menu_profile"  class="menu_button" ><img src="/img/svg/log.svg" alt="profile button">   <span>  {{__('header.profile')}}</span>  </a>

              
                    
                    
                    <a  href="{{$lang}}/constructor" class="menu_button" ><img src="/img/svg/constructor.svg" alt="catalog_button">  <span> {{__('header.constructor')}}</span></a>

                    <a   id="menu_call" class="menu_button" ><img src="/img/svg/call.svg" alt="back call button">    <span> {{__('header.back_call')}}</span>  </a>

      
                       
              
                    <a class="menu_list"  id="show_contacts_button_dupl"> {{__('header.contacts')}}</a> 
                    <a class="menu_list"  href="{{$lang}}/">{{__('header.news')}}</a> 
                    <a class="menu_list" href="{{$lang}}/">{{__('header.yotube')}}</a>
                    <a class="menu_list" href="{{$lang}}/">{{__('header.delivery_pay')}}</a>
                    <a class="menu_list" href="{{$lang}}/">{{__('header.about_us')}}</a>
                    <a class="menu_list" href="{{$lang}}/">{{__('header.return_swap')}}</a>
                    <div class="lang">

                    @if($lang == "/ua")
                        <a href="{{(url()->current())}}" class= "ua">UA</a><span> |  </span><a href=" {{ str_replace("/ua","", (url()->current()))}}" class="ru">RU</a>
                    @else
                        <a href="{{ '/'.'ua/' . request()->path()   }}" class= "ua">UA</a><span>  |   </span><a href="" class="ru">RU</a>
                    @endif
                </div>
                </div>
    
             
        </div>
        <div id="basket_window">

            <div id="basket_black_top">
                <p>
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.33891 1.67368C0.941089 1.67368 0.600098 1.35753 0.600098 0.971124C0.600098 0.602283 0.941089 0.286133 1.33891 0.286133H3.2712C3.29014 0.286133 3.32803 0.286133 3.34697 0.286133C4.02896 0.303697 4.63516 0.426644 5.14665 0.72523C5.71497 1.05894 6.13174 1.5683 6.35907 2.32354C6.35907 2.34111 6.35907 2.35867 6.37801 2.37623L6.56745 3.07879H23.1434C23.5602 3.07879 23.8822 3.39494 23.8822 3.76378C23.8822 3.83403 23.8633 3.90429 23.8444 3.97455L21.9121 11.1933C21.8363 11.5094 21.5332 11.7202 21.1922 11.7202H9.06806C9.33327 12.6335 9.59849 13.1253 9.95842 13.3537C10.3941 13.6171 11.1519 13.6347 12.4211 13.6171H12.4401H21.0028C21.4195 13.6171 21.7416 13.9333 21.7416 14.3021C21.7416 14.6885 21.4006 14.9871 21.0028 14.9871H12.4401C10.8677 15.0047 9.90159 14.9695 9.12489 14.4953C8.32924 14.0035 7.91247 13.1604 7.49571 11.6324L4.95721 2.72751C4.95721 2.70995 4.95721 2.70995 4.93827 2.69238C4.8246 2.30598 4.63516 2.04252 4.36995 1.90201C4.10473 1.74393 3.7448 1.67368 3.32803 1.67368C3.30909 1.67368 3.29014 1.67368 3.2712 1.67368H1.33891ZM18.7863 15.795C19.7903 15.795 20.6049 16.5503 20.6049 17.4812C20.6049 18.412 19.7903 19.1673 18.7863 19.1673C17.7823 19.1673 16.9677 18.412 16.9677 17.4812C16.9677 16.5503 17.7823 15.795 18.7863 15.795ZM10.8109 15.795C11.8149 15.795 12.6295 16.5503 12.6295 17.4812C12.6295 18.412 11.8149 19.1673 10.8109 19.1673C9.80687 19.1673 8.99228 18.412 8.99228 17.4812C8.99228 16.5503 9.80687 15.795 10.8109 15.795ZM6.98422 4.44877L8.67023 10.3327H20.6239L22.1962 4.44877H6.98422Z"
                            fill="white" />
                    </svg>
                   {{__('header.basket')}}
                </p>
                <button id="close_basket_btton" class="close_button" type="button">
                    <svg id="close_basket_window" class="close_window" width="800px" height="800px" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                            fill="#b4b4b4" />
                    </svg>
                </button>
            </div>
            <div id="basket_list">


            </div>

            <div class="basket_order_buttons">
                <div id="basket_prcie" class="basket_summ_price"></div>
                <div id="basket_button_bottom">
                    <button class="basket_send" id="basket_back"> {{__("header.basket_return")}}</button>
                    <a href="{{$lang}}/order" >
                    <button class="basket_send">{{__("header.make_order")}}</button></a>

                </div>

            </div>
        </div>

        <div id="call_window">
            <form    id="call_window_main">
       
                <div class="call_window_top">
                    <h4 >
                        <svg style="transform: translateY(2px);" width="15" height="15" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.8411 6.52185L17.0486 2.13826L17.805 2.89856L13.5811 7.06941L12.7753 7.86508L13.9062 7.9245L15.0598 7.98512L15.0608 7.98517C15.276 7.99602 15.4467 8.1818 15.4356 8.40428C15.4245 8.62645 15.2367 8.79382 15.0217 8.7831L15.0215 8.78309L11.8115 8.61991L11.8108 8.61987C11.6201 8.61043 11.4629 8.46184 11.4395 8.27291L11.4394 8.27208L11.0111 4.8624C11.0111 4.86236 11.0111 4.86232 11.0111 4.86227C11.0111 4.86224 11.0111 4.86221 11.0111 4.86218C10.9831 4.6379 11.1385 4.44009 11.3546 4.41179C11.5713 4.38475 11.7701 4.53635 11.7988 4.75897C11.7988 4.75913 11.7989 4.75929 11.7989 4.75945L11.9843 6.23784L12.1148 7.27858L12.8411 6.52185Z"
                                fill="white" stroke="white" />
                            <path
                                d="M5.475 8.31096C6.11364 9.46883 6.84971 10.5801 7.8069 11.5934C8.76409 12.6145 9.95633 13.5424 11.5011 14.3319C11.614 14.3894 11.7238 14.3894 11.8197 14.349C11.9681 14.2915 12.115 14.1718 12.265 14.0226C12.3779 13.9092 12.5217 13.7242 12.6702 13.5253C13.2624 12.7404 13.9985 11.7659 15.0361 12.2524C15.0593 12.2633 15.0763 12.2757 15.0995 12.2866L18.5571 14.2868C18.568 14.293 18.5803 14.3039 18.5912 14.3101C19.0473 14.6241 19.236 15.1106 19.2422 15.6623C19.2422 16.2234 19.0365 16.8544 18.735 17.3874C18.336 18.0915 17.7484 18.5562 17.0711 18.8655C16.4263 19.1623 15.7088 19.324 15.0191 19.4265C13.9366 19.5866 12.9222 19.4841 11.8831 19.1623C10.8671 18.8484 9.84654 18.3246 8.73007 17.633L8.64966 17.5802C8.13782 17.26 7.58268 16.915 7.04145 16.5078C5.05285 15.0018 3.03022 12.8243 1.71273 10.4293C0.607085 8.41664 0.00246161 6.24543 0.331835 4.1768C0.514304 3.04224 0.999859 2.01026 1.84262 1.32952C2.57714 0.734264 3.5699 0.407883 4.85337 0.521339C5.00182 0.532218 5.13326 0.619253 5.2013 0.745143L7.42031 4.51562C7.74504 4.93991 7.78525 5.35799 7.60897 5.77762C7.46052 6.1211 7.16362 6.4366 6.75847 6.735C6.6394 6.83758 6.49559 6.94171 6.34714 7.04895C5.85231 7.40952 5.28635 7.8276 5.47964 8.32184L5.475 8.31096Z"
                                fill="#272727  " />
                        </svg>
                        {{__('header.back_call')}}
                    </h4>
                    <button id="close_call_btton" class="close_button" type="button">
                        <svg id="close_call_window" class="close_window" width="800px" height="800px"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                fill="#b4b4b4" />
                        </svg>
                    </button>
                </div>

                <div  id="call_window_response" style="display: none;"> {{__('header.request_succsess')}}  <button onclick="cls_all()"> Вернуться к покупкам</button></div>



                <fieldset class="remover_call">
                    <label for="pnum_input">{{__('header.phone_number')}}
                        <span id="call_light">({{__('header.required')}}) </span>
                    </label>
                    <input id="pnum_input" require type="tel" pattern="[0-9+\(\)\-,]{17}" value="+380">

                </fieldset >
                <fieldset class="remover_call">
                    <label for="call_question"> {{__('header.question')}} </label>
                    <textarea id="call_question" type="text"></textarea>
                </fieldset>
                <button class="remover_call" id="send_call_button" type="button">{{__('header.send')}}</button>

            </form>
          


        </div>
        <div id="order_window">
            <form    id="order_window_main">
                <div class="order_window_top">
                    <h4 >
                        <svg style="transform: translateY(2px);" width="15" height="15" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.8411 6.52185L17.0486 2.13826L17.805 2.89856L13.5811 7.06941L12.7753 7.86508L13.9062 7.9245L15.0598 7.98512L15.0608 7.98517C15.276 7.99602 15.4467 8.1818 15.4356 8.40428C15.4245 8.62645 15.2367 8.79382 15.0217 8.7831L15.0215 8.78309L11.8115 8.61991L11.8108 8.61987C11.6201 8.61043 11.4629 8.46184 11.4395 8.27291L11.4394 8.27208L11.0111 4.8624C11.0111 4.86236 11.0111 4.86232 11.0111 4.86227C11.0111 4.86224 11.0111 4.86221 11.0111 4.86218C10.9831 4.6379 11.1385 4.44009 11.3546 4.41179C11.5713 4.38475 11.7701 4.53635 11.7988 4.75897C11.7988 4.75913 11.7989 4.75929 11.7989 4.75945L11.9843 6.23784L12.1148 7.27858L12.8411 6.52185Z"
                                fill="white" stroke="white" />
                            <path
                                d="M5.475 8.31096C6.11364 9.46883 6.84971 10.5801 7.8069 11.5934C8.76409 12.6145 9.95633 13.5424 11.5011 14.3319C11.614 14.3894 11.7238 14.3894 11.8197 14.349C11.9681 14.2915 12.115 14.1718 12.265 14.0226C12.3779 13.9092 12.5217 13.7242 12.6702 13.5253C13.2624 12.7404 13.9985 11.7659 15.0361 12.2524C15.0593 12.2633 15.0763 12.2757 15.0995 12.2866L18.5571 14.2868C18.568 14.293 18.5803 14.3039 18.5912 14.3101C19.0473 14.6241 19.236 15.1106 19.2422 15.6623C19.2422 16.2234 19.0365 16.8544 18.735 17.3874C18.336 18.0915 17.7484 18.5562 17.0711 18.8655C16.4263 19.1623 15.7088 19.324 15.0191 19.4265C13.9366 19.5866 12.9222 19.4841 11.8831 19.1623C10.8671 18.8484 9.84654 18.3246 8.73007 17.633L8.64966 17.5802C8.13782 17.26 7.58268 16.915 7.04145 16.5078C5.05285 15.0018 3.03022 12.8243 1.71273 10.4293C0.607085 8.41664 0.00246161 6.24543 0.331835 4.1768C0.514304 3.04224 0.999859 2.01026 1.84262 1.32952C2.57714 0.734264 3.5699 0.407883 4.85337 0.521339C5.00182 0.532218 5.13326 0.619253 5.2013 0.745143L7.42031 4.51562C7.74504 4.93991 7.78525 5.35799 7.60897 5.77762C7.46052 6.1211 7.16362 6.4366 6.75847 6.735C6.6394 6.83758 6.49559 6.94171 6.34714 7.04895C5.85231 7.40952 5.28635 7.8276 5.47964 8.32184L5.475 8.31096Z"
                                fill="#272727  " />
                        </svg>
                        {{__('header.back_order')}}
                    </h4>
                    <button id="close_order_btton" class="close_button" type="button">
                        <svg id="close_order_window" class="close_window" width="800px" height="800px"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                fill="#b4b4b4" />
                        </svg>
                    </button>
                </div>
                <div class="basket_product">
                    <div class="basket_product_content">
                        <img src="images/product/189_0_small.webp" alt="">
                        <div class="basket_text_buttos">
                            <span class="basket_text">Насос для перекачки масла 40 л/мин 800 Ват</span>
                            <div class="basket_button_price">
                                    <span class="basket_product_price" style="text-decoration: line-through;color:rgb(255, 94, 94);">6500
                                        ₴</span>
                                    <span class="basket_product_price">5500
                                        ₴</span></span>                                
                            </div>
                        </div>
                    </div>  
                </div>
                <div id="order_product"></div>


                <div  id="order_window_response" style="display: none;"> {{__('header.order_succsess')}}  <button onclick="cls_all()"> Вернуться к покупкам</button></div>



                <fieldset class="remover_order">
                    <label for="pnum_input_order">{{__('header.phone_number')}}
                        <span id="order_light">({{__('header.required')}}) </span>
                    </label>
                    <input id="pnum_input_order" require type="tel" pattern="[0-9+\(\)\-,]{17}" value="+380">

                </fieldset >

                <button class="remover_order" id="send_order_button" type="button">{{__('header.order')}}</button>

            </form>
          


        </div>

        <div id="login_window">
            <form method="POST" action="/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div id="login_black_top">
                    <p>
                       {{__("header.login")}}
                    </p>
                    <button id="close_login_btton" class="close_button" type="button">
                        <svg id="close_call_window" class="close_window" width="800px" height="800px"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                fill="#b4b4b4" />
                        </svg>

                </div>
                <fieldset>
                    <label for="pnum_input_login">{{__("header.phone_number")}}
                    </label>
                    <input id="pnum_input_login" autocomplete="username" require type="tel" pattern="[0-9+\(\)\-,]{17}"
                        value="+380" name="phone_number" required>
                </fieldset>
                <fieldset>
                    <label for="password_input">{{__("header.password")}}

                    </label>
                    <input autocomplete="current-password" id="password_input" type="password" name="password" required>

                </fieldset>
                <div id="login_links">

                    <div><a href="#">{{__("header.forget_password")}}</a></div>

                    <div> <a href="#">{{__("header.register")}}</a> </div>
                </div>
                <!-- type="button" -->
                <button id="login_in_button">{{__("header.login")}}</button>
            </form>
        </div>
        <div id="catalog_window">
            <div id="catalog_window_flex">
                <div id="main_categories_main_contaner">
                    <div id="main_categories_header">
                        <h3>{{__("header.catalog")}}</h3>
                        <button id="close_catalog_btton" class="close_button" type="button">
                            <svg id="close_basket_window" class="close_window" width="800px" height="800px"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                    fill="#b4b4b4" />
                            </svg>
                        </button>
                    </div>

                    <div id="main_categories_list">

                        <div class="main_categories_item" id="category_1">
                            <img src="/img/item_cat.png" alt="">
                            <h4>
                                Міні азс
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_2">
                            <img src="/img/akb.png" alt="">
                            <h4>
                                Акумулятори 12 в AGM
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_3">
                            <img src="/img/pump.png" alt="">
                            <h4>
                                Насоси
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_4">
                            <img src="/img/counter.png" alt="">
                            <h4>
                                Лічильники
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_5">
                            <img src="/img/item_cat.png" alt="">
                            <h4>
                                Міні ТРК
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_6">
                            <img src="/img/item_cat.png" alt="">
                            <h4>
                                Фільтри для пального
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_7">
                            <img src="/img/pistol.png" alt="">
                            <h4>
                                Заправні пістолети
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_8">
                            <img src="/img/can.png" alt="">
                            <h4>
                                Єврокуб і резервуари
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>
                        <div class="main_categories_item" id="category_9">
                            <img src="/img/connector.png" alt="">
                            <h4>
                                З'єднання і аксесуари
                            </h4>
                            <div class="arrow_cat">
                            </div>
                        </div>

                    </div>
                </div>
                <div id="sub_categores_list">
                    <button id="close_catalog_btton_subcategory" class="close_button" type="button">
                        <svg class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                fill="#808080" />
                        </svg>
                    </button>
                    <ul id="sub_category_1">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>МініАзс</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Насоси для дизельного палива</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                    </ul>
                    <ul id="sub_category_2">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Акумулятори 12в в AGM</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Акумулятори 12в</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Акумулятори 12в
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Акумулятори 12в
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Акумулятори 12в
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Акумулятори 12в
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_3">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Насоси</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Насоси для дизельного палива</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_4">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Лічильники</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Лічильники 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_5">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Лічильники</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Лічильники 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Лічильники 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_6">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Лічильники</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_7">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Насоси для дизельного палива</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_8">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Насоси для дизельного палива</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <ul id="sub_category_9">
                        <li>
                            <a href="#" class="sub_category_link">
                                <h3>Лічильники</h3>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sub_category_link">
                                <h4>Насоси для дизельного палива</h4>
                            </a>
                        </li>
                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h4>
                                    Насоси для дизельного палива 220В
                                </h4>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24В
                                </h5>
                            </a>
                        </li>

                        <li> <a href="#" class="sub_category_link">
                                <h5>
                                    Насоси для дизельного палива 12/24/220В
                                </h5>
                            </a>
                        </li>
                    </ul>
                    <button id="sub_category_back" type="button"> &lt; &lt; &#32; До головних категорій </button>
                </div>
            </div>
        </div>

        <div id="contacts_window">
            <div id="contacts_window-container">

                <div id="contacts_black_top">
                    <p>
                        Контакти
                    </p>
                    <button id="close_contact_btton" class="close_button" type="button">
                        <svg id="close_contact_window" class="close_window" width="800px" height="800px"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                fill="#b4b4b4" />
                        </svg>
                </div>

                <div class="contact_link">
                    <a href="tel:+380 800-357-299" type="tel"><img src="/img/svg/Teleph.svg" class="ico" alt="">+380 800-357-299</a>

                </div>
                <div class="contact_link">
                    <a href="tel:+380 093-515-77-15" type="tel"><img src="/img/svg/Teleph.svg" class="ico" alt="">+380 093-515-77-15</a>

                </div>
                <div class="contact_link">
                    <a href="tel:+380 066-029-16-96" type="tel"><img src="/img/svg/Teleph.svg" class="ico" alt="">+380 066-029-16-96</a>

                </div>
                <div class="contact_link">
                    <a href="mailto: info@ogm.com.ua" type="mail"><img src="/img/svg/email.svg"
                            style="margin-right: 0.4em;height: 1.4em; width: auto;transform: translateY(0.5em);" alt="">
                        info@ogm.com.ua</a>
                </div>
                <div class="contact_link">
                    <a href="https://maps.app.goo.gl/ohaLYqLGoQGRNu7h8" target="_blank"><img src="/img/svg/map.svg"
                            class="ico" alt=""> вул. Павлівська, 29Б, Київ, 01135</a>
                </div>
                <div id="map_plate">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.460824531619!2d30.4859516!3d50.451142899999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce89b3c1f5d1%3A0x40708230b2e04324!2z0LLRg9C70LjRhtGPINCf0LDQstC70ZbQstGB0YzQutCwLCAyOdCRLCDQmtC40ZfQsiwgMDExMzU!5e0!3m2!1suk!2sua!4v1717003504016!5m2!1suk!2sua"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
             
            </div>
        </div>
        <div id="compare_window">
           
            <div class="black_top">
                <p>
                {{__("header.compares")}}
                </p>
                <button id="compare_close" class="close_button" type="button">
                    <svg id="close_window" class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#b4b4b4"></path>
                    </svg>
                </button>
            </div>
            <div id="compare_basis">

             
            
         
            </div>           
        </div>
        <div id="order_window">
            
        </div>
    </header>
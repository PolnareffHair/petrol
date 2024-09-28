@include("common.header")


    <style>
    .swiper {
        width: var(--width-main);
        height: calc(var(--width-main) / 4.7 + 30px);

        margin-left: var(--sidde-padding_baner);
    }

    @media screen and (max-width:700px) {
        .swiper {
            height: calc(var(--width-main) / 4.7 + 25px);

        }
    }

    .swiper-slide {

        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .swiper-wrapper {
        height: auto;
    }

    .swiper-horizontal>.swiper-pagination-bullets,
    .swiper-pagination-bullets.swiper-pagination-horizontal,
    .swiper-pagination-custom,
    .swiper-pagination-fraction {
        top: auto;

    }
    </style>
    <main>
        <section>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"> <img src="/img/banner/Banner1.webp" alt=""></div>
                    <div class="swiper-slide"><img src="/img/banner/Banner2.webp" alt=""></div>
                    <div class="swiper-slide"><img src="/img/banner/Banner3.webp" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <a href="#">
                <div id="gas_constructor_button">
                    <div id="gas_constructor_button_textsvg">




                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<mask id="mask0_1378_10149" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="72" height="72">
<rect width="72" height="72" rx="16" fill="#D9D9D9"/>
</mask>
<g mask="url(#mask0_1378_10149)">
<rect width="72" height="72" rx="16" fill="#272727"/>
<path d="M71.7706 49.7647C69.9471 46.4824 67.9412 43.2 67.9412 37H64.2941C64.2941 44.2941 66.4824 48.1235 68.6706 51.5882C70.3118 54.3235 71.5882 56.8765 71.5882 60.7059C71.5882 62.7118 69.9471 64.3529 67.9412 64.3529C65.9353 64.3529 64.2941 62.7118 64.2941 60.7059V51.5882C64.2941 49.5824 62.6529 47.9412 60.6471 47.9412H57V52H60.6471V60.7059C60.6471 64.7176 63.9294 68 67.9412 68C71.9529 68 75.2353 64.7176 75.2353 60.7059C75.2353 55.9647 73.4118 52.8647 71.7706 49.7647Z" fill="#FFFFFD"/>
<path d="M56.5529 20L54 22.5529L62.5706 31.1235V39.5118C62.5706 40.6059 63.3 41.3353 64.3941 41.3353H68.0412C69.1353 41.3353 69.8647 40.6059 69.8647 39.5118V34.7706C69.8647 33.8588 69.5 32.9471 68.7706 32.2176L56.5529 20Z" fill="#3F63BD"/>
<path d="M52 61.1274H19.0012C16.516 61.1274 14.5012 59.1127 14.5012 56.6274V18.1187L14.5012 18.003C14.5012 15.5156 16.5182 13.5028 19.0063 13.5056L52.005 13.5426C54.4883 13.5453 56.5 15.5593 56.5 18.0426V56.6275C56.5 59.1127 54.4853 61.1274 52 61.1274Z" fill="#FFFFFD" stroke="#FFFFFD"/>
<path d="M21.5879 47.5L14 47.5L14 51.1471L21.5879 51.1471L30 51.1471L30 47.5L21.5879 47.5Z" fill="#3F63BD"/>
<path d="M41.8887 17H20.3464C19.5386 17 19 17.5386 19 18.3464V31.8103C19 32.6182 19.5386 33.1567 20.3464 33.1567H41.8887C42.6965 33.1567 43.2351 32.6182 43.2351 31.8103V18.3464C43.2351 17.5386 42.6965 17 41.8887 17Z" fill="#3F63BD"/>
<path d="M21.6935 24.8091L19.8086 22.9241C20.2125 22.5202 20.4818 22.2509 20.8857 21.9816L22.636 24.1359C22.2321 24.2705 21.9628 24.5398 21.6935 24.8091ZM40.543 24.8091C40.2738 24.5398 40.0045 24.2705 39.6006 24.0012L41.2162 21.847C41.6202 22.1163 42.0241 22.5202 42.2933 22.7895L40.543 24.8091ZM25.7327 22.1163L24.6556 19.6928C25.0595 19.5581 25.5981 19.2888 26.002 19.1542L26.8098 21.7124C26.4059 21.847 26.1366 21.9816 25.7327 22.1163ZM36.3692 22.1163L35.1575 21.7124L35.9653 19.1542C36.3692 19.2888 36.9078 19.4235 37.3117 19.6928L36.3692 22.1163ZM30.4451 21.0392L30.3105 18.3464H31.7915L31.6568 21.0392H30.4451ZM33.8111 33.1567H28.4255C28.4255 31.6757 29.6373 30.4639 31.1183 30.4639C32.5993 30.4639 33.8111 31.6757 33.8111 33.1567Z" fill="white"/>
<path d="M32.4639 33.1567L38.7919 25.4823L29.3672 33.1567H32.4639Z" fill="white"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M57 48L53.9395 47.9704H52.67L51.406 45.8271C51.3239 45.6824 51.1707 45.5989 51.0065 45.5989H49.1406V44.1737C49.1406 43.9121 48.9327 43.7006 48.6755 43.7006H45.4088V41.8022H46.8096C47.0668 41.8022 47.2747 41.5907 47.2747 41.329V38.4732C47.2747 38.2115 47.0668 38 46.8096 38H38.3993C38.1422 38 37.9342 38.2115 37.9342 38.4732V41.3235C37.9342 41.5851 38.1422 41.7967 38.3993 41.7967H39.8001V43.695H36.0628C35.937 43.695 35.8221 43.7451 35.7345 43.8342C35.647 43.9232 35.5977 44.0457 35.5977 44.1682V45.5933H32.331C32.0738 45.5933 31.8659 45.8049 31.8659 46.0665V48.9168H30.9302V47.4972C30.9302 47.2356 30.7223 47.024 30.4651 47.024C30.2079 47.024 30 47.2356 30 47.4972V51.2994C30 51.5611 30.2079 51.7726 30.4651 51.7726C30.7223 51.7726 30.9302 51.5611 30.9302 51.2994V49.8743H31.8659L31.8659 53.6765C31.8659 53.9382 32.0738 54.1497 32.331 54.1497H35.8166L37.5457 56.7885C37.6333 56.9221 37.781 57 37.9342 57H51.0065C51.1816 57 51.3458 56.8998 51.4224 56.7383L52.6919 54.1497H53.9832L54 54.1839V52H57L57 48Z" fill="#3F63BD"/>
</g>
</svg>



                        <h4>
                            Конструктор міні азс - швидкий
                            та зручний підбір комеплектуючих
                        </h4>
                    </div>
                    <img src="img/constructor_button.png" alt="">
                </div>
            </a>
            <a href="#">
                <div style="margin-top: 20px;" id="gas_constructor_button">
                    <div id="gas_constructor_button_textsvg">



                        <svg id="gas_constructor_button_svg" viewBox="0 -38 256 256" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            preserveAspectRatio="xMidYMid">
                            <g>
                                <path
                                    d="M250.346231,28.0746923 C247.358133,17.0320558 238.732098,8.40602109 227.689461,5.41792308 C207.823743,0 127.868333,0 127.868333,0 C127.868333,0 47.9129229,0.164179487 28.0472049,5.58210256 C17.0045684,8.57020058 8.37853373,17.1962353 5.39043571,28.2388718 C-0.618533519,63.5374615 -2.94988224,117.322662 5.5546152,151.209308 C8.54271322,162.251944 17.1687479,170.877979 28.2113844,173.866077 C48.0771024,179.284 128.032513,179.284 128.032513,179.284 C128.032513,179.284 207.987923,179.284 227.853641,173.866077 C238.896277,170.877979 247.522312,162.251944 250.51041,151.209308 C256.847738,115.861464 258.801474,62.1091 250.346231,28.0746923 Z"
                                    fill="#FF0000">

                                </path>
                                <polygon fill="#FFFFFF" points="102.420513 128.06 168.749025 89.642 102.420513 51.224">

                                </polygon>
                            </g>
                        </svg>
                        <h4>
                            Наш відео-блог на Youtube
                        </h4>
                    </div>
                    <img src="img/youtube_button.png" alt="">
                </div>
            </a>
        </section>
        <section>
            <h2>
                Категорії
            </h2>

            <div id="cat_container">
                @forEach($categories as $category)
                <div class="cat_item" >
       
                        @if(isset($category["child"] ))
                        <div class="child_container">
                        @forEach($category["child"] as $child)
        

                        <a class="child" href="{{$lang_empty_when_ru}}/category/{{$child["url"] }}"> {{$child["name"] }} </a>
            
           
                        @endforeach
                        </div>
                        @endif
                        <a class="main_c" href="{{$lang_empty_when_ru}}/category/{{$category["url"]}}">

                    <img    @if(isset($category["child"] )) class="hide"   @endif src="/img/categories/{{ str_replace(' ', '',$category["category_id"])}}.webp" alt="">
                    <span> {{$category["name"]}}</span></a>

                </div>
                @endforeach
            </div>
        </section>

        <section>
            <h2 style="color:#4e72ce; text-decoration: underline;">Найкращі пропозиції</h2>
       
             @include("common.product_plates")


        </section>


    

        <section id="about">
            {!!$main_page_text !!}
        </section>

        <section>
            <!-- rewievs -->
        </section>

        <div>
            <section>
                <!-- characteristics -->
            </section>

        </div>
    </main>
    <aside>
        <!-- similar products -->
    </aside>
    <div id="buttons">

    </div>

    @include("common.footer")
</body>


<!-- Swiper JS -->
<script src="swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
var swiper = new Swiper(".mySwiper", {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
    },
});
</script>

</html>
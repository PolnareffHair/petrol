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

                        <svg id="gas_constructor_button_svg" width="80" height="80" viewBox="0 0 80 80" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.46045 27.9622H27.9622V7.46045H7.46045V27.9622ZM11.1908 11.1908H24.2318V24.2318H11.1908V11.1908Z"
                                fill="#3A58A4" />
                            <path d="M0 35.423H35.423V0H0V35.423ZM3.73038 3.73038H31.6926V31.6926H3.73038V3.73038Z"
                                fill="#3A58A4" />
                            <path
                                d="M44.5771 0V35.423H80.0001V0H44.5771ZM76.2698 31.6926H48.3075V3.73038H76.2698V31.6926Z"
                                fill="#3A58A4" />
                            <path
                                d="M72.5394 7.46045H52.0376V27.9622H72.5394V7.46045ZM68.809 24.2322H55.768V11.1911H68.809V24.2322Z"
                                fill="#3A58A4" />
                            <path
                                d="M7.46045 72.5395H27.9622V52.0359H7.46045V72.5395ZM11.1908 55.766H24.2318V68.8088H11.1908V55.766Z"
                                fill="#3A58A4" />
                            <path d="M0 80H35.423V44.5751H0V80ZM3.73038 48.3055H31.6926V76.2696H3.73038V48.3055Z"
                                fill="#3A58A4" />
                            <path
                                d="M52.0376 72.5395H72.5394V52.0359H52.0376V72.5395ZM55.7677 55.766H68.8087V68.8088H55.7677V55.766Z"
                                fill="#3A58A4" />
                            <path
                                d="M44.5771 80H80.0001V44.5751H44.5771V80ZM48.3075 48.3055H76.2698V76.2696H48.3075V48.3055Z"
                                fill="#3A58A4" />
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
                        <a class="main_c" href="{{$lang_empty_when_ru}}/category/{{$category["url"]}}">

                        <img  src="/img/categories/{{ str_replace(' ', '',$category["category_id"])}}.webp" alt="">
                        <span> {{$category["name"]}}</span></a>
                        @if(isset($category["child"] ))
                        <div class="child_container">
                        @forEach($category["child"] as $child)
        

                        <a class="child" href="{{$lang_empty_when_ru}}/category/{{$child["url"] }}"> {{$child["name"] }} </a>
            
           
                        @endforeach
                        </div>
                        @endif

                </div>
                @endforeach
            </div>
        </section>

        <section>
            <h2 style="color:#4e72ce; text-decoration: underline;">Найкращі пропозиції</h2>
            <div id="products">
             @include("common.product_plates")
            </div>

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
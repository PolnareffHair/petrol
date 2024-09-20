<!DOCTYPE html>
<html lang="ua">


@include("common.header")

<body>

    <section class="p_card">
        <div class="bread_crumps">

            <span><a href="    {{url('/');}}">
                    <img src="/img/svg/home_icon.svg" alt=""></a>/Лічильники/Електронні
                лічильники/Електронний лічильник MGE 400
                для дизельного палива, масла, 15-400 л
                /
                хв</span>
            <span>Код:  213709267</span>
        </div>
        <div class="p_slider">

            <style>
                .swiper-container {
                    overflow: hidden;
                    width: 500px;
                    height: 640px;
                    margin-bottom: 10px;
                    position: relative;
                }

                .swiper-slide {
                    width: 500px;
                    height: 500px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 24px;
                    color: white;
                    font-weight: bold;
                }

                .swiper-slide img {
                    width: 100%;
                    height: 100%;

                }

                .thumbs-swiper {
                    height: 100px;
                    box-sizing: border-box;
                    padding: 10px 0;
                }

                .thumbs-swiper .swiper-slide {
                    width: 80px !important;
                    height: 80px !important;
                    opacity: 0.4;
                    cursor: pointer;
                }


                .thumbs-swiper .swiper-slide-thumb-active {
                    opacity: 1;
                }

                .swiper-button-next,
                .swiper-button-prev {
                    color: #5c5c5c;
                }

                .swiper-wrapper-top {
                    height: auto;
                }

                .swiper-wrapper-down {
                    display: flex;
                    justify-content: center;

                    img {
                        height: 100%;
                        width: 100%;
                    }
                }
            </style>


            <!-- Main Swiper -->
            <div class="swiper-container main-swiper swiper-wrapper-top">
                <div class="swiper-wrapper swiper-wrapper-top">

                    @foreach(json_decode($product["product_img_urls"]) as $img)

                    <div class="swiper-slide"><img src="\images\product\{{$product["product_id"]}}_{{$img}}_big.webp"
                            alt="">
                    </div>

                    @endforeach
                </div>

                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Thumbnails Swiper -->
            <div class="swiper-container thumbs-swiper">
                <div class="swiper-wrapper swiper-wrapper-down">

                    @foreach(json_decode($product["product_img_urls"]) as $img)

                    <div class="swiper-slide"><img src="\images\product\{{$product["product_id"]}}_{{$img}}_big.webp"
                            alt="">
                    </div>

                    @endforeach
                </div>
            </div>

            <script src="/swiper-bundle.min.js"></script>
            <script>
                var thumbsSwiper = new Swiper('.thumbs-swiper', {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });

                var mainSwiper = new Swiper('.main-swiper', {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    thumbs: {
                        swiper: thumbsSwiper
                    }
                });
            </script>




        </div>
        <div class="p_basic">
            <div class="p_buyer">
                <div class="p_header">
                    {{htmlspecialchars_decode($product["product_name_".app()->getLocale()])}}
                </div>
                <div class="p_ratting_reviews">
                    <div class="p_rating">

                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                fill="#557EE3"></path>
                        </svg>
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                fill="#557EE3"></path>
                        </svg>
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                fill="#557EE3"></path>
                        </svg>
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                fill="#557EE3"></path>
                        </svg>


                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                fill="#D2D2D2"></path>
                            <mask id="mask0_1211_10002" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="7" height="16">
                                <rect width="7" height="16" fill="#D9D9D9"></rect>
                            </mask>
                            <g mask="url(#mask0_1211_10002)">
                                <path
                                    d="M8.62426 1.02921C8.75219 0.678777 9.24781 0.678777 9.37574 1.02921L11.204 6.03718C11.2617 6.195 11.4118 6.3 11.5798 6.3H16.7257C17.1173 6.3 17.2756 6.80446 16.9543 7.02824L12.6528 10.024C12.5038 10.1277 12.4434 10.3188 12.5056 10.4894L14.2723 15.3284C14.4057 15.6939 13.9917 16.0154 13.6707 15.7957L9.22587 12.7545C9.0897 12.6614 8.9103 12.6614 8.77413 12.7545L4.32934 15.7957C4.00826 16.0154 3.5943 15.6939 3.72772 15.3284L5.49436 10.4894C5.55662 10.3188 5.49621 10.1277 5.34721 10.024L1.04568 7.02824C0.724351 6.80446 0.882702 6.3 1.27428 6.3H6.42021C6.58822 6.3 6.73833 6.195 6.79595 6.03718L8.62426 1.02921Z"
                                    fill="#557EE3"></path>
                            </g>
                        </svg>




                    </div> <span>4 відгуків</span>
                </div>
                <button data-variable="" type="button" class="#products .product_item .product_add_basket">
                    <span>Додати в кошик </span> <img src="/img/svg/order_cart.svg" alt=""></button>
            </div>

        </div>

    </section>


    @include("common.footer")
</body>

</html>
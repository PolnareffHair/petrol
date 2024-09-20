@foreach ($img as $value)
                <div class="sortable-item" data-id="{{$value}}"><img class="img_editro_product"
                        src="/images/product/{{$id}}_{{$value}}_small.webp" alt="">

                    <div class="buttons">
                        <button title="Видалити зображення" class="delete_img" data-id="{{$value}}"><img class="del" src="/admin_svg/del.svg"
                                alt=""></button>
                        <button title="Завантажити зображення" class="download_img" data-id="{{$value}}"><img class="download_img"
                                src="/admin_svg/download.svg" alt="" data-id="{{$value}}"></button>
                    </div>
                </div>
@endforeach


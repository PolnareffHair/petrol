@if(!empty($video))
@foreach ($video as $value)
                <div class="sortable-item" data-id="{{$value}}">
                        <iframe width="230" height="230" src="https://{{$value}}" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    <div class="buttons">
                        <button title="Видалити відео" class="delete_img" data-link="{{$value}}"><img class="del" src="/admin_svg/del.svg"
                                alt=""></button>
                    </div>
                    <span>{{$value}}</span>

                </div>
@endforeach
@endif


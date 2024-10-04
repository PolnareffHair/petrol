@if(!empty($related_ids))

@foreach ($related_ids as $value)
<div class="sortable-item" data-id="{{$value}}"><img class="img_editro_product"
        src="/images/product/{{$value}}_{{$imgs[$value]}}_big.webp/" alt="">    <span style="width: 10em; height:4.9em;overflow-y:scroll;overflow-x:hidden;">{{$names[$value]}}</span>
    <div class="buttons">
        <button title="Видалити зображення" class="delete_related" data-id="{{$value}}"><img class="del" src="/admin_svg/del.svg" alt=""></button>

        <a href="/admin/product/{{$value}}">
            <button title="Видалити зображення"><img style="background-color: var(--button-color-neutral);" src="/admin_svg/eye.svg" alt=""></button>
        </a>
    </div>
</div>
@endforeach
@endif
<div id="some_searcher">


</div>
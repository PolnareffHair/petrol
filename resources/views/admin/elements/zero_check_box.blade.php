<div class="product_option" x-data="{ 
                    CHC{{$name}}:  {{($discount == 0 ? "false" : "true")}},
                    discountPrice: {{$discount}},
                    originalPrice: {{$discount}} }">
    <label>{{$title}}
        <input x-model="CHC{{$name}}" type="checkbox"  class='input_change' name="discount_avalible"{{ $limitStr}} id="CHC{{$name}}"

            {!!'@change="if (!CHC'.$name.') { discountPrice = 0 } else { discountPrice = originalPrice }">'!!}
    </label>
    <label>{{$input_title}}
        <input
            class='input_change' 
            type="number"
            :disabled="!CHC{{$name}}"
            name="discount_price"
            id="ID{{$name}}"
            x-model.number="discountPrice"

            {!! '@input="if (!CHC' .$name.') { discountPrice=0 }">' !!}
    </label>
</div>







<div class='product_option'>
    <label for='form_{{$name}}'>{{$title}}</label>
    <input class='input_change' type='checkbox' id='ID{{$name}}'
        @if ($val== 1)
        checked
        @endif
    name='form_{{$name}}'> 
    </input>
</div>
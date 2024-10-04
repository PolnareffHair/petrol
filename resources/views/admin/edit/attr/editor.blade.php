@php
    ///  $id_n  - getting from outside 
    /// $path_link - getting from outside 

$id_name = $id_n. "item".$id_item;
$id_btn = $id_name  . "load";

$create_link = $path_link .'/create';
$read_link   = $path_link .'/read'  ;
$update_link = $path_link .'/update';
$delete_link = $path_link .'/delete';
@endphp
<div class="tag_selector" id="{{$id_name}}"></div>
<button class="up" id="{{$id_btn}}"style="display:none;" >⟳</button>
<script>
$(document).ready(function() {
    //update
    $(document).on('change', '.{{$id_name}}sel', function() {        
        if (!((selectedValue = $(this).val())== "empty"))
            ajax_item_action('{{$update_link}}', {attr_val: selectedValue, attr: $(this).data("id"), id: '{{$id_item}}',},function(){$('#{{$id_btn}}').click();});
    });
    //create
    $(document).on('change', '.{{$id_name}}avsel', function() {
        // Получаем выбранное значение
        if (!((selectedValue = $(this).val())== "empty"))
            ajax_item_action( '{{$create_link}}', { attr_val: selectedValue,id: $(this).data("id"),pid: '{{$id_item}}'}, function(){$('#{{$id_btn}}').click();} );
    });

    $(document).on('click', ".delete_{{$id_name}}", function() {
        if (( $(this).data("id")))
            ajax_item_action('{{$delete_link}}', {attr: $(this).data("id"),id: '{{$id_item}}'},function(){$('#{{$id_btn}}').click();});
    });
    //read
    $('#{{$id_btn}}').on("click", function(){ ajax_item_get(  "{{$read_link}}",  { pid: '{{$id_item}}', name: '{{$id_name}}'},"{{$id_name}}" );});  
});
</script>

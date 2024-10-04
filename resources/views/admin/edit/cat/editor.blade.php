@php
    ///  $id_n  - getting from outside 
    /// $path_link - getting from outside 

    $id_name = $id_n. "item".$id_item;
    $id_btn = $id_name  . "load";

    $create_link = $path_link .'/create';
    $read_link = $path_link .'/read';
    $delete_link = $path_link .'/delete';

@endphp


<div class="tag_selector" id="item_{{$id_name}}">
    
</div>
<button class="up" id="{{$id_btn}}"style="display:none;" >⟳</button>
<script>

            $(document).on('change', '.{{$id_name}}avsel', function() {        
                    if (!((selectedValue = $(this).val())== "empty"))
                        ajax_item_action('{{$create_link}}', {id: selectedValue, pid: '{{$id_item}}',},function(){$('#{{$id_btn}}').click();});
                });

            $(document).on('click', ".delete_{{$id_name}}", function() {
                if (( $(this).data("id")))
                    ajax_item_action('{{$delete_link}}', {id: $(this).data("id"),pid: '{{$id_item}}'},function(){$('#{{$id_btn}}').click();});
            });           

            $('#{{$id_btn}}').on("click", function(){  ajax_item_get("{{$read_link }}",{ pid:'{{$id_item}}',name: '{{$id_name}}',},    "item_{{$id_name}}");});  

</script>


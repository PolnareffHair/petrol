@php
 ///  $id_n  - getting from outside 
/// $path_link - getting from outside 
    


$id_n = $id_n. "item".$id_item; //

$add_id = "add_img_$id_n"; //add img button

$sorter_name = "$id_n-list-img";


$id_btn = $id_n. "item".$id_item. "load"; // button for gettin editor



$link_searcher = $path_link.'/search';
$read_link = $path_link.'/read';
$delete_link = $path_link.'/delete';
$update_link = $path_link.'/update';
$create_link = $path_link.'/create';

$end_prefix = "_small.webp";

$csrf = csrf_token();

@endphp
<style>
    #combine_rel_editor {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
</style>
<div class="sort_editor">
    <p>До 5-ти позицій</p>
    <div id="combine_rel_editor">

        <div class="img_sorter wider_sorter" id="{{$sorter_name}}">
        </div>
        <div id="add_related_input_div">
            <input placeholder="Пошук товарів" type="text" id="add_related_input" style="height: 3em; width :350px;">
            <div id="searcher{{$sorter_name}}" style="padding-top: 0;" class="product_searcher">
            </div>
        </div>

    </div>
</div>
<button class="up" id="{{$id_btn}}" style="display:none;">⟳</button>
<script>
    $('#{{$id_btn}}').on("click",  function() {
        ajax_item_get(
            "{{$read_link}}",
            {
                product_id: "{{$id_item}}"
            },    
            "{{$sorter_name}}"
        );}
    )
    //get img list for editor

    
    
    //serach
    $("#add_related_input").on("click", function() {
        setTimeout(function () {
             ajax_item_get('{{$link_searcher}}',
             {
                _token: "{{$csrf}}",
                search: $("#add_related_input").val(),
                except:  Array.from( document.querySelectorAll('#{{$sorter_name}} .sortable-item') ).map(item => item.getAttribute('data-id'))
            },
            "searcher{{$sorter_name}}"
            ,false,false
             );
        }, 100)
    });

    let changebale_val_storage_related_input = 10;
    setInterval(
        function() {
            if ( changebale_val_storage_related_input != $("#add_related_input").val() ) {
                $("#add_related_input").click();
                changebale_val_storage_related_input = $("#add_related_input").val();
            }
    }, 250);
    $('#searcher{{$sorter_name}}').on('click', function(event) {
                addButton = event.target.closest('.add');
                id = addButton.getAttribute('data-id');
                ajax_item_action('{{$create_link }}',
                    {
                        related_id: id,
                        product_id: "{{$id_item}}",
                    },
                     function(){ $('#{{$id_btn}}').click();}
                );
    });

    ///delete
    document.getElementById('{{$sorter_name}}').addEventListener('click', function(event) {
        DeletedButton = event.target.closest('.delete_related');
        if (DeletedButton) {
            id = DeletedButton.getAttribute('data-id');
            ajax_item_action('{{$delete_link}}',{
                    related: id,
                    id: "{{$id_item}}",
                    _token: "{{$csrf}}"
                },
                 function(){ $('#{{$id_btn}}').click();}
             );
        }
    });
  
    // Инициализация SortableJS + ajax для запроса
    const sortable_related = new Sortable(document.getElementById('{{$sorter_name}}'), {
        animation: 100,
        onEnd: function(evt) {
            ajax_item_action('{{$update_link}}',{
                    img: Array.from( document.querySelectorAll('#{{$sorter_name}} .sortable-item') ).map(item => item.getAttribute('data-id')),
                    product_id: "{{$id_item}}",
                    _token: "{{$csrf}}"
                },
                 function(){ $('#{{$id_btn}}').click();  }
            );
        }
    });

</script>


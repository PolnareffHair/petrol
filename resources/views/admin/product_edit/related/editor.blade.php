@php


$add_id = "add_rel_product";

$sorter_name = "sortable-list-related";

$get_link = '/admin/product_edit/rel_edit/content';

$delete_link = '/admin/product_edit/rel_edit/delete';

$uppdate_link = '/admin/product_edit/rel_edit/uppdate';

$add_link = '/admin/product_edit/rel_edit/add';

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
<script>
    $("#add_related_input").on("click", function() {
        setTimeout(function () {
             ajax_item_get('http://localhost/admin/search_product',
             {
                _token: "{{$csrf}}",
                search: $("#add_related_input").val(),
            },
            function(response) {
               $("#searcher{{$sorter_name}}").html(response);
            }
             );
        }, 100)
    });

    setInterval(
        function() {
            if ( changebale_val_storage_related_input != $("#add_related_input").val() ) {
            $("#add_related_input").click();
            changebale_val_storage_related_input = $("#add_related_input").val();
            console.log("uppdate");
        }
    }, 250);

    $('#searcher{{$sorter_name}}').on('click', function(event) {
                addButton = event.target.closest('.add');
                addRlated(addButton.getAttribute('data-id'));
    });

    let changebale_val_storage_related_input = 10;

 



    function addRlated(id) {
        ajax_item_action('{{$add_link }}',{
             related_id: id,
                    product_id: "{{$id_item}}",
                    _token: "{{$csrf}}"
                },
                get_related_editor
             );
    }



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
                get_related_editor
             );
        }
    });
    // Function to get the current order of items
    function getOrder_related() {
        const items = document.querySelectorAll('#{{$sorter_name}} .sortable-item');
        const order = Array.from(items).map(item => item.getAttribute('data-id'));
        return order;
        //console.log('Current order:', order);
    }
    // Инициализация SortableJS
    const sortable_related = new Sortable(document.getElementById('{{$sorter_name}}'), {
        animation: 100,
        onEnd: function(evt) {
            ajax_item_action('{{$uppdate_link}}',{
                    img: getOrder_related(),
                    product_id: "{{$id_item}}",
                    _token: "{{$csrf}}"
                },
                get_related_editor
            );
        }
    });

    //get img list for editor
    function get_related_editor() {
        ajax_item_get(
            "{{$get_link}}",
            {
                _token: "{{$csrf}}",
                product_id: "{{$id_item}}"
            },    
            function (response){$("#{{$sorter_name}}").html(response);}
        );
    }
</script>
<button class="up" style="display:none;" onclick=" get_related_editor()">⟳</button>

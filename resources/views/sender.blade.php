@include("admin.header")
<div id = "text">

</div>
<script>
        $.ajax({
            url: '/admin/product_edit/rel_edit/content',
            type: 'post',
            data: {
                _token: csrf_token,
                product_id : "1008",
            },
            success: function(response) {
                $("#text").html (response);
            },
            error: function(xhr, status, error) {
    
            }
        });
    




</script>
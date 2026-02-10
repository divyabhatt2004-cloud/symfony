import alertify from "alertifyjs";
$(document).ready(function(){

    $('body').on('click','[data-action="add2Cart"]', function(){
        let productId = $(this).data('id')

        let quantity =$(this).data('quantity')?? 1;

        if(!productId)
        {
            alertify.error('Product id not defined.');
            return;
        }
       addToCart(productId ,quantity)
    })
})
$(document).ready(function(){

    $('body').on('click','[data-action="add2CartFromView"]', function(){

        let productId = $(this).data('id')

        let quantity = $(this).data('quantity')?? 1;

        if(!productId)
        {
            alertify.error('Product id not defined.');
            return;
        }
        addToCart(productId ,quantity)
    })
})
$(document).ready(function(){
    if($('#product_cartTable').length > 0) {

        $.ajax({
            type: 'get',
            url: '/productCart-table',
            success: function (res) {
                $('#product_cartTable').html(res);
            },
        })
    }
})

const addToCart = (productId,quantity = 1) => {
    $.ajax({
        url:`/add-to-cart`,
        type:'post',
        data: { productId, quantity},
        success:function(res){
            if(res.status){
                alertify.success(res.msg)
            }
            else{
                alertify.error(res.errorMsg)
            }
        },
    })

}

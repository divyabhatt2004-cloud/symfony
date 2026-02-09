$(document).ready(function(){
    $('#quantity_minus').on('click',function(){
        let parent = $(this).parent();
        let input = parent.find('.quantityInput');
        let id = input.data('id');
        let quantity = parseInt(input.val(), 10) || 0;
        let newQuantity = quantity - 1;

        input.val(newQuantity);
        $('.add_to_cart').attr('href', `{{ path('add_to_cart',{'id':${id} },{'quantity':${newQuantity}}) }}`);
    })

    $('#quantity_plus').on('click',function(){
        let parent = $(this).parent();
        let input = parent.find('.quantityInput');
        let id = input.data('id');
        let quantity = parseInt(input.val(), 10) || 0;
        let newQuantity = quantity + 1;

        input.val(newQuantity);
        $('.add_to_cart').attr('href', `{{ path('add_to_cart',{'id':${id} },{'quantity':${newQuantity}}) }}`);
    })
})




//productImage visibility in form
$(document).ready(function () {
    $('#trashImage').on('click', function () {
        $('#uploadImage').toggleClass('d-none');
        $('#updateImage').toggleClass('d-none');
    })
})

//product quantity management in productDetails page
$(document).ready(function(){
    $('#quantity_minus').on('click',function(){
        let parent = $(this).parent();
        let input = parent.find('.quantityInput');
        let quantity = parseInt(input.val(), 10);
        let newQuantity = quantity > 1 ?  quantity - 1 : 1;
        input.val(newQuantity);
        $('.add_to_cart').attr('data-quantity',newQuantity);
    })

    $('#quantity_plus').on('click',function(){
        let parent = $(this).parent();
        let input = parent.find('.quantityInput');

        let quantity = parseInt(input.val(), 10) || 0;
        let newQuantity = quantity + 1;
        input.val(newQuantity);
        $('.add_to_cart').attr('data-quantity',newQuantity);
    })


})




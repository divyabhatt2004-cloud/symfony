


//productImage visibility in form
$(document).ready(function () {
    $(document).on('click','#trashImage', function () {
        $('#uploadImage').toggleClass('d-none');
        $('#updateImage').toggleClass('d-none');
    })
    // $(document).on('click','#uploadedImage',function(){
    //     let src =$(this).attr('src');
    //     $.ajax
    //     })
    // })
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




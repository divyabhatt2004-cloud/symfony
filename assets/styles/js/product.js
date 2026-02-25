


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

    $(document).on('click', '[data-modal="productForm"]', function (e) {
        e.preventDefault();
        let url = $(this).attr('href') || $(this).data('url');

        if (!url) {
            alertify.error('url not found');
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            success: function (res) {
                bootbox.dialog({
                    title: ' Add Product',
                    message: res,
                    size: 'large',
                    buttons: {
                        cancel: {
                            label: "cancel",
                            className: 'btn-secondary',
                            callback: function () {
                                console.log('action cancel');
                            }
                        },

                        save: {
                            label: "save",
                            className: 'btn-success',
                            callback: function () {
                                let Form = $(this).find('form')[0];
                                let formData = new FormData(Form);

                                $.ajax({
                                    url: url,
                                    type: 'post',
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    data: formData,
                                    enctype: 'multipart/form-data',
                                    success: function (res) {
                                        if (res.status) {
                                            alertify.success(res.msg);
                                        }

                                        if (res.redirect) {
                                            window.location.href = res.redirect;
                                        }

                                    },
                                    error: function (errorRes) {
                                        alertify.error('Product not created');
                                    }
                                })
                            }
                        }
                    }
                });
            }
        });
    })
})




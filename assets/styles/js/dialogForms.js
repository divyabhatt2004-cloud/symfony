$(document).ready(function () {
    //createProductForm
    $(document).on('click', '[data-modal="productForm"]', function (e) {
        e.preventDefault();
        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Add Product';
        let errorMsg = 'Product not created';
        if (!url) {
            alertify.error('url not found');
            return;
        }
        dialogBox(url,title,errorMsg);
    })
    //updateProductForm
    $(document).on('click','[data-modal="updateProductForm"]', function (e) {
        e.preventDefault();
        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Update Product';
        let errorMsg = 'Product not Updated';

        if (!url) {
            alertify.error('url not found');
            return;
        }
        dialogBox(url,title,errorMsg);
    })
    //create category
    $(document).on('click', '[data-modal="CategoryForm"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Add Category';
        let errorMsg = 'Category not created';
        if (!url) {
            alertify.error('url not found')
            return;
        }
        dialogBox(url,title,errorMsg);
    })
    // update Category
    $(document).on('click', '[data-modal="updateCategoryFrom"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Update Category';
        let errorMsg = 'Category not Updated';
        if (!url) {
            alertify.error('url not found')
            return;
        }
        dialogBox(url,title,errorMsg);
    })
    //create request
    $(document).on('click', '[data-modal="ContactForm"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Add Request';
        let errorMsg = 'Request not submitted';
        if (!url) {
            alertify.error('url not found');
            return;
        }
        dialogBox(url,title,errorMsg);
    })
    //update Request
    $(document).on('click', '[data-modal="updateRequest"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');
        let title = 'Update Request';
        let errorMsg = 'Request not Updated';
        if (!url) {
            alertify.error('url not found');
            return;
        }
        dialogBox(url,title,errorMsg);
    })
})
const dialogBox = (url,title,error) =>{
    $.ajax({
        url: url,
        type: 'get',
        success: function (res) {
            bootbox.dialog({
                title:title,
                message: res,
                size: 'large',
                buttons: {
                    cancel: {
                        label: 'Cancel',
                        className: 'btn btn-secondary',
                        callback: function () {
                            console.log('action cancel')
                        }
                    },
                    save: {
                        label: 'Save',
                        className: 'btn btn-success',
                        callback: function () {
                            let Form = $(this).find('form')[0];
                            let formData = new FormData(Form);

                            $.ajax({
                                url: url,
                                type: 'post',
                                data: formData,
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function (res) {
                                    if (res.status) {
                                        alertify.success(res.msg);
                                    }

                                    if (res.redirect) {
                                        window.location.href = res.redirect;
                                    }
                                },
                                error: function (errorRes) {
                                    alertify.error(error);
                                }
                            })
                        }
                    }
                }
            })
        }
    })
}

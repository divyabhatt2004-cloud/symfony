$(document).ready(function () {
    $(document).on('click', '[data-modal="CategoryForm"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');

        if (!url) {
            alertify.error('url not found')
            return;
        }

        $.ajax({
            url: url,
            type: 'get',
            success: function (res) {
                bootbox.dialog({
                    title: 'Add Category',
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
                                        alertify.error('Category not created');
                                    }
                                })
                            }
                        }
                    }
                })
            }
        })
    })
    $(document).on('click', '[data-modal="ContactForm"]', function (e) {
        e.preventDefault();

        let url = $(this).attr('href') || $(this).data('url');

        if (!url) {
            alertify.error('url not found');
            return;
        }

        $.ajax({
            url: url,
            type: 'get',
            success: function(res){
                bootbox.dialog({
                    title: 'Contact',
                    message: res,
                    size: 'large',
                    buttons:{
                        cancel:{
                            label:'Cancel',
                            className:'btn btn-secondary',
                            callback: function(){
                                console.log('cancel clicked')
                            }
                        },
                         save:{
                            label:'Save',
                             className:' btn btn-success',
                             callback: function(){
                                let Form =$(this).find('form')[0];
                                let formData= new FormData(Form);

                                $.ajax({
                                    url: url,
                                    type:'post',
                                    processData:false,
                                    contentType:false,
                                    cache:false,
                                    data:formData,
                                    success:function(res){
                                        if(res.status){
                                            alertify.success(res.msg);
                                        }

                                        if(res.redirect){
                                            window.location.href = res.redirect;
                                        }
                                    },
                                    error: function (errorRes) {
                                        alertify.error('Request not created');
                                    }
                                })
                             }
                         }
                    }
                })
            }
        })
    })
})

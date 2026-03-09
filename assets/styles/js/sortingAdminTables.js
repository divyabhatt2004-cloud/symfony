import alertify from "alertifyjs";

$(document).ready(function () {
    $(document).on('click', '.ProductDataTable th a', function (e) {
        e.preventDefault();

        let currentUrl = $(this).attr('href');
        if (!currentUrl || currentUrl === 'javascript:void(0)') {
            alertify.error('url not found');
            return;
        }
        table(currentUrl)
    });

    $(document).on('click', '.CategoryDataTable th a', function (e) {
        e.preventDefault();

        let currentUrl = $(this).attr('href');
        if (!currentUrl || currentUrl === 'javascript:void(0)') {
            alertify.error('url not found');
            return;
        }
        table(currentUrl)
    });

    $(document).on('click','.RequestDataTable th a', function(e){
        e.preventDefault();

        let currentUrl =$(this).attr('href');
        if(!currentUrl || currentUrl === 'javascript:void(0)'){
            alertify.error('url not found');
            return;
        }
        table(currentUrl)
    })

    const table = (currentUrl) => {
        $.ajax({
            url: currentUrl,
            type: 'GET',
            success: function (res) {
                $('.tableResponse').html(res);
            }
        });
    }
})

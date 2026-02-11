$(document).ready(function () {
    $('.dataTable th a').on('click', function (e) {
        e.preventDefault();
        let currentUrl = $(this).attr('href');
        if (!currentUrl || currentUrl === 'javascript:void(0)') {
            return;
        }
        $.ajax({
            url: currentUrl,
            type: 'get',
            success: function (res) {
                $('.tableResponse').html(res)
            },
        })
    })
})
// onRecordsPerPage = () => {
//
// }

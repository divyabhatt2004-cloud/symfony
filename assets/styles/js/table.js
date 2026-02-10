$(document).ready(function () {
    $('.fa-sort').on('click', function () {
        let url = $(this).attr('href')
        $.ajax({
            url: url,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $(this).html(res);
                }
            },
        })
    })
})
// onRecordsPerPage = () => {
//
// }

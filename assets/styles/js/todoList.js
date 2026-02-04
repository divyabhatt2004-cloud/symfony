$(document).ready(function () {
    if ($('#table').length > 0) {

        $.ajax({
            type: 'get',
            url: '/todo-list-table',
            success: function (res) {
                $('#table').html(res);
            },
        })
    }

    $('body').on('click','[data-type="popup"][data-edit="form"]',function(){
        window.bootbox.dialog({
            title: 'A custom dialog with buttons and callbacks',
            message: "<p>This dialog has buttons. Each button has it's own callback function.</p>",
            size: 'large',
            buttons: {
                cancel: {
                    label: "I'm a cancel button!",
                    className: 'btn-danger',
                    callback: function(){
                        console.log('Custom cancel clicked');
                    }
                },
                noclose: {
                    label: "I don't close the modal!",
                    className: 'btn-warning',
                    callback: function(){
                        console.log('Custom button clicked');
                        return false;
                    }
                },
                ok: {
                    label: "I'm an OK button!",
                    className: 'btn-info',
                    callback: function(){
                        console.log('Custom OK clicked');
                    }
                }
            }
        })
    })

})




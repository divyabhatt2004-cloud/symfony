import alertify from "alertifyjs";
$(document).ready(function(){

    $('body').on('click','[data-action="add2Cart"]', function(){
        let url = $(this).data('url')
        $.ajax({
            url:url,
            type:'post',
            success:function(res){
                if(res.status){
                    alertify.success(res.msg)
                }
                else{
                    alertify.error(res.errorMsg)
                }
            }
        })

    })
})

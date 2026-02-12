import alertify from "alertifyjs";

$(document).ready(function () {
    $('#trashImage').on('click', function () {
        $('#uploadImage').toggleClass('d-none');
        $('#updateImage').toggleClass('d-none');
    })

    $("#image-dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        title: "Image Preview"
    });

    $('#viewImage').on('click', function () {
        $("#image-dialog").dialog("open");
    })
})




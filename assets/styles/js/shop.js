
$('#categoryDropdown').on('click', function () {
    $(this).toggleClass('fa-circle-chevron-up fa-circle-chevron-down')
    $('#categoryList').toggleClass('d-none')
})
$('#genderDropdown').on('click', function () {
    $(this).toggleClass('fa-circle-chevron-down fa-circle-chevron-up')
    $('#genderList').toggleClass('d-none')
})

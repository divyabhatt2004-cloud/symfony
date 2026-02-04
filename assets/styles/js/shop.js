$('#categoryDropdown').on('click', function () {
    console.log('shop.js:clicked')
    $(this).toggleClass('fa-circle-chevron-up fa-circle-chevron-down')
    $('#categoryList').toggleClass('d-none')
})
$('#genderDropdown').on('click', function () {
    console.log('shop.js:clicked')
    $(this).toggleClass('fa-circle-chevron-down fa-circle-chevron-up')
    $('#genderList').toggleClass('d-none')
})

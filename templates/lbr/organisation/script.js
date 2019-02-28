$('.menu').on('click', function () {
    $(this).toggleClass('close');
    $('header nav').slideToggle();
});
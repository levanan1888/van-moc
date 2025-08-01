$(document).ready(() => {
    'use strict';
    $(window).scroll(function () {
        var pixel = $(window).scrollTop();
        if (pixel > 80) {
            $('.page-header__right').addClass('fixed-menu');
        } else {
            $('.page-header__right').removeClass('fixed-menu');
        }
    });
});

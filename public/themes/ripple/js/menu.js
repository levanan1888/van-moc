$(document).ready(() => {
    'use strict';
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        const scrollHeight = $(document).height();
        const scrollPosition = $(window).height() + scrollTop;
        if (scrollTop > 80) {
            $('.page-header__right').addClass('fixed-menu');
        } else {
            $('.page-header__right').removeClass('fixed-menu');
        }

        $('.social-mobile-sticky').addClass('social-mobile-scroll');

        if (scrollPosition >= scrollHeight - 150) {
            $('.social-mobile-sticky').removeClass('social-mobile-scroll');
        }
    });
});

/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************************!*\
  !*** ./platform/plugins/product/resources/assets/js/product.js ***!
  \*****************************************************************/
$(document).ready(function () {
  'use strict';

  slick_images();
  scroll_to_contact_form();
  read_more();
  init_frame();
  $(window).on('resize', function () {
    init_frame();
  });
  var screenWidth = $(window).width();
  if (screenWidth <= 991) {
    $('.trees-categories .collapse-2').removeClass('show');
    $('.trees-categories .accordion-button-2').addClass('collapsed');
  }
});
function init_frame() {
  var mainSlide = $(".mainLeft");
  var width = mainSlide.width();
  var thumbWidth = width / 6;
  var mainWidth = thumbWidth * 5 - 5;
  $('.slider-galeria').css('height', mainWidth);
  $('.slider-galeria').css('width', mainWidth);
  $('.slider-galeria img').css('height', mainWidth - 1);
  if ($('.slider-galeria .default').length == 1) {
    $('.slider-galeria .default').css('height', mainWidth);
  }
  $('.slider-galeria-thumbs .slick-list').css('max-height', mainWidth);
  $('.slider-galeria-thumbs').css('width', thumbWidth + 3);
}
function slick_images() {
  if ($('.slider-galeria-thumbs').length == 1) {
    setTimeout(function () {
      $('.slider-galeria').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        infinite: false,
        asNavFor: '.slider-galeria-thumbs',
        rows: 0
      });
      $('.slider-galeria-thumbs').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.slider-galeria',
        vertical: true,
        verticalSwiping: true,
        focusOnSelect: true,
        infinite: false,
        rows: 0
      });
      $('.slider-galeria-thumbs img').css('display', 'block');
      $('.slider-galeria img').css('display', 'block');
      $('.slider-galeria video').css('display', 'block');
    }, 0);
  }
}
function scroll_to_contact_form() {
  if ($(".btn-scroll").length == 1) {
    $(".btn-scroll").on('click', function (event) {
      event.preventDefault();
      var scrollId = $(this).attr('data-scroll');
      var target = $('#' + scrollId);
      if (target.length) {
        var offset = target.offset().top;
        $('html, body').animate({
          scrollTop: offset - 80 // Adjust the offset as needed
        }, 50);
      }
    });
  }
}
function read_more() {
  if ($('.read-more').length == 1) {
    $('.read-more').readmore({
      speed: 300,
      collapsedHeight: 140,
      moreLink: '<a style="text-align: center;color: #ff9900;padding:5px" href="#">Xem thêm</a>',
      lessLink: '<a style="text-align: center;color: #ff9900;padding:5px" href="#">Thu gọn</a>',
      heightMargin: 16
    });
    $('#loadMoreCategoryContent').css('display', 'block');
    $('#loadMoreCategoryContent').css('height', '100%');
  }
}
/******/ })()
;
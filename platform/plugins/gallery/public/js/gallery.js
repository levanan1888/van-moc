/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************************************************!*\
  !*** ./platform/plugins/gallery/resources/assets/js/gallery.js ***!
  \*****************************************************************/


function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var GalleryManagement = /*#__PURE__*/function () {
  function GalleryManagement() {
    _classCallCheck(this, GalleryManagement);
  }
  return _createClass(GalleryManagement, [{
    key: "init",
    value: function init() {
      var container = document.querySelector('#list-photo');
      var masonry;
      // initialize Masonry after all images have loaded
      if (container) {
        imagesLoaded(container, function () {
          masonry = new Masonry(container, {
            isOriginLeft: $('body').prop('dir') !== 'rtl'
          });
        });
      }
      $('#list-photo').lightGallery({
        loop: true,
        thumbnail: true,
        fourceAutoply: false,
        autoplay: false,
        pager: false,
        speed: 300,
        scale: 1,
        keypress: true
      });
      $(document).on('click', '.lg-toogle-thumb', function () {
        $(document).find('.lg-sub-html').toggleClass('inactive');
      });
    }
  }]);
}();
$(document).ready(function () {
  new GalleryManagement().init();
});
/******/ })()
;
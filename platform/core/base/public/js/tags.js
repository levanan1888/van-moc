/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./platform/core/base/resources/assets/js/tags.js ***!
  \********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var TagsManager = /*#__PURE__*/function () {
  function TagsManager() {
    _classCallCheck(this, TagsManager);
  }
  return _createClass(TagsManager, [{
    key: "init",
    value: function init() {
      $(document).find('.tags').each(function (index, element) {
        var tagify = new Tagify(element, {
          keepInvalidTags: $(element).data('keep-invalid-tags') !== undefined ? $(element).data('keep-invalid-tags') : true,
          enforceWhitelist: $(element).data('enforce-whitelist') !== undefined ? $(element).data('enforce-whitelist') : false,
          delimiters: $(element).data('delimiters') !== undefined ? $(element).data('delimiters') : ',',
          whitelist: element.value.trim().split(/\s*,\s*/),
          userInput: $(element).data('user-input') !== undefined ? $(element).data('user-input') : true
        });
        if ($(element).data('url')) {
          tagify.on('input', function (e) {
            tagify.settings.whitelist.length = 0; // reset current whitelist
            tagify.loading(true).dropdown.hide.call(tagify); // show the loader animation

            $.ajax({
              type: 'GET',
              url: $(element).data('url'),
              success: function success(data) {
                tagify.settings.whitelist = data;

                // render the suggestions dropdown.
                tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
              }
            });
          });
        }
      });
    }
  }]);
}();
$(document).ready(function () {
  new TagsManager().init();
});
/******/ })()
;
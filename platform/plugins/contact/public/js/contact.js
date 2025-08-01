/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************************!*\
  !*** ./platform/plugins/contact/resources/assets/js/contact.js ***!
  \*****************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var ContactPluginManagement = /*#__PURE__*/function () {
  function ContactPluginManagement() {
    _classCallCheck(this, ContactPluginManagement);
  }
  return _createClass(ContactPluginManagement, [{
    key: "init",
    value: function init() {
      $(document).on('click', '.answer-trigger-button', function (event) {
        event.preventDefault();
        event.stopPropagation();
        var answerWrapper = $('.answer-wrapper');
        if (answerWrapper.is(':visible')) {
          answerWrapper.fadeOut();
        } else {
          answerWrapper.fadeIn();
        }
      });
      $(document).on('click', '.answer-send-button', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(event.currentTarget).addClass('button-loading');
        var message = $('#message').val();
        if (typeof tinymce != 'undefined') {
          message = tinymce.get('message').getContent();
        }
        $.ajax({
          type: 'POST',
          cache: false,
          url: route('contacts.reply', $('#input_contact_id').val()),
          data: {
            message: message
          },
          success: function success(res) {
            if (!res.error) {
              $('.answer-wrapper').fadeOut();
              if (typeof tinymce != 'undefined') {
                tinymce.get('message').setContent('');
              } else {
                $('#message').val('');
                var domEditableElement = document.querySelector('.answer-wrapper .ck-editor__editable');
                var editorInstance = domEditableElement.ckeditorInstance;
                if (editorInstance) {
                  editorInstance.setData('');
                }
              }
              Botble.showSuccess(res.message);
              $('#reply-wrapper').load(window.location.href + ' #reply-wrapper > *');
            }
            $(event.currentTarget).removeClass('button-loading');
          },
          error: function error(res) {
            $(event.currentTarget).removeClass('button-loading');
            Botble.handleError(res);
          }
        });
      });
    }
  }]);
}();
$(document).ready(function () {
  new ContactPluginManagement().init();
});
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************************************!*\
  !*** ./platform/core/base/resources/assets/js/form/phone-number-field.js ***!
  \***************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var PhoneNumberField = /*#__PURE__*/function () {
  function PhoneNumberField() {
    _classCallCheck(this, PhoneNumberField);
  }
  return _createClass(PhoneNumberField, [{
    key: "init",
    value: function init() {
      $(document).find('.js-phone-number-mask').each(function (index, element) {
        window.intlTelInput(element, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
          // dropdownContainer: document.body,
          // excludeCountries: ["us"],
          // formatOnDisplay: false,
          geoIpLookup: function geoIpLookup(callback) {
            $.get('https://ipinfo.io', function () {}, 'jsonp').always(function (resp) {
              callback(resp && resp.country ? resp.country : '');
            });
          },
          // hiddenInput: "full_number",
          initialCountry: 'auto',
          // localizedCountries: { 'de': 'Deutschland' },
          // nationalMode: false,
          // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
          // placeholderNumberType: "MOBILE",
          // preferredCountries: ['cn', 'jp'],
          // separateDialCode: true,
          utilsScript: '/vendor/core/core/base/libraries/intl-tel-input/js/utils.js'
        });
      });
    }
  }]);
}();
$(document).ready(function () {
  new PhoneNumberField().init();
  document.addEventListener('payment-form-reloaded', function () {
    new PhoneNumberField().init();
  });
});
/******/ })()
;
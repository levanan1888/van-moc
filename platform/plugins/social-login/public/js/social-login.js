/******/ (() => { // webpackBootstrap
/*!***************************************************************************!*\
  !*** ./platform/plugins/social-login/resources/assets/js/social-login.js ***!
  \***************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var SocialLoginManagement = /*#__PURE__*/function () {
  function SocialLoginManagement() {
    _classCallCheck(this, SocialLoginManagement);
  }
  return _createClass(SocialLoginManagement, [{
    key: "init",
    value: function init() {
      $('#social_login_enable').on('change', function (event) {
        if ($(event.currentTarget).prop('checked')) {
          $('.wrapper-list-social-login-options').show();
        } else {
          $('.wrapper-list-social-login-options').hide();
        }
      });
      $('.enable-social-login-option').on('change', function (event) {
        var _self = $(event.currentTarget);
        if (_self.prop('checked')) {
          _self.closest('.wrapper-content').find('.enable-social-login-option-wrapper').show();
          _self.closest('.form-group').removeClass('mb-0');
        } else {
          _self.closest('.wrapper-content').find('.enable-social-login-option-wrapper').hide();
          _self.closest('.form-group').addClass('mb-0');
        }
      });
    }
  }]);
}();
$(document).ready(function () {
  new SocialLoginManagement().init();
});
/******/ })()
;
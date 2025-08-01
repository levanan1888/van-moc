/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************************************!*\
  !*** ./platform/packages/plugin-management/resources/assets/js/plugin.js ***!
  \***************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var PluginManagement = /*#__PURE__*/function () {
  function PluginManagement() {
    _classCallCheck(this, PluginManagement);
  }
  return _createClass(PluginManagement, [{
    key: "init",
    value: function init() {
      $('#plugin-list').on('click', '.btn-trigger-change-status', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          url: route('plugins.change.status', {
            name: _self.data('plugin')
          }),
          type: 'POST',
          data: {
            '_method': 'PUT'
          },
          success: function success(data) {
            if (data.error) {
              Botble.showError(data.message);
            } else {
              Botble.showSuccess(data.message);
              $('#plugin-list #app-' + _self.data('plugin')).load(window.location.href + ' #plugin-list #app-' + _self.data('plugin') + ' > *');
              window.location.reload();
            }
            _self.removeClass('button-loading');
          },
          error: function error(data) {
            Botble.handleError(data);
            _self.removeClass('button-loading');
          }
        });
      });
      $(document).on('click', '.btn-trigger-remove-plugin', function (event) {
        event.preventDefault();
        $('#confirm-remove-plugin-button').data('plugin', $(event.currentTarget).data('plugin'));
        $('#remove-plugin-modal').modal('show');
      });
      $(document).on('click', '#confirm-remove-plugin-button', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          url: route('plugins.remove', {
            plugin: _self.data('plugin')
          }),
          type: 'POST',
          data: {
            '_method': 'DELETE'
          },
          success: function success(data) {
            if (data.error) {
              Botble.showError(data.message);
            } else {
              Botble.showSuccess(data.message);
              window.location.reload();
            }
            _self.removeClass('button-loading');
            $('#remove-plugin-modal').modal('hide');
          },
          error: function error(data) {
            Botble.handleError(data);
            _self.removeClass('button-loading');
            $('#remove-plugin-modal').modal('hide');
          }
        });
      });
    }
  }]);
}();
$(document).ready(function () {
  new PluginManagement().init();
});
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************!*\
  !*** ./platform/core/table/resources/assets/js/filter.js ***!
  \***********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var TableFilter = /*#__PURE__*/function () {
  function TableFilter() {
    _classCallCheck(this, TableFilter);
  }
  return _createClass(TableFilter, [{
    key: "loadData",
    value: function loadData($element) {
      $.ajax({
        type: 'GET',
        url: $('.filter-data-url').val(),
        data: {
          "class": $('.filter-data-class').val(),
          key: $element.val(),
          value: $element.closest('.filter-item').find('.filter-column-value').val()
        },
        success: function success(res) {
          var data = $.map(res.data, function (value, key) {
            return {
              id: key,
              name: value
            };
          });
          $element.closest('.filter-item').find('.filter-column-value-wrap').html(res.html);
          var $input = $element.closest('.filter-item').find('.filter-column-value');
          if ($input.length && $input.prop('type') === 'text') {
            $input.typeahead({
              source: data
            });
            $input.data('typeahead').source = data;
          }
          Botble.initResources();
        },
        error: function error(_error) {
          Botble.handleError(_error);
        }
      });
    }
  }, {
    key: "init",
    value: function init() {
      var that = this;
      $.each($('.filter-items-wrap .filter-column-key'), function (index, element) {
        if ($(element).val()) {
          that.loadData($(element));
        }
      });
      $(document).on('change', '.filter-column-key', function (event) {
        that.loadData($(event.currentTarget));
      });
      $(document).on('click', '.btn-reset-filter-item', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.closest('.filter-item').find('.filter-column-key').val('').trigger('change');
        _self.closest('.filter-item').find('.filter-column-operator').val('=');
        _self.closest('.filter-item').find('.filter-column-value').val('');
      });
      $(document).on('click', '.add-more-filter', function () {
        var $template = $(document).find('.sample-filter-item-wrap');
        var html = $template.html();
        $(document).find('.filter-items-wrap').append(html.replace('<script>', '').replace('<\\/script>', ''));
        Botble.initResources();
        var element = $(document).find('.filter-items-wrap .filter-item:last-child').find('.filter-column-key');
        if ($(element).val()) {
          that.loadData(element);
        }
      });
      $(document).on('click', '.btn-remove-filter-item', function (event) {
        event.preventDefault();
        $(event.currentTarget).closest('.filter-item').remove();
      });
    }
  }]);
}();
$(document).ready(function () {
  new TableFilter().init();
});
/******/ })()
;
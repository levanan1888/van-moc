/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************************!*\
  !*** ./platform/packages/widget/resources/assets/js/widget.js ***!
  \****************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var WidgetManagement = /*#__PURE__*/function () {
  function WidgetManagement() {
    _classCallCheck(this, WidgetManagement);
  }
  return _createClass(WidgetManagement, [{
    key: "init",
    value: function init() {
      var listWidgets = [{
        name: 'wrap-widgets',
        pull: 'clone',
        put: false
      }];
      $.each($('.sidebar-item'), function () {
        listWidgets.push({
          name: 'wrap-widgets',
          pull: true,
          put: true
        });
      });
      var saveWidget = function saveWidget(parentElement) {
        if (parentElement.length > 0) {
          var items = [];
          $.each(parentElement.find('li[data-id]'), function (index, widget) {
            items.push($(widget).find('form').serialize());
          });
          $.ajax({
            type: 'POST',
            cache: false,
            url: BWidget.routes.save_widgets_sidebar,
            data: {
              items: items,
              sidebar_id: parentElement.data('id')
            },
            beforeSend: function beforeSend() {
              Botble.showNotice('info', BotbleVariables.languages.notices_msg.processing_request);
            },
            success: function success(data) {
              if (data.error) {
                Botble.showError(data.message);
              } else {
                parentElement.find('ul').html(data.data);
                Botble.callScroll($('.list-page-select-widget'));
                Botble.initResources();
                Botble.initMediaIntegrate();
                Botble.showSuccess(data.message);
              }
            },
            error: function error(data) {
              Botble.handleError(data);
            },
            complete: function complete() {
              parentElement.find('.widget_save i').remove();
            }
          });
        }
      };
      listWidgets.forEach(function (groupOpts, i) {
        Sortable.create(document.getElementById('wrap-widget-' + (i + 1)), {
          sort: i !== 0,
          group: groupOpts,
          delay: 0,
          // time in milliseconds to define when the sorting should start
          disabled: false,
          // Disables the sortable if set to true.
          store: null,
          // @see Store
          animation: 150,
          // ms, animation speed moving items when sorting, `0` — without animation
          handle: '.widget-handle',
          ghostClass: 'sortable-ghost',
          // Class name for the drop placeholder
          chosenClass: 'sortable-chosen',
          // Class name for the chosen item
          dataIdAttr: 'data-id',
          forceFallback: false,
          // ignore the HTML5 DnD behaviour and force the fallback to kick in
          fallbackClass: 'sortable-fallback',
          // Class name for the cloned DOM Element when using forceFallback
          fallbackOnBody: false,
          // Appends the cloned DOM Element into the Document's Body

          scroll: true,
          // or HTMLElement
          scrollSensitivity: 30,
          // px, how near the mouse must be to an edge to start scrolling.
          scrollSpeed: 10,
          // px

          // Changed sorting within list
          onUpdate: function onUpdate(evt) {
            if (evt.from !== evt.to) {
              saveWidget($(evt.from).closest('.sidebar-item'));
            }
            saveWidget($(evt.item).closest('.sidebar-item'));
          },
          onAdd: function onAdd(evt) {
            if (evt.from !== evt.to) {
              saveWidget($(evt.from).closest('.sidebar-item'));
            }
            saveWidget($(evt.item).closest('.sidebar-item'));
          }
        });
      });
      var widgetWrap = $('#wrap-widgets');
      widgetWrap.on('click', '.widget-control-delete', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var widget = _self.closest('li');
        _self.addClass('button-loading');
        $.ajax({
          type: 'POST',
          cache: false,
          url: BWidget.routes["delete"],
          data: {
            _method: 'DELETE',
            widget_id: widget.data('id'),
            position: widget.data('position'),
            sidebar_id: _self.closest('.sidebar-item').data('id')
          },
          beforeSend: function beforeSend() {
            Botble.showNotice('info', BotbleVariables.languages.notices_msg.processing_request);
          },
          success: function success(data) {
            if (data.error) {
              Botble.showError(data.message);
            } else {
              Botble.showSuccess(data.message);
              widget.fadeOut().remove();
            }
          },
          error: function error(data) {
            Botble.handleError(data);
          },
          complete: function complete() {
            widget.find('.widget-control-delete').removeClass('button-loading');
          }
        });
      });
      widgetWrap.on('click', '#added-widget .widget-handle', function (event) {
        var _self = $(event.currentTarget);
        _self.closest('li').find('.widget-content').slideToggle(300);
        _self.find('.fa').toggleClass('fa-caret-up');
        _self.find('.fa').toggleClass('fa-caret-down');
      });
      widgetWrap.on('click', '#added-widget .sidebar-header', function (event) {
        var _self = $(event.currentTarget);
        _self.closest('.sidebar-area').find('> ul').slideToggle(300);
        _self.find('.fa').toggleClass('fa-caret-up');
        _self.find('.fa').toggleClass('fa-caret-down');
      });
      widgetWrap.on('click', '.widget_save', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        saveWidget(_self.closest('.sidebar-item'));
      });
      Botble.callScroll($('.list-page-select-widget'));
    }
  }]);
}();
$(document).ready(function () {
  new WidgetManagement().init();
});
/******/ })()
;
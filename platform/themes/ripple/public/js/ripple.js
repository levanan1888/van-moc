/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./platform/themes/ripple/assets/js/ripple.js ***!
  \****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Ripple: () => (/* binding */ Ripple)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var searchInput = $('.search-input');
var superSearch = $('.super-search');
var closeSearch = $('.close-search');
var searchResult = $('.search-result');
var timeoutID = null;
var Ripple = /*#__PURE__*/function () {
  function Ripple() {
    _classCallCheck(this, Ripple);
  }
  return _createClass(Ripple, [{
    key: "searchFunction",
    value: function searchFunction(keyword) {
      clearTimeout(timeoutID);
      timeoutID = setTimeout(function () {
        superSearch.removeClass('search-finished');
        searchResult.fadeOut();
        $.ajax({
          type: 'GET',
          cache: false,
          url: superSearch.data('search-url'),
          data: {
            'q': keyword
          },
          success: function success(res) {
            if (!res.error) {
              searchResult.html(res.data.items);
              superSearch.addClass('search-finished');
            } else {
              searchResult.html(res.message);
            }
            searchResult.fadeIn(500);
          },
          error: function error(res) {
            searchResult.html(res.responseText);
            searchResult.fadeIn(500);
          }
        });
      }, 500);
    }
  }, {
    key: "bindActionToElement",
    value: function bindActionToElement() {
      var _this = this;
      closeSearch.on('click', function (event) {
        event.preventDefault();
        if (closeSearch.hasClass('active')) {
          superSearch.removeClass('active');
          searchResult.hide();
          closeSearch.removeClass('active');
          $('body').removeClass('overflow');
          $('.quick-search > .form-control').focus();
        } else {
          superSearch.addClass('active');
          if (searchInput.val() !== '') {
            _this.searchFunction(searchInput.val());
          }
          $('body').addClass('overflow');
          closeSearch.addClass('active');
        }
      });
      searchInput.keyup(function (e) {
        searchInput.val(e.target.value);
        _this.searchFunction(e.target.value);
      });
    }
  }]);
}();
$(document).ready(function () {
  new Ripple().bindActionToElement();
});
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************************!*\
  !*** ./platform/plugins/customer/resources/assets/js/customer.js ***!
  \*******************************************************************/
$(document).ready(function () {
  'use strict';

  BDashboard.loadWidget($('#widget_customers_recent').find('.widget-content'), route('customers.widget.recent-customers'));
});
/******/ })()
;
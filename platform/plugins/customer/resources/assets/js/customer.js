$(document).ready(() => {
    'use strict';
    BDashboard.loadWidget($('#widget_customers_recent').find('.widget-content'), route('customers.widget.recent-customers'));
});

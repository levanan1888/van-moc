<?php

// Đăng ký menu locations cho theme van-moc
add_action(BASE_ACTION_INIT, function () {
    if (function_exists('Menu::addMenuLocation')) {
        Menu::addMenuLocation('main-menu', trans('plugins/menu::menu.main_menu'));
        Menu::addMenuLocation('footer-menu-1', trans('plugins/menu::menu.footer_menu_1'));
        Menu::addMenuLocation('footer-menu-2', trans('plugins/menu::menu.footer_menu_2'));
    }
}, 1);

// Đăng ký menu locations trong theme options
add_action(BASE_ACTION_INIT, function () {
    if (function_exists('Menu::addMenuLocation')) {
        Menu::addMenuLocation('main-menu', 'Main Menu');
        Menu::addMenuLocation('footer-menu-1', 'Footer Menu 1');
        Menu::addMenuLocation('footer-menu-2', 'Footer Menu 2');
    }
}, 1); 
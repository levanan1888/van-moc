<?php

if (!function_exists('get_filters')) {

    function get_filters($filters = []) {
        $url = '';
        if(!empty($filters)) {
            foreach($filters as $key => $value) {
                if (!empty($value))
                    $url.= '&'.$key.'='.$value;
            }
        }
        return $url;

    }
}

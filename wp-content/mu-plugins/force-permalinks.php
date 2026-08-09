<?php
/*
Plugin Name: Force Pretty Permalinks
Description: Memaksa WordPress menggunakan /%postname%/ (menghilangkan index.php) di environment yang nge-bug.
*/

add_filter('pre_option_permalink_structure', function($val) {
    return '/%postname%/';
});

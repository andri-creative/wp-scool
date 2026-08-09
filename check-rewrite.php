<?php
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    if (in_array('mod_rewrite', $modules)) {
        echo "YES - mod_rewrite is loaded";
    } else {
        echo "NO - mod_rewrite is NOT loaded";
    }
} else {
    echo "apache_get_modules function does not exist. Are we using CGI/FPM?";
    if (isset($_SERVER['HTTP_MOD_REWRITE'])) {
        echo " (But HTTP_MOD_REWRITE says yes)";
    }
}

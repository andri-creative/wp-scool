<?php
require_once 'wp-load.php';
global $wp_rewrite;
$wp_rewrite->set_permalink_structure('');
flush_rewrite_rules();
echo 'Permalinks set to plain!';

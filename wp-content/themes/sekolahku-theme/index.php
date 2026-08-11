<?php
/**
 * Template Fallback Utama (`index.php`).
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$berita_template = get_template_directory() . '/archive-berita.php';
if ( file_exists( $berita_template ) ) {
	include $berita_template;
	exit;
}

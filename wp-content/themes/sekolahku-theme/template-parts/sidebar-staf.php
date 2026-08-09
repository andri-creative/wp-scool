<?php
/**
 * Sidebar Reusable Component (Compatibility Wrapper).
 * Mengarahkan panggilan lama ke komponen Sidebar Global template-parts/sidebar.php.
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/sidebar' );

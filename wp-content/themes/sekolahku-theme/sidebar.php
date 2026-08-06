<?php
/**
 * Sidebar untuk halaman Berita (single & archive).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-berita' ) ) {
	return;
}
?>
<aside class="sidebar">
	<?php dynamic_sidebar( 'sidebar-berita' ); ?>
</aside>

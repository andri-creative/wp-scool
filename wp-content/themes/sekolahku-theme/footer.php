<?php
/**
 * Template footer - dipakai di semua halaman.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer class="site-footer">
		<div class="container footer-grid">
			<div class="footer-about">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<h3><?php bloginfo( 'name' ); ?></h3>
				<?php endif; ?>
				<p><?php bloginfo( 'description' ); ?></p>
			</div>

			<div class="footer-contact">
				<h4>Kontak</h4>
				<p><?php echo esc_html( get_theme_mod( 'sekolahku_alamat', 'Jl. Pendidikan No. 1, Kota Anda' ) ); ?></p>
				<p><?php echo esc_html( get_theme_mod( 'sekolahku_telepon', '0851-2222-3333' ) ); ?></p>
				<p><?php echo esc_html( get_theme_mod( 'sekolahku_email', 'info@sekolahku.sch.id' ) ); ?></p>
			</div>

			<div class="footer-menu">
				<h4>Tautan</h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-menu-list',
					'fallback_cb'    => false,
				) );
				?>
			</div>

			<?php if ( is_active_sidebar( 'footer-kolom' ) ) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'footer-kolom' ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Seluruh hak cipta dilindungi.</p>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>

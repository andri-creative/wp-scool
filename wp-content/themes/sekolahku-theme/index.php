<?php
/**
 * Template fallback utama (wajib ada di setiap tema WordPress).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<div class="container page-content">
	<div class="content-with-sidebar">
		<main class="main-content">
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-3">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					?>
				</div>

				<div class="pagination">
					<?php the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'Belum ada konten untuk ditampilkan.', 'sekolahku' ); ?></p>
			<?php endif; ?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

<?php
/**
 * Template hasil pencarian.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<section class="page-header">
	<div class="container">
		<h1>Hasil Pencarian: <?php echo esc_html( get_search_query() ); ?></h1>
	</div>
</section>

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
				<p>Tidak ditemukan hasil untuk pencarian Anda.</p>
			<?php endif; ?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

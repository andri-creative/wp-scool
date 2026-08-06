<?php
/**
 * Template halaman default (dipakai jika tidak memilih page template khusus).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<div class="container page-content">
	<main class="main-content main-content-full">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'single-page' ); ?>>
				<h1><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-news-thumb">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="page-editor-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</main>
</div>

<?php get_footer(); ?>

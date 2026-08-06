<?php
/**
 * Template single post - halaman detail Berita.
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
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'single-news' ); ?>>
					<h1><?php the_title(); ?></h1>
					<?php sekolahku_post_meta(); ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="single-news-thumb">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>

					<div class="single-news-content">
						<?php the_content(); ?>
					</div>

					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">',
						'after'  => '</div>',
					) );
					?>
				</article>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>
				<?php
			endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

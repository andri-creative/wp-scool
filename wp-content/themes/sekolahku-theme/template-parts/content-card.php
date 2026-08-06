<?php
/**
 * Partial: kartu berita (dipakai di archive.php, index.php, search.php).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'card news-card' ); ?>>
	<a href="<?php the_permalink(); ?>" class="news-thumb">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large' ); ?>
		<?php else : ?>
			<div class="news-thumb-placeholder"></div>
		<?php endif; ?>
	</a>
	<div class="news-body">
		<?php sekolahku_post_meta(); ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
		<a href="<?php the_permalink(); ?>" class="read-more">Baca Selengkapnya &rarr;</a>
	</div>
</article>

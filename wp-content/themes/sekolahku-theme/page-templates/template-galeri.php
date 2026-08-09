<?php
/**
 * Template Name: Galeri Sekolah
 * Description: Menampilkan grid foto dari Custom Post Type "Galeri".
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<section class="page-header">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<p>Dokumentasi kegiatan, prestasi, dan momen keseharian di sekolah kami.</p>
	</div>
</section>

<div class="container page-content">
	<div class="gallery-grid">
		<?php
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$galeri_query = new WP_Query( array(
			'post_type'      => 'galeri',
			'posts_per_page' => 12,
			'paged'          => $paged,
		) );

		if ( $galeri_query->have_posts() ) :
			while ( $galeri_query->have_posts() ) :
				$galeri_query->the_post();
				$thumb_url = sekolahku_get_galeri_thumb( get_the_ID() );
				?>
				<a href="<?php the_permalink(); ?>" class="gallery-item" data-lightbox="galeri" data-title="<?php the_title_attribute(); ?>">
					<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
					<span class="gallery-caption"><?php the_title(); ?></span>
				</a>
				<?php
			endwhile;
			?>
			<?php
		else :
			echo '<p>Belum ada foto galeri. Tambahkan lewat menu "Galeri Sekolah" di dashboard admin.</p>';
		endif;
		?>
	</div>

	<?php if ( isset( $galeri_query ) && $galeri_query->max_num_pages > 1 ) : ?>
		<div class="pagination">
			<?php
			echo paginate_links( array(
				'total'   => $galeri_query->max_num_pages,
				'current' => $paged,
				'prev_text' => '&larr; Sebelumnya',
				'next_text' => 'Berikutnya &rarr;',
			) );
			wp_reset_postdata();
			?>
		</div>
	<?php endif; ?>
</div>

<!-- Lightbox sederhana (tanpa library eksternal) -->
<div class="sekolahku-lightbox" id="sekolahkuLightbox">
	<span class="lightbox-close" id="lightboxClose">&times;</span>
	<img src="" alt="" id="lightboxImage">
	<p id="lightboxCaption"></p>
</div>

<?php get_footer(); ?>

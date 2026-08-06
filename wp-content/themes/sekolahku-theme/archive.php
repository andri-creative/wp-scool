<?php
/**
 * Template arsip - dipakai untuk halaman daftar Berita (post type 'post').
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<section class="page-header">
	<div class="container">
		<h1>Berita &amp; Kegiatan Sekolah</h1>
		<p>Kumpulan informasi terbaru seputar kegiatan dan prestasi sekolah kami.</p>
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
					<?php the_posts_pagination( array(
						'prev_text' => '&larr; Sebelumnya',
						'next_text' => 'Berikutnya &rarr;',
					) ); ?>
				</div>
			<?php else : ?>
				<p>Belum ada berita yang dipublikasikan.</p>
			<?php endif; ?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

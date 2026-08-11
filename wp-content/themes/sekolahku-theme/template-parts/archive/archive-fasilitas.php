<?php
/**
 * Template Archive untuk Fasilitas
 * Location: template-parts/archive/archive-fasilitas.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part('template-parts/breadcrumb');
?>

<div class="container fasilitas-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Fasilitas Sekolah</h1>
	
	<div class="fasilitas-archive-content">
		<?php if ( have_posts() ) : ?>
			<div class="fasilitas-grid-container">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<div class="card facility-card">
						<div class="facility-card-inner">
							<div class="facility-text">
								<h3><?php the_title(); ?></h3>
								<?php
								$desc = get_the_excerpt();
								if ( ! $desc ) {
									$desc = wp_trim_words( get_the_content(), 18 );
								} else {
									$desc = wp_trim_words( $desc, 18 );
								}
								?>
								<p><?php echo esc_html( $desc ); ?></p>
								<a href="<?php the_permalink(); ?>" class="facility-link">Selengkapnya &raquo;</a>
							</div>
							<div class="facility-thumb">
								<img src="<?php echo esc_url( sekolahku_get_fasilitas_thumb( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="facility-img">
							</div>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>

			<div class="pagination" style="margin-top: 50px;">
				<?php the_posts_pagination( array(
					'prev_text' => '&larr; Sebelumnya',
					'next_text' => 'Berikutnya &rarr;',
				) ); ?>
			</div>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px;">Belum ada data fasilitas yang dipublikasikan.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* Menggunakan style judul yang presisi dengan halaman Staf */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}
@media (max-width: 768px) {
	.staf-page-title {
		font-size: 24px;
		margin-bottom: 20px;
	}
}

/* Grid 2 Kolom untuk Card Fasilitas (Sesuai Aturan Desktop) */
.fasilitas-grid-container {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 24px;
	width: 100%;
}

/* Responsivitas Grid */
@media (max-width: 992px) {
	.fasilitas-grid-container {
		grid-template-columns: 1fr; /* Jadi 1 kolom di Tablet & HP */
	}
}

/* Override ukuran gambar khusus halaman Archive Fasilitas */
.fasilitas-archive-container .facility-thumb {
	width: 42%;
	height: auto;
	min-height: 180px;
	align-self: stretch;
	flex-shrink: 0;
}
.fasilitas-archive-container .facility-thumb .facility-img,
.fasilitas-archive-container .facility-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}
.fasilitas-archive-container .facility-card-inner {
	align-items: stretch;
}
@media (max-width: 992px) {
	.fasilitas-archive-container .facility-thumb {
		width: 100%;
		min-height: 200px;
	}
}

</style>

<?php get_footer(); ?>

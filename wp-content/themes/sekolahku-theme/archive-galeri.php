<?php
/**
 * Template Archive untuk Galeri (Foto & Video) - 3 Kolom Gambar.
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container galeri-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Foto &amp; Video</h1>

	<div class="galeri-archive-content">
		<?php if ( have_posts() ) : ?>
			<div class="galeri-grid-container">
				<?php
				while ( have_posts() ) :
					the_post();
					$post_id   = get_the_ID();
					$thumb_url = sekolahku_get_galeri_thumb( $post_id );
					$badge     = sekolahku_get_galeri_badge( $post_id );
					?>
					<div class="card gallery-card galeri-archive-card">
						<a href="<?php the_permalink(); ?>" class="gallery-card-inner">
							<div class="gallery-thumb">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="gallery-img">
								<span class="gallery-badge">
									<?php echo esc_html( $badge ); ?>
								</span>
							</div>
							<div class="gallery-body">
								<h3><?php the_title(); ?></h3>
							</div>
						</a>
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
				<h3 style="color: #64748b; font-size: 18px;">Belum ada dokumentasi foto atau video yang dipublikasikan.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* JUDUL UTAMA HALAMAN (PRESISI DENGAN HALAMAN GURU) */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}

/* GRID 3 KOLOM GAMBAR (SEPERTI INSTRUKSI) */
.galeri-grid-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 24px;
	width: 100%;
}

/* CARD GALERI 3 KOLOM */
.galeri-archive-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
	transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
	display: flex;
	flex-direction: column;
}

.galeri-archive-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
	border-color: #cbd5e1;
}

.galeri-archive-card .gallery-card-inner {
	display: flex;
	flex-direction: column;
	text-decoration: none;
	height: 100%;
}

.galeri-archive-card .gallery-thumb {
	position: relative;
	width: 100%;
	aspect-ratio: 16 / 10;
	background: #f1f5f9;
	overflow: hidden;
}

.galeri-archive-card .gallery-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}

.galeri-archive-card:hover .gallery-img {
	transform: scale(1.06);
}

.galeri-archive-card .gallery-badge {
	position: absolute;
	top: 12px;
	right: 12px;
	background: rgba(15, 23, 42, 0.75);
	backdrop-filter: blur(4px);
	color: #ffffff;
	font-size: 11px;
	font-weight: 700;
	padding: 4px 10px;
	border-radius: 20px;
	letter-spacing: 0.5px;
}

.galeri-archive-card .gallery-body {
	padding: 18px 20px;
	flex: 1;
	display: flex;
	align-items: center;
	background: #ffffff;
}

.galeri-archive-card .gallery-body h3 {
	font-size: 16px;
	font-weight: 700;
	color: #0f172a;
	margin: 0;
	line-height: 1.4;
	transition: color 0.2s ease;
}

.galeri-archive-card:hover .gallery-body h3 {
	color: #ff7a00;
}

/* RESPONSIVITAS MOBILE & TABLET */
@media (max-width: 992px) {
	.galeri-grid-container {
		grid-template-columns: repeat(2, 1fr); /* 2 Kolom di Tablet */
	}
}

@media (max-width: 576px) {
	.galeri-grid-container {
		grid-template-columns: 1fr; /* 1 Kolom di HP */
	}
}
</style>

<?php get_footer(); ?>

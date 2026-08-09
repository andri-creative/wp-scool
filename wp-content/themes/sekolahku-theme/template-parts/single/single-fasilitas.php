<?php
/**
 * Template Single Fasilitas - Halaman Detail Fasilitas Sekolah (100% Presisi Sesuai Referensi Zekolla).
 * Location: template-parts/single/single-fasilitas.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container page-content single-fasilitas-container" style="margin-bottom: 80px;">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id   = get_the_ID();
		$title     = get_the_title();
		$thumb_url = sekolahku_get_fasilitas_thumb( $post_id );
		?>

		<div class="staf-layout-grid">
			<!-- KONTEN UTAMA (KIRI) -->
			<div class="staf-main-column">
				<!-- JUDUL FASILITAS -->
				<h1 class="staf-page-title"><?php echo esc_html( $title ); ?></h1>

				<!-- GAMBAR HERO UTAMA -->
				<?php if ( $thumb_url ) : ?>
					<div class="fasilitas-hero-wrapper">
						<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="fasilitas-hero-img">
					</div>
				<?php endif; ?>

				<!-- DESKRIPSI KONTEN UTAMA -->
				<div class="fasilitas-content-body">
					<?php
					$clean_content = get_the_content();
					// Hapus tag <img> dari isi konten untuk mencegah gambar tampil 2x
					$clean_content = preg_replace( '/<img[^>]+>/i', '', $clean_content );
					echo apply_filters( 'the_content', $clean_content );
					?>
				</div>

				<!-- TOMBOL BAGIKAN (SHARE BUTTONS) -->
				<?php get_template_part( 'template-parts/share-buttons' ); ?>

				<!-- SECTION FASILITAS LAINNYA (SLIDER / GRID REKOMENDASI) -->
				<div class="staf-other-section" style="margin-top: 40px;">
					<div class="other-section-header">
						<h3 class="decorated-title">Fasilitas Lainnya</h3>
						<div class="other-nav-arrows">
							<button type="button" class="other-nav-btn" id="fasilitasPrev" aria-label="Sebelumnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<button type="button" class="other-nav-btn" id="fasilitasNext" aria-label="Selanjutnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						</div>
					</div>

					<div class="other-staf-slider">
						<div class="other-staf-track" id="fasilitasTrack">
							<?php
							$other_fasilitas = new WP_Query( array(
								'post_type'      => 'fasilitas',
								'post__not_in'   => array( $post_id ),
								'posts_per_page' => 6,
							) );

							if ( $other_fasilitas->have_posts() ) :
								while ( $other_fasilitas->have_posts() ) :
									$other_fasilitas->the_post();
									$o_id    = get_the_ID();
									$o_thumb = sekolahku_get_fasilitas_thumb( $o_id );
									$o_desc  = wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 14 );
									?>
									<div class="other-fasilitas-card">
										<div class="other-fasilitas-img">
											<img src="<?php echo esc_url( $o_thumb ); ?>" alt="<?php the_title_attribute(); ?>">
										</div>
										<div class="other-fasilitas-body">
											<h4><?php the_title(); ?></h4>
											<p><?php echo esc_html( $o_desc ); ?></p>
											<a href="<?php the_permalink(); ?>" class="facility-link">Selengkapnya &raquo;</a>
										</div>
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
							?>
						</div>
					</div>
				</div>
			</div>

			<!-- SIDEBAR (KANAN) -->
			<?php get_template_part( 'template-parts/sidebar-staf' ); ?>
		</div>

	<?php endwhile; ?>
</div>

<style>
/* LAYOUT GRID 2 KOLOM (KIRI: KONTEN, KANAN: SIDEBAR) */
.staf-layout-grid {
	display: grid;
	grid-template-columns: 1fr 340px;
	gap: 32px;
	align-items: start;
}
@media (max-width: 992px) {
	.staf-layout-grid {
		grid-template-columns: 1fr;
	}
}

/* JUDUL UTAMA FASILITAS */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}

/* GAMBAR HERO FASILITAS */
.fasilitas-hero-wrapper {
	width: 100%;
	border-radius: 16px;
	overflow: hidden;
	margin-bottom: 28px;
	background: #f1f5f9;
	box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
}
.fasilitas-hero-img {
	width: 100%;
	height: auto;
	max-height: 480px;
	object-fit: cover;
	display: block;
}

/* DESKRIPSI KONTEN */
.fasilitas-content-body {
	font-size: 15.5px;
	line-height: 1.8;
	color: #334155;
	margin-bottom: 32px;
}
.fasilitas-content-body p {
	margin-bottom: 18px;
}
.fasilitas-content-body img {
	max-width: 100%;
	height: auto;
	border-radius: 12px;
	margin: 16px 0;
}

/* DEKORASI JUDUL "FASILITAS LAINNYA" (GARIS ORANYE SEPERTI REFERENSI) */
.other-section-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 20px;
}
.other-section-header h3.decorated-title {
	font-size: 18px;
	font-weight: 800;
	color: #0f172a;
	margin: 0;
	position: relative;
	padding-bottom: 8px;
}
.other-section-header h3.decorated-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 45px;
	height: 3px;
	background: #ff7a00;
	border-radius: 2px;
}

/* NAVIGASI PANAH SLIDER */
.other-nav-arrows {
	display: flex;
	gap: 8px;
}
.other-nav-btn {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	border: 1px solid #cbd5e1;
	background: #ffffff;
	color: #475569;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	transition: all 0.2s ease;
}
.other-nav-btn:hover {
	background: #0284c7;
	color: #ffffff;
	border-color: #0284c7;
}

/* CONTAINER SLIDER & TRACK FASILITAS LAINNYA */
.other-staf-slider {
	overflow: hidden;
	width: 100%;
}
.other-staf-track {
	display: flex;
	gap: 16px;
	transition: transform 0.3s ease;
}

/* CARD FASILITAS LAINNYA (2 CARD PER VIEW DI DESKTOP) */
.other-fasilitas-card {
	flex: 0 0 calc(50% - 8px);
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.other-fasilitas-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}
.other-fasilitas-img {
	width: 100%;
	aspect-ratio: 16 / 9;
	background: #f1f5f9;
	overflow: hidden;
}
.other-fasilitas-img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}
.other-fasilitas-card:hover .other-fasilitas-img img {
	transform: scale(1.05);
}
.other-fasilitas-body {
	padding: 18px;
	display: flex;
	flex-direction: column;
	flex: 1;
}
.other-fasilitas-body h4 {
	font-size: 16px;
	font-weight: 700;
	color: #0f172a;
	margin-bottom: 8px;
	line-height: 1.35;
}
.other-fasilitas-body p {
	font-size: 13px;
	color: #64748b;
	line-height: 1.55;
	margin-bottom: 14px;
	flex: 1;
}

@media (max-width: 640px) {
	.other-fasilitas-card {
		flex: 0 0 100%;
	}
}

/* STYLING WIDGET SIDEBAR KANAN GARIS ORANYE */
.widget-card-title {
	position: relative;
	padding-bottom: 8px;
}
.widget-card-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 45px;
	height: 3px;
	background: #ff7a00;
	border-radius: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('fasilitasTrack');
	const prevBtn = document.getElementById('fasilitasPrev');
	const nextBtn = document.getElementById('fasilitasNext');
	if (!track || !prevBtn || !nextBtn) return;

	let scrollPos = 0;

	function getStep() {
		const firstCard = track.querySelector('.other-fasilitas-card');
		if (!firstCard) return 250;
		return firstCard.offsetWidth + 16;
	}

	nextBtn.addEventListener('click', function() {
		const step = getStep();
		const maxScroll = track.scrollWidth - track.clientWidth;
		scrollPos = Math.min(scrollPos + step, maxScroll);
		track.style.transform = 'translateX(-' + scrollPos + 'px)';
	});

	prevBtn.addEventListener('click', function() {
		const step = getStep();
		scrollPos = Math.max(scrollPos - step, 0);
		track.style.transform = 'translateX(-' + scrollPos + 'px)';
	});
});
</script>

<?php get_footer(); ?>

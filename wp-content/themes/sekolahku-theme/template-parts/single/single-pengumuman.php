<?php
/**
 * Template single post - halaman detail khusus untuk Pengumuman.
 * Location: template-parts/single/single-pengumuman.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container page-content single-pengumuman-container" style="margin-bottom: 80px;">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id      = get_the_ID();
		$title        = get_the_title();
		$date_display = sekolahku_tanggal_indonesia( get_the_date( 'Y-m-d H:i:s' ) );
		?>

		<div class="staf-layout-grid">
			<!-- KONTEN UTAMA (KIRI) -->
			<div class="staf-main-column">
				<!-- JUDUL PENGUMUMAN -->
				<h1 class="staf-page-title"><?php echo esc_html( $title ); ?></h1>

				<!-- META TANGGAL -->
				<div class="pengumuman-meta-actions" style="margin-bottom: 24px;">
					<div class="pengumuman-date-info">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #64748b; margin-right: 8px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
						<span style="color: #475569; font-size: 15px; font-weight: 500;"><?php echo esc_html( $date_display ); ?></span>
					</div>
				</div>

				<!-- GAMBAR UTAMA (FEATURED IMAGE) -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-news-thumb" style="margin-bottom: 24px;">
						<?php the_post_thumbnail( 'large', array( 'class' => 'featured-img', 'style' => 'width:100%; height:auto; border-radius:12px;' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- DESKRIPSI KONTEN PENGUMUMAN -->
				<div class="single-news-content sekolahku-editor-content">
					<?php the_content(); ?>
				</div>

				<!-- TOMBOL BAGIKAN (SHARE BUTTONS) -->
				<div style="margin-top: 40px;">
					<?php get_template_part( 'template-parts/share-buttons' ); ?>
				</div>

				<!-- SECTION PENGUMUMAN LAINNYA -->
				<div class="staf-other-section" style="margin-top: 40px;">
					<div class="other-section-header">
						<h3 class="decorated-title">Pengumuman Lainnya</h3>
						<div class="other-nav-arrows">
							<button type="button" class="other-nav-btn" id="pengumumanPrev" aria-label="Sebelumnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<button type="button" class="other-nav-btn" id="pengumumanNext" aria-label="Selanjutnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						</div>
					</div>

					<div class="other-staf-slider">
						<div class="other-staf-track" id="pengumumanTrack">
							<?php
							$related_args  = array(
								'post_type'      => 'pengumuman',
								'posts_per_page' => 6,
								'post_status'    => 'publish',
								'post__not_in'   => array( $post_id ),
							);
							$related_query = new WP_Query( $related_args );

							if ( $related_query->have_posts() ) :
								while ( $related_query->have_posts() ) :
									$related_query->the_post();
									?>
									<article class="pengumuman-card-item">
										<a href="<?php the_permalink(); ?>" class="pengumuman-card-link">
											<h3 class="pengumuman-card-title"><?php the_title(); ?></h3>
											<div class="pengumuman-card-meta">
												<?php echo esc_html( sekolahku_tanggal_indonesia( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
											</div>
										</a>
									</article>
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
			<?php get_template_part( 'template-parts/sidebar' ); ?>
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
.staf-main-column {
	min-width: 0;
}
@media (max-width: 992px) {
	.staf-layout-grid {
		grid-template-columns: 1fr;
	}
}

/* JUDUL UTAMA PENGUMUMAN */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	margin-top: 0;
	line-height: 1.25;
	word-wrap: break-word;
	overflow-wrap: break-word;
}

/* Header Actions Date */
.pengumuman-meta-actions {
	display: flex;
	align-items: center;
	background: #f8fafc;
	padding: 12px 20px;
	border-radius: 8px;
	border: 1px solid #e2e8f0;
}
.pengumuman-date-info {
	display: flex;
	align-items: center;
}

/* DEKORASI JUDUL "PENGUMUMAN LAINNYA" (GARIS ORANYE) */
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
	background: var(--color-accent, #ff7a00);
	color: #ffffff;
	border-color: var(--color-accent, #ff7a00);
}

/* CONTAINER SLIDER & TRACK PENGUMUMAN LAINNYA */
.other-staf-slider {
	overflow: hidden;
	width: 100%;
}
.other-staf-track {
	display: flex;
	gap: 16px;
	transition: transform 0.3s ease;
}

/* KOTAK PENGUMUMAN LAINNYA */
.pengumuman-card-item {
	flex: 0 0 calc(50% - 8px);
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	transition: all 0.2s ease;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
	display: flex;
	flex-direction: column;
}
.pengumuman-card-item:hover {
	box-shadow: 0 8px 22px rgba(0,0,0,0.08);
	transform: translateY(-2px);
}
.pengumuman-card-link {
	display: flex;
	flex-direction: column;
	justify-content: center;
	padding: 16px;
	text-decoration: none;
	flex: 1;
}
.pengumuman-card-title {
	font-size: 14.5px;
	font-weight: 700;
	color: #0f172a;
	margin: 0 0 8px 0;
	line-height: 1.4;
	display: -webkit-box;
	-webkit-line-clamp: 3;
	line-clamp: 3;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
.pengumuman-card-link:hover .pengumuman-card-title {
	color: var(--color-link-hover, #ff7a00);
}
.pengumuman-card-meta {
	font-size: 12px;
	color: #64748b;
	margin-top: auto;
}

/* RESPONSIVE LAYOUT */
@media (max-width: 640px) {
	.pengumuman-card-item {
		flex: 0 0 100%;
	}
}

/* Base styles for content */
.single-news-content {
	font-size: 15.5px;
	line-height: 1.75;
	color: #334155;
	word-wrap: break-word;
	overflow-wrap: break-word;
}
.single-news-content p {
	margin-bottom: 20px;
}
.single-news-content img {
	max-width: 100%;
	height: auto;
	border-radius: 12px;
}

/* Bypass Cache: Force Typography */
.single-news-content strong,
.single-news-content b {
	font-weight: 900 !important;
	color: #000000 !important;
}
.single-news-content em,
.single-news-content i {
	font-style: italic !important;
}
.single-news-content ul {
	list-style-type: disc !important;
	padding-left: 2em !important;
	margin-top: 1.25em !important;
	margin-bottom: 1.25em !important;
}
.single-news-content ol {
	list-style-type: decimal !important;
	padding-left: 2em !important;
	margin-top: 1.25em !important;
	margin-bottom: 1.25em !important;
}
.single-news-content li {
	display: list-item !important;
	margin-top: 0.5em;
	margin-bottom: 0.5em;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('pengumumanTrack');
	const prevBtn = document.getElementById('pengumumanPrev');
	const nextBtn = document.getElementById('pengumumanNext');
	if (!track || !prevBtn || !nextBtn) return;

	let scrollPos = 0;

	function getStep() {
		const firstCard = track.querySelector('.pengumuman-card-item');
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

<?php
/**
 * Template Single Post - Halaman Detail Khusus untuk Program Keahlian.
 * Location: template-parts/single/single-program.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container page-content single-program-container" style="margin-bottom: 80px;">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id   = get_the_ID();
		$title     = get_the_title();
		$thumb_url = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80';
		?>

		<div class="staf-layout-grid">
			<!-- KONTEN UTAMA (KIRI) -->
			<div class="staf-main-column" style="min-width: 0;">
				<article class="single-program-article">
					<!-- JUDUL PROGRAM KEAHLIAN -->
					<h1 class="staf-page-title" style="margin-bottom: 24px; line-height: 1.3;">
						<?php echo esc_html( $title ); ?>
					</h1>

					<!-- GAMBAR UTAMA (HANYA DITAMPILKAN JIKA DITETAPKAN SEBAGAI FEATURED IMAGE) -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="program-detail-thumb" style="margin-bottom: 28px; border-radius: 14px; overflow: hidden; max-height: 320px; box-shadow: 0 4px 18px rgba(15,23,42,0.06);">
							<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; max-height: 320px; object-fit: cover; display: block;' ) ); ?>
						</div>
					<?php endif; ?>

					<!-- ISI DESKRIPSI KONTEN -->
					<div class="single-news-content sekolahku-editor-content" style="font-size: 16px; line-height: 1.8; margin-bottom: 36px;">
						<?php the_content(); ?>
					</div>

					<!-- TOMBOL BAGIKAN -->
					<?php get_template_part( 'template-parts/share-buttons' ); ?>

					<!-- SECTION PROGRAM LAINNYA -->
					<?php
					$other_programs = new WP_Query( array(
						'post_type'      => 'program',
						'post__not_in'   => array( $post_id ),
						'posts_per_page' => 6,
						'post_status'    => 'publish',
					) );

					if ( $other_programs->have_posts() ) :
						?>
						<div class="staf-other-section" style="margin-top: 44px; border-top: 1px solid #e2e8f0; padding-top: 36px;">
							<div class="other-section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
								<h3 class="decorated-title" style="font-size: 20px; font-weight: 800; margin: 0; position: relative; padding-bottom: 8px;">
									Program Lainnya
								</h3>
								<div class="other-nav-arrows" style="display: flex; gap: 8px;">
									<button type="button" class="other-nav-btn" id="programPrev" aria-label="Sebelumnya" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #cbd5e1; background: #ffffff; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #334155; transition: all 0.2s ease;">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
									</button>
									<button type="button" class="other-nav-btn" id="programNext" aria-label="Selanjutnya" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #cbd5e1; background: #ffffff; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #334155; transition: all 0.2s ease;">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
									</button>
								</div>
							</div>

							<div class="other-staf-slider" style="overflow: hidden;">
								<div class="other-staf-track" id="programTrack" style="display: flex; gap: 20px; transition: transform 0.3s ease;">
									<?php
									while ( $other_programs->have_posts() ) :
										$other_programs->the_post();
										$op_id    = get_the_ID();
										$op_thumb = has_post_thumbnail( $op_id ) ? get_the_post_thumbnail_url( $op_id, 'medium' ) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80';
										?>
										<div class="other-program-card" style="flex: 0 0 calc(50% - 10px); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 14px rgba(15,23,42,0.04); transition: transform 0.2s ease;">
											<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: block;">
												<div class="other-program-img" style="width: 100%; aspect-ratio: 16 / 10; overflow: hidden; background: #f1f5f9;">
													<img src="<?php echo esc_url( $op_thumb ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.3s ease;">
												</div>
												<div class="other-program-body" style="padding: 16px; text-align: center;">
													<h4 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.35;"><?php the_title(); ?></h4>
												</div>
											</a>
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</article>
			</div>

			<!-- SIDEBAR GLOBAL (KANAN) -->
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
.other-nav-btn:hover {
	background: var(--color-accent, #ff7a00) !important;
	color: #ffffff !important;
	border-color: var(--color-accent, #ff7a00) !important;
}
.other-program-card:hover {
	transform: translateY(-3px);
	box-shadow: 0 8px 22px rgba(15, 23, 42, 0.08) !important;
}
.other-program-card:hover h4 {
	color: var(--color-accent, #ff7a00) !important;
}
@media (max-width: 992px) {
	.staf-layout-grid {
		grid-template-columns: 1fr;
	}
}
@media (max-width: 640px) {
	.other-program-card {
		flex: 0 0 100% !important;
	}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var track = document.getElementById('programTrack');
	var prevBtn = document.getElementById('programPrev');
	var nextBtn = document.getElementById('programNext');
	if (!track || !prevBtn || !nextBtn) return;

	var currentIndex = 0;
	var cards = track.querySelectorAll('.other-program-card');
	var totalCards = cards.length;

	function getCardsPerPage() {
		return window.innerWidth <= 640 ? 1 : 2;
	}

	function updateSlider() {
		var perPage = getCardsPerPage();
		var maxIndex = Math.max(0, totalCards - perPage);
		if (currentIndex < 0) currentIndex = 0;
		if (currentIndex > maxIndex) currentIndex = maxIndex;

		var cardWidth = cards[0] ? cards[0].offsetWidth + 20 : 0;
		track.style.transform = 'translateX(-' + (currentIndex * cardWidth) + 'px)';
	}

	prevBtn.addEventListener('click', function() {
		if (currentIndex > 0) {
			currentIndex--;
			updateSlider();
		}
	});

	nextBtn.addEventListener('click', function() {
		var perPage = getCardsPerPage();
		if (currentIndex < totalCards - perPage) {
			currentIndex++;
			updateSlider();
		}
	});

	window.addEventListener('resize', updateSlider);
});
</script>

<?php
get_footer();

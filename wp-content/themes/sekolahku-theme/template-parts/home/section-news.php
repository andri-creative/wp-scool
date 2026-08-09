<?php
/** Section Berita & Artikel - Redesain 4 Card per Row & Slider Step-by-step. */
if (!defined('ABSPATH')) {
	exit;
}

$eyebrow = get_theme_mod('sekolahku_berita_eyebrow', 'NEWS SECTION');
$title = get_theme_mod('sekolahku_berita_title', 'Berita & Artikel');
$subtitle = get_theme_mod('sekolahku_berita_subtitle', 'Berita dan artikel sekolah kami mencakup informasi terkini dan terbaru tentang sekolah kami.');
$archive_link = get_permalink(get_option('page_for_posts'));
if (!$archive_link) {
	$archive_link = home_url('/berita/');
}
?>

<!-- BERITA & ARTIKEL SECTION (Latar Belakang Putih) -->
<section class="section news-section">
	<div class="container">
		<!-- HEADER ROW FLEX (Kiri: Teks & Garis Aksen, Kanan: Tombol & Panah Navigasi) -->
		<div class="news-header-flex">
			<div class="news-header-left">
				<?php if ($eyebrow): ?>
					<span class="eyebrow"><?php echo esc_html($eyebrow); ?></span>
				<?php endif; ?>
				<?php if ($title): ?>
					<h2 class="news-title"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($subtitle): ?>
					<p class="news-subtitle"><?php echo esc_html($subtitle); ?></p>
				<?php endif; ?>
			</div>

			<div class="news-header-right">
				<a href="<?php echo esc_url($archive_link); ?>" class="btn btn-see-all">
					<span>Lihat Semua</span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</a>

				<div class="news-nav-arrows">
					<button type="button" class="news-nav-btn news-prev" id="newsPrev" aria-label="Berita Sebelumnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
					</button>
					<button type="button" class="news-nav-btn news-next" id="newsNext" aria-label="Berita Selanjutnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</button>
				</div>
			</div>
		</div>

		<!-- SLIDER TRACK CONTAINER (4 Cards Per View) -->
		<div class="news-slider-wrapper">
			<div class="news-slider-track" id="newsTrack">
				<?php
				$news_query = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => 12,
					'post_status' => 'publish',
				));

				if ($news_query->have_posts()):
					while ($news_query->have_posts()):
						$news_query->the_post();
						$categories = get_the_category();
						$cat_name = !empty($categories) ? $categories[0]->name : 'Berita';
						?>
						<?php
						$img_src = '';
						if ( has_post_thumbnail() ) {
							$img_src = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
						}
						if ( empty( $img_src ) ) {
							$content = get_the_content();
							if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches ) ) {
								$img_src = sekolahku_make_url_dynamic( $matches[1] );
							}
						}
						if ( empty( $img_src ) ) {
							$img_src = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=600&q=80';
						}
						?>
						<div class="card news-card">
							<a href="<?php the_permalink(); ?>" class="news-card-inner">
								<div class="news-thumb">
									<img src="<?php echo esc_url( $img_src ); ?>" alt="<?php the_title_attribute(); ?>" class="news-img">
								</div>
								<div class="news-body">
									<span class="news-cat-badge"><?php echo esc_html($cat_name); ?></span>
									<h3 class="news-card-title"><?php the_title(); ?></h3>
									<span class="news-date"><?php echo esc_html(sekolahku_format_indo_date(get_the_date('Y-m-d H:i:s'))); ?></span>
								</div>
							</a>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				else:
					?>
					<div class="no-news-box" style="width: 100%; text-align: center; padding: 30px; background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 12px; color: #94a3b8;">
						<p style="margin: 0; font-size: 14px;">Belum ada berita terbaru yang dipublikasikan.</p>
					</div>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('newsTrack');
	const prevBtn = document.getElementById('newsPrev');
	const nextBtn = document.getElementById('newsNext');

	if (!track) return;

	let autoplayTimer = null;
	const pauseDuration = 3000; // Jeda 3 detik per kartu
	let isAnimating = false;

	function slideNext() {
		if (isAnimating) return;
		const firstCard = track.children[0];
		if (!firstCard) return;

		isAnimating = true;
		const cardWidth = firstCard.offsetWidth + 24; // Width + gap 24px

		track.style.transition = 'transform 0.5s ease-in-out';
		track.style.transform = 'translateX(-' + cardWidth + 'px)';

		setTimeout(function() {
			track.style.transition = 'none';
			track.appendChild(firstCard);
			track.style.transform = 'translateX(0)';
			isAnimating = false;
		}, 500);
	}

	function slidePrev() {
		if (isAnimating) return;
		const lastCard = track.children[track.children.length - 1];
		if (!lastCard) return;

		isAnimating = true;
		const cardWidth = lastCard.offsetWidth + 24;

		track.style.transition = 'none';
		track.insertBefore(lastCard, track.children[0]);
		track.style.transform = 'translateX(-' + cardWidth + 'px)';

		setTimeout(function() {
			track.style.transition = 'transform 0.5s ease-in-out';
			track.style.transform = 'translateX(0)';
			setTimeout(function() {
				isAnimating = false;
			}, 500);
		}, 20);
	}

	function startAutoplay() {
		stopAutoplay();
		autoplayTimer = setInterval(slideNext, pauseDuration);
	}

	function stopAutoplay() {
		if (autoplayTimer) {
			clearInterval(autoplayTimer);
			autoplayTimer = null;
		}
	}

	if (nextBtn) {
		nextBtn.addEventListener('click', function() {
			stopAutoplay();
			slideNext();
			startAutoplay();
		});
	}

	if (prevBtn) {
		prevBtn.addEventListener('click', function() {
			stopAutoplay();
			slidePrev();
			startAutoplay();
		});
	}

	track.addEventListener('mouseenter', stopAutoplay);
	track.addEventListener('mouseleave', startAutoplay);
	track.addEventListener('touchstart', stopAutoplay, { passive: true });
	track.addEventListener('touchend', startAutoplay, { passive: true });

	startAutoplay();
});
</script>

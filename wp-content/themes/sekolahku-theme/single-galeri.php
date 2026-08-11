<?php

/**
 * Template Single Galeri (Detail Foto & Video) - Presisi Sesuai Referensi.
 *
 * @package SekolahKu
 */
if (!defined('ABSPATH')) {
	exit;
}

get_header();
get_template_part('template-parts/breadcrumb');
?>

<div class="container page-content single-galeri-container" style="margin-bottom: 80px;">
	<?php
	while (have_posts()):
		the_post();
		$post_id = get_the_ID();
		$title = get_the_title();
		$permalink = get_permalink();

		// Ekstrak Seluruh Foto (Featured Image + foto dari post content editor)
		$gallery_images = array();

		// 1. Featured Image
		if (has_post_thumbnail($post_id)) {
			$featured_url = get_the_post_thumbnail_url($post_id, 'full');
			if ($featured_url) {
				$gallery_images[] = $featured_url;
			}
		}

		// 2. Extract <img> tags dari post content
		$content = get_the_content();
		if (!empty($content)) {
			preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $content, $img_matches);
			if (!empty($img_matches[1])) {
				foreach ($img_matches[1] as $img_src) {
					$clean_url = sekolahku_make_url_dynamic($img_src);
					if (!in_array($clean_url, $gallery_images)) {
						$gallery_images[] = $clean_url;
					}
				}
			}
		}

		// 3. Jika tidak ada gambar, gunakan thumbnail galeri post
		if (empty($gallery_images)) {
			$gallery_images[] = sekolahku_get_galeri_thumb($post_id);
		}
		// 4. Deteksi Video Embed (YouTube, Vimeo, iframe)
		$video_embed_code = '';
		if (!empty($content)) {
			if (preg_match('/<iframe[^>]+src=[\'"]([^\'"]+)[\'"][^>]*><\/iframe>/i', $content, $v_matches)) {
				$video_embed_code = $v_matches[0];
			} elseif (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $content, $yt_matches)) {
				$video_embed_code = '<iframe width="100%" height="450" src="https://www.youtube.com/embed/' . esc_attr($yt_matches[1]) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; border-radius:16px;"></iframe>';
			}
		}
		?>

		<div class="staf-layout-grid">
			<!-- MAIN CONTENT (KIRI) -->
			<div class="staf-main-column" style="min-width: 0;">
				<article class="single-galeri-article">
					<!-- JUDUL GALERI -->
					<h1 class="staf-page-title" style="margin-bottom: 24px; line-height: 1.3;">
						<?php echo esc_html($title); ?>
					</h1>

					<!-- PEMUTAR VIDEO (JIKA ADA DOKUMENTASI VIDEO) -->
					<?php if (!empty($video_embed_code)): ?>
						<div class="galeri-video-stage" style="margin-bottom: 24px; border-radius: 16px; overflow: hidden; box-shadow: 0 6px 20px rgba(15,23,42,0.08);">
							<?php echo $video_embed_code; ?>
						</div>
					<?php endif; ?>

					<!-- SHOWCASE FOTO UTAMA (STAGE WITH NAV ARROWS) -->
					<div class="galeri-main-stage">
						<img id="galeriMainImg" src="<?php echo esc_url($gallery_images[0]); ?>" alt="<?php echo esc_attr($title); ?>">
						
						<?php if (count($gallery_images) > 1): ?>
							<button type="button" id="galeriStagePrev" class="galeri-stage-nav nav-prev" aria-label="Foto Sebelumnya">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<button type="button" id="galeriStageNext" class="galeri-stage-nav nav-next" aria-label="Foto Selanjutnya">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						<?php endif; ?>
					</div>

					<!-- STRIP GRID THUMBNAIL FOTO -->
					<?php if (count($gallery_images) > 1): ?>
						<div class="galeri-thumb-strip">
							<?php foreach ($gallery_images as $idx => $img_url): ?>
								<div class="galeri-thumb-item <?php echo 0 === $idx ? 'active' : ''; ?>" data-index="<?php echo esc_attr($idx); ?>" data-src="<?php echo esc_url($img_url); ?>">
									<img src="<?php echo esc_url($img_url); ?>" alt="Foto Thumbnail <?php echo esc_attr($idx + 1); ?>">
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<!-- DESKRIPSI KONTEN GALERI -->
					<div class="single-news-content sekolahku-editor-content" style="margin-top: 28px; line-height: 1.7; color: #334155;">
						<?php
						$content_clean = preg_replace('/<img[^>]+>/i', '', get_the_content());
						if (!empty(trim(strip_tags($content_clean)))) {
							echo apply_filters('the_content', $content_clean);
						} else {
							echo '<p>Dokumentasi foto dan video kegiatan ' . esc_html($title) . ' yang berlangsung di lingkungan sekolah.</p>';
						}
						?>
					</div>

					<!-- TOMBOL BAGIKAN (SHARE BUTTONS) -->
					<div style="margin-top: 40px;">
						<?php get_template_part('template-parts/share-buttons'); ?>
					</div>

					<!-- SECTION GALERI LAINNYA (SLIDER TRACK 2 CARD) -->
					<?php
					$other_galeri = new WP_Query(array(
						'post_type' => 'galeri',
						'posts_per_page' => 6,
						'post__not_in' => array($post_id),
						'post_status' => 'publish',
					));

					if ($other_galeri->have_posts()):
						?>
						<div class="staf-other-section" style="margin-top: 44px; border-top: 1px solid #e2e8f0; padding-top: 36px;">
							<div class="other-section-header">
								<h3 class="decorated-title">Galeri Lainnya</h3>
								<div class="other-nav-arrows">
									<button type="button" class="other-nav-btn" id="galeriOtherPrev" aria-label="Sebelumnya">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
									</button>
									<button type="button" class="other-nav-btn" id="galeriOtherNext" aria-label="Selanjutnya">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
									</button>
								</div>
							</div>

							<div class="other-staf-slider">
								<div class="other-staf-track" id="galeriOtherTrack">
									<?php
									while ($other_galeri->have_posts()):
										$other_galeri->the_post();
										$o_id = get_the_ID();
										$o_thumb = sekolahku_get_galeri_thumb($o_id);
										$o_badge = sekolahku_get_galeri_badge($o_id);
										?>
										<div class="other-staf-card galeri-other-card-item">
											<a href="<?php the_permalink(); ?>" class="galeri-card-link">
												<div class="galeri-card-thumb">
													<img src="<?php echo esc_url($o_thumb); ?>" alt="<?php the_title_attribute(); ?>">
													<span class="galeri-badge-count">
														<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
														1
													</span>
												</div>
												<div class="galeri-card-body">
													<h3 class="galeri-card-title"><?php the_title(); ?></h3>
												</div>
											</a>
										</div>
									<?php endwhile;
									wp_reset_postdata(); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</article>
			</div>

			<!-- REUSABLE SIDEBAR (KANAN) -->
			<?php get_template_part('template-parts/sidebar'); ?>
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

/* STAGE FOTO UTAMA */
.galeri-main-stage {
	position: relative;
	width: 100%;
	max-height: 420px;
	aspect-ratio: 16 / 9;
	background: #0f172a;
	border-radius: 14px;
	overflow: hidden;
	box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
}
.galeri-main-stage img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: opacity 0.3s ease;
}

/* NAV ARROWS ON MAIN STAGE */
.galeri-stage-nav {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	width: 44px;
	height: 44px;
	background: rgba(15, 23, 42, 0.45);
	backdrop-filter: blur(4px);
	color: #ffffff;
	border: 1px solid rgba(255, 255, 255, 0.2);
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	transition: all 0.2s ease;
	z-index: 10;
}
.galeri-stage-nav:hover {
	background: rgba(15, 23, 42, 0.85);
	transform: translateY(-50%) scale(1.08);
}
.galeri-stage-nav.nav-prev { left: 16px; }
.galeri-stage-nav.nav-next { right: 16px; }

/* STRIP THUMBNAIL FOTO */
.galeri-thumb-strip {
	display: grid;
	grid-template-columns: repeat(5, 1fr);
	gap: 14px;
	margin-top: 16px;
}
.galeri-thumb-item {
	position: relative;
	aspect-ratio: 16 / 10;
	border-radius: 10px;
	overflow: hidden;
	background: #e2e8f0;
	cursor: pointer;
	border: 2px solid transparent;
	opacity: 0.65;
	transition: all 0.2s ease;
}
.galeri-thumb-item:hover {
	opacity: 1;
	transform: translateY(-2px);
}
.galeri-thumb-item.active {
	opacity: 1;
	border-color: var(--color-primary, #0284c7);
	box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
}
.galeri-thumb-item img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}

/* SLIDER GALERI LAINNYA */
.staf-other-section .other-section-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 20px;
}
.decorated-title {
	font-size: 20px;
	font-weight: 800;
	color: #0f172a;
	margin: 0;
	position: relative;
	padding-bottom: 6px;
}
.decorated-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 40px;
	height: 3px;
	background: var(--color-accent, #ff7a00);
	border-radius: 2px;
}
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
	display: inline-flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	transition: all 0.2s ease;
}
.other-nav-btn:hover {
	background: var(--color-primary, #0284c7);
	color: #ffffff;
	border-color: var(--color-primary, #0284c7);
}

.other-staf-slider {
	overflow: hidden;
	width: 100%;
}
.other-staf-track {
	display: flex;
	gap: 20px;
	transition: transform 0.3s ease;
}
.galeri-other-card-item {
	flex: 0 0 calc(50% - 10px);
	min-width: calc(50% - 10px);
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	box-shadow: 0 4px 14px rgba(15,23,42,0.04);
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.galeri-other-card-item:hover {
	transform: translateY(-3px);
	box-shadow: 0 8px 22px rgba(15,23,42,0.08);
}
.galeri-other-card-item .galeri-card-thumb {
	position: relative;
	width: 100%;
	aspect-ratio: 16 / 10;
	background: #f1f5f9;
	overflow: hidden;
}
.galeri-other-card-item .galeri-card-thumb img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.3s ease;
}
.galeri-other-card-item:hover .galeri-card-thumb img {
	transform: scale(1.05);
}
.galeri-other-card-item .galeri-badge-count {
	position: absolute;
	left: 10px;
	bottom: 10px;
	background: rgba(15,23,42,0.65);
	backdrop-filter: blur(4px);
	color: #ffffff;
	font-size: 11px;
	font-weight: 700;
	padding: 3px 8px;
	border-radius: 6px;
	display: inline-flex;
	align-items: center;
	gap: 4px;
}
.galeri-other-card-item .galeri-card-body {
	padding: 16px 14px;
	text-align: center;
}
.galeri-other-card-item .galeri-card-title {
	font-size: 14.5px;
	font-weight: 700;
	color: #0f172a;
	margin: 0;
	line-height: 1.35;
	transition: color 0.2s ease;
}
.galeri-other-card-item:hover .galeri-card-title {
	color: var(--color-link-hover, #ff7a00);
}

@media (max-width: 640px) {
	.galeri-thumb-strip {
		grid-template-columns: repeat(3, 1fr);
	}
	.galeri-other-card-item {
		flex: 0 0 100%;
		min-width: 100%;
	}
}
</style>

<!-- SCRIPT SWITCHER FOTO & SLIDER TRACK -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	var images = <?php echo json_encode(isset($gallery_images) ? $gallery_images : array()); ?>;
	var currentIndex = 0;
	var mainImg = document.getElementById('galeriMainImg');
	var prevBtn = document.getElementById('galeriStagePrev');
	var nextBtn = document.getElementById('galeriStageNext');
	var thumbItems = document.querySelectorAll('.galeri-thumb-item');

	function updateStage(index) {
		if (!images || images.length === 0) return;
		if (index < 0) index = images.length - 1;
		if (index >= images.length) index = 0;
		
		currentIndex = index;
		if (mainImg) {
			mainImg.style.opacity = '0.4';
			setTimeout(function() {
				mainImg.src = images[currentIndex];
				mainImg.style.opacity = '1';
			}, 150);
		}
		
		thumbItems.forEach(function(item, idx) {
			if (idx === currentIndex) {
				item.classList.add('active');
			} else {
				item.classList.remove('active');
			}
		});
	}

	if (prevBtn) {
		prevBtn.addEventListener('click', function() {
			updateStage(currentIndex - 1);
		});
	}
	if (nextBtn) {
		nextBtn.addEventListener('click', function() {
			updateStage(currentIndex + 1);
		});
	}

	thumbItems.forEach(function(item) {
		item.addEventListener('click', function() {
			var idx = parseInt(this.getAttribute('data-index'));
			updateStage(idx);
		});
	});

	// SLIDER TRACK FOR GALERI LAINNYA
	var track = document.getElementById('galeriOtherTrack');
	var otherPrev = document.getElementById('galeriOtherPrev');
	var otherNext = document.getElementById('galeriOtherNext');
	if (track && (otherPrev || otherNext)) {
		var scrollPos = 0;
		function getStep() {
			var card = track.querySelector('.galeri-other-card-item');
			return card ? (card.offsetWidth + 20) : 300;
		}
		function getMaxScroll() {
			return track.scrollWidth - track.clientWidth;
		}
		if (otherNext) {
			otherNext.addEventListener('click', function() {
				var step = getStep();
				var max = getMaxScroll();
				scrollPos = Math.min(scrollPos + step, max);
				track.style.transform = 'translateX(-' + scrollPos + 'px)';
			});
		}
		if (otherPrev) {
			otherPrev.addEventListener('click', function() {
				var step = getStep();
				scrollPos = Math.max(scrollPos - step, 0);
				track.style.transform = 'translateX(-' + scrollPos + 'px)';
			});
		}
	}
});
</script>

<?php get_footer(); ?>

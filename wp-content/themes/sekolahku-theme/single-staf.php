<?php
/** Template Single Staf & Guru - Redesain Presisi Sesuai Referensi. */
if (!defined('ABSPATH')) {
	exit;
}
get_header();
?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div class="container single-staf-container">
	<?php
	while (have_posts()):
		the_post();
		$post_id = get_the_ID();
		$title = get_the_title();
		$permalink = get_permalink();

		$staf_role = get_post_meta($post_id, '_staf_role', true);
		$staf_status = get_post_meta($post_id, '_staf_status', true);
		$staf_nip = get_post_meta($post_id, '_staf_nip', true);
		$staf_nuptk = get_post_meta($post_id, '_staf_nuptk', true);
		$staf_aktif = get_post_meta($post_id, '_staf_aktif', true);
		$staf_gender = get_post_meta($post_id, '_staf_gender', true);
		$staf_ttl = get_post_meta($post_id, '_staf_ttl', true);
		$staf_agama = get_post_meta($post_id, '_staf_agama', true);
		$staf_alamat = get_post_meta($post_id, '_staf_alamat', true);
		$staf_kontak = get_post_meta($post_id, '_staf_kontak', true);

		$raw_post_content = get_the_content();
		$plain_text = wp_strip_all_tags($raw_post_content);

		// Smart Parser: Ekstrak data bersih dari plain text tanpa karakter HTML (>NIP, >Status)
		if (empty($staf_role) && preg_match('/Jabatan\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_role = trim($m[1]);
		}
		if (empty($staf_status) && preg_match('/Status\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_status = trim($m[1]);
		}
		if (empty($staf_nip) && preg_match('/NIP\s*[:\-]?\s*([0-9\s]+)/i', $plain_text, $m)) {
			$staf_nip = trim($m[1]);
		}
		if (empty($staf_nuptk) && preg_match('/NUPTK\s*[:\-]?\s*([0-9\s]+)/i', $plain_text, $m)) {
			$staf_nuptk = trim($m[1]);
		}
		if (empty($staf_aktif) && preg_match('/Aktif\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_aktif = trim($m[1]);
		}
		if (empty($staf_gender) && preg_match('/Gender\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_gender = trim($m[1]);
		}
		if (empty($staf_ttl) && preg_match('/(Tempat,?\s*Tanggal\s*Lahir|TTL)\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_ttl = trim($m[1]);
		}
		if (empty($staf_agama) && preg_match('/Agama\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_agama = trim($m[1]);
		}
		if (empty($staf_alamat) && preg_match('/Alamat\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_alamat = trim($m[1]);
		}
		if (empty($staf_kontak) && preg_match('/(Kontak|HP|Telepon)\s*[:\-]?\s*([^\n\r]+)/i', $plain_text, $m)) {
			$staf_kontak = trim($m[1]);
		}

		// Default fallback
		if (empty($staf_role))
			$staf_role = 'Tenaga Pendidik';
		if (empty($staf_status))
			$staf_status = '-';
		if (empty($staf_nip))
			$staf_nip = '-';
		if (empty($staf_nuptk))
			$staf_nuptk = '-';
		if (empty($staf_aktif))
			$staf_aktif = '-';
		if (empty($staf_gender))
			$staf_gender = '-';
		if (empty($staf_ttl))
			$staf_ttl = '-';
		if (empty($staf_agama))
			$staf_agama = '-';
		if (empty($staf_alamat))
			$staf_alamat = '-';
		if (empty($staf_kontak))
			$staf_kontak = '-';

		$avatar_url = sekolahku_get_staf_avatar($post_id);
		?>

		<h1 class="staf-page-title"><?php echo esc_html($title); ?></h1>

		<div class="staf-layout-grid">
			<!-- KONTEN UTAMA (KIRI) -->
			<div class="staf-main-column">
				<!-- CARD PROFIL GURU (Foto & Grid Info) -->
				<div class="staf-profile-card">
					<div class="staf-photo-wrapper">
						<img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($title); ?>" class="staf-profile-photo">
					</div>

					<div class="staf-details-grid">
						<div class="staf-info-item">
							<span class="info-label">Jabatan</span>
							<strong class="info-value"><?php echo esc_html($staf_role); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Status</span>
							<strong class="info-value"><?php echo esc_html($staf_status); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">NIP</span>
							<strong class="info-value"><?php echo esc_html($staf_nip); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">NUPTK</span>
							<strong class="info-value"><?php echo esc_html($staf_nuptk); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Aktif</span>
							<strong class="info-value"><?php echo esc_html($staf_aktif); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Gender</span>
							<strong class="info-value"><?php echo esc_html($staf_gender); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Tempat, Tanggal Lahir</span>
							<strong class="info-value"><?php echo esc_html($staf_ttl); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Agama</span>
							<strong class="info-value"><?php echo esc_html($staf_agama); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Alamat</span>
							<strong class="info-value"><?php echo esc_html($staf_alamat); ?></strong>
						</div>
						<div class="staf-info-item">
							<span class="info-label">Kontak</span>
							<strong class="info-value"><?php echo esc_html($staf_kontak); ?></strong>
						</div>
					</div>
				</div>

				<!-- DESKRIPSI PROFIL / KONTEN UTAMA -->
				<div class="staf-content-body">
					<?php
					$clean_content = get_the_content();
					// 1. Hapus tag <img> dari post content (mencegah foto double)
					$clean_content = preg_replace('/<img[^>]+>/i', '', $clean_content);
					// 2. Hapus seluruh blok <ul>...</ul> dan <ol>...</ol> (mencegah list metadata tercetak di bawah)
					$clean_content = preg_replace('/<ul[^>]*>.*?<\/ul>/is', '', $clean_content);
					$clean_content = preg_replace('/<ol[^>]*>.*?<\/ol>/is', '', $clean_content);
					$clean_content = apply_filters('the_content', $clean_content);
					if (trim(strip_tags($clean_content))):
						echo $clean_content;
					else:
						?>
						<p><?php echo esc_html($title); ?> merupakan guru <?php echo esc_html($staf_role); ?> yang aktif dalam dunia pendidikan dan pengembangan potensi siswa. Berdedikasi tinggi dalam menciptakan pembelajaran yang kreatif, inovatif, dan kondusif bagi peserta didik.</p>
					<?php endif; ?>
				</div>

				<!-- TOMBOL BAGIKAN (SHARE REUSABLE COMPONENT) -->
				<?php get_template_part('template-parts/share-buttons'); ?>

				<!-- STAF & GURU LAINNYA (SLIDER/GRID) -->
				<div class="staf-other-section">
					<div class="other-section-header">
						<h3>Staf & Guru Lainnya</h3>
						<div class="other-nav-arrows">
							<button type="button" class="other-nav-btn other-prev" id="otherStafPrev" aria-label="Sebelumnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<button type="button" class="other-nav-btn other-next" id="otherStafNext" aria-label="Selanjutnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						</div>
					</div>

					<div class="other-staf-slider">
						<div class="other-staf-track" id="otherStafTrack">
							<?php
							$other_query = new WP_Query(array(
								'post_type' => 'staf',
								'post__not_in' => array($post_id),
								'posts_per_page' => 8,
							));

							if ($other_query->have_posts()):
								while ($other_query->have_posts()):
									$other_query->the_post();
									$o_id = get_the_ID();
									$o_role = get_post_meta($o_id, '_staf_role', true);
									if (!$o_role)
										$o_role = 'Tenaga Pendidik';
									?>
									<div class="other-staf-card">
										<a href="<?php the_permalink(); ?>">
											<div class="other-staf-img">
												<img src="<?php echo esc_url(sekolahku_get_staf_avatar($o_id)); ?>" alt="<?php the_title_attribute(); ?>">
											</div>
											<h4><?php the_title(); ?></h4>
											<p><?php echo esc_html($o_role); ?></p>
										</a>
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

		<?php
	endwhile;
	?>
</div>

<!-- INLINE STYLES FOR SINGLE STAF PAGE PRECISE MATCH -->
<style>

.single-staf-container {
	margin-bottom: 60px;
}
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}
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

/* PROFIL CARD (KIRI) */
.staf-profile-card {
	display: grid;
	grid-template-columns: 280px 1fr;
	gap: 28px;
	margin-bottom: 28px;
	align-items: start;
}
@media (max-width: 680px) {
	.staf-profile-card {
		grid-template-columns: 1fr;
	}
}
.staf-photo-wrapper {
	width: 100%;
	border-radius: 14px;
	overflow: hidden;
	background: #f1f5f9;
	box-shadow: 0 4px 15px rgba(0,0,0,0.06);
	aspect-ratio: 3 / 4;
}
.staf-profile-photo {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}

/* DETAILS GRID (2 KOLOM PAIR KEY-VALUE) */
.staf-details-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 18px 24px;
}
@media (max-width: 480px) {
	.staf-details-grid {
		grid-template-columns: 1fr;
	}
}
.staf-info-item {
	display: flex;
	flex-direction: column;
	gap: 3px;
}
.info-label {
	font-size: 12.5px;
	color: #64748b;
	font-weight: 500;
}
.info-value {
	font-size: 14px;
	color: #0f172a;
	font-weight: 700;
	word-break: break-word;
}

/* DESKRIPSI UTAMA */
.staf-content-body {
	font-size: 15px;
	line-height: 1.75;
	color: #334155;
	margin-bottom: 32px;
	padding-top: 0;
	border-top: none;
}
.staf-content-body img {
	display: none !important;
}

/* BAGIKAN SHARE BAR */
.staf-share-bar {
	display: flex;
	align-items: center;
	gap: 14px;
	padding: 16px 0;
	border-top: 1px solid #f1f5f9;
	border-bottom: 1px solid #f1f5f9;
	margin-bottom: 36px;
}
.share-title {
	font-weight: 700;
	font-size: 14px;
	color: #0f172a;
}
.share-buttons {
	display: flex;
	align-items: center;
	gap: 8px;
}
.share-btn {
	width: 32px;
	height: 32px;
	border-radius: 6px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	color: #ffffff;
	transition: transform 0.2s, opacity 0.2s;
	text-decoration: none;
}
.share-btn:hover {
	transform: translateY(-2px);
	opacity: 0.9;
}
.share-fb { background: #1877f2; }
.share-x  { background: #14171a; }
.share-wa { background: #25d366; }
.share-pin{ background: #e60023; }
.share-th { background: #000000; }

/* STAF & GURU LAINNYA */
.staf-other-section {
	margin-top: 24px;
}
.other-section-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 16px;
}
.other-section-header h3 {
	font-size: 18px;
	font-weight: 800;
	color: #0f172a;
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
	display: flex;
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
	gap: 16px;
	transition: transform 0.3s ease;
}

/* Default Desktop: 3 Cards Besar */
.other-staf-card {
	flex: 0 0 calc(33.333% - 11px);
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	overflow: hidden;
	text-align: center;
	padding: 12px;
	transition: transform 0.2s, box-shadow 0.2s;
}
.other-staf-card:hover {
	transform: translateY(-3px);
	box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
.other-staf-card a {
	text-decoration: none;
	color: inherit;
	display: block;
}
.other-staf-img {
	width: 100%;
	aspect-ratio: 4 / 5;
	border-radius: 10px;
	overflow: hidden;
	margin-bottom: 10px;
	background: #f1f5f9;
}
.other-staf-img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}
.other-staf-card h4 {
	font-size: 14px;
	font-weight: 700;
	color: #0f172a;
	margin-bottom: 3px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.other-staf-card p {
	font-size: 12px;
	color: #64748b;
	margin: 0;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

/* Tablet & HP Mode (< 1024px): 2 Cards Besar */
@media (max-width: 1024px) {
	.other-staf-track {
		gap: 12px;
	}
	.other-staf-card {
		flex: 0 0 calc(50% - 6px);
		padding: 12px;
	}
	.other-staf-img {
		aspect-ratio: 4 / 5;
	}
	.other-staf-card h4 {
		font-size: 14px;
	}
	.other-staf-card p {
		font-size: 12px;
	}
}

/* SIDEBAR BERITA TERBARU (CARD STACK REVISED) */
.sidebar-news-header {
	margin-bottom: 16px;
}
.sidebar-news-header .widget-card-title {
	font-size: 18px;
	font-weight: 800;
	color: #0f172a;
	margin: 0;
	position: relative;
	padding-bottom: 10px;
}
.sidebar-news-header .widget-card-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 50px;
	height: 3px;
	background: #ff7a00;
	border-radius: 2px;
}
.recent-news-stack {
	display: flex;
	flex-direction: column;
	gap: 16px;
}
.recent-news-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	overflow: hidden;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.recent-news-card-item:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
}
.news-card-thumb {
	width: 100%;
	height: 160px;
	overflow: hidden;
	background: #f1f5f9;
}
.news-thumb-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform 0.3s ease;
}
.recent-news-card-item:hover .news-thumb-img {
	transform: scale(1.05);
}
.news-card-body {
	padding: 16px;
}
.news-cat-badge {
	display: inline-block;
	background: #fff7ed;
	color: #ea580c;
	border: 1px solid #ffedd5;
	font-size: 11px;
	font-weight: 700;
	padding: 3px 8px;
	border-radius: 4px;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-bottom: 6px;
}
.news-item-title {
	font-size: 14.5px;
	font-weight: 700;
	line-height: 1.4;
	margin: 0 0 8px 0;
}
.news-item-title a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s ease;
}
.news-item-title a:hover {
	color: #ff7a00;
}
.news-item-excerpt {
	font-size: 12.5px;
	color: #64748b;
	line-height: 1.45;
	margin: 4px 0 8px 0;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
.news-item-date {
	font-size: 11.5px;
	color: #94a3b8;
	display: block;
}
.no-news-box {
	background: #ffffff;
	border: 1px dashed #cbd5e1;
	border-radius: 10px;
	padding: 16px;
	text-align: center;
	color: #94a3b8;
	font-size: 13px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('otherStafTrack');
	const prevBtn = document.getElementById('otherStafPrev');
	const nextBtn = document.getElementById('otherStafNext');
	if (!track || !prevBtn || !nextBtn) return;

	let scrollPos = 0;

	function getStep() {
		const firstCard = track.querySelector('.other-staf-card');
		if (!firstCard) return 200;
		return firstCard.offsetWidth + 12;
	}

	nextBtn.addEventListener('click', function() {
		const step = getStep();
		const maxScroll = track.scrollWidth - track.clientWidth;
		scrollPos = Math.min(scrollPos + step * 2, maxScroll);
		track.style.transform = 'translateX(-' + scrollPos + 'px)';
	});

	prevBtn.addEventListener('click', function() {
		const step = getStep();
		scrollPos = Math.max(scrollPos - step * 2, 0);
		track.style.transform = 'translateX(-' + scrollPos + 'px)';
	});
});
</script>

<?php get_footer(); ?>

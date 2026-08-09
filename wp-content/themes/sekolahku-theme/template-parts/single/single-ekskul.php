<?php
/**
 * Template Single Ekstrakurikuler - Halaman Detail Profil Kegiatan Ekskul (100% Presisi Referensi Zekolla).
 * Location: template-parts/single/single-ekskul.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container page-content single-ekskul-container" style="margin-bottom: 80px;">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id   = get_the_ID();
		$title     = get_the_title();
		$thumb_url = sekolahku_get_ekskul_thumb( $post_id );

		$raw_content        = get_the_content();
		$clean_content_text = wp_strip_all_tags( str_replace( array( '</li>', '</p>', '<br>', '<br/>' ), "\n", $raw_content ) );

		// Data Meta 1: Hari
		$hari = get_post_meta( $post_id, '_ekskul_hari', true );
		if ( ! $hari && preg_match( '/Hari\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$hari = trim( $m[1] );
		}
		if ( ! $hari ) {
			$hari = 'Selasa, Kamis';
		}

		// Data Meta 2: Waktu
		$waktu = get_post_meta( $post_id, '_ekskul_waktu', true );
		if ( ! $waktu && preg_match( '/Waktu\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$waktu = trim( $m[1] );
		}
		if ( ! $waktu ) {
			$waktu = '15:30 - 17:00';
		}

		// Data Meta 3: Lokasi
		$lokasi = get_post_meta( $post_id, '_ekskul_lokasi', true );
		if ( ! $lokasi && preg_match( '/(?:Lokasi|Tempat)\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$lokasi = trim( $m[1] );
		}
		if ( ! $lokasi ) {
			$lokasi = 'Lapangan Sekolah';
		}

		// Data Meta 4: Jumlah Anggota
		$anggota = get_post_meta( $post_id, '_ekskul_anggota', true );
		if ( ! $anggota && preg_match( '/Jumlah\s*Anggota\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$anggota = trim( $m[1] );
		}
		if ( ! $anggota ) {
			$anggota = '25';
		}

		// Data Meta 5: Pembina / Pengajar / Pelatih / Coach
		$pembina       = get_post_meta( $post_id, '_ekskul_pembina', true );
		$pembina_label = 'Pembina';
		if ( preg_match( '/(Pengajar|Pembina|Pelatih|Coach)\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$pembina_label = ucfirst( strtolower( trim( $m[1] ) ) );
			if ( ! $pembina ) {
				$pembina = trim( $m[2] );
			}
		}
		if ( ! $pembina ) {
			$pembina = 'Rudi Hartono';
		}

		// Data Meta 6: Status
		$status = get_post_meta( $post_id, '_ekskul_status', true );
		if ( ! $status && preg_match( '/Status\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
			$status = trim( $m[1] );
		}
		if ( ! $status ) {
			$status = 'Aktif';
		}
		?>

		<div class="staf-layout-grid">
			<!-- KONTEN UTAMA (KIRI) -->
			<div class="staf-main-column">
				<!-- JUDUL EKSKUL -->
				<h1 class="staf-page-title"><?php echo esc_html( $title ); ?></h1>

				<!-- GAMBAR HERO UTAMA -->
				<?php if ( $thumb_url ) : ?>
					<div class="ekskul-hero-wrapper">
						<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="ekskul-hero-img">
					</div>
				<?php endif; ?>

				<!-- KOTAK INFO DETAIL META (GRID 2 KOLOM) -->
				<div class="ekskul-meta-box">
					<div class="ekskul-meta-grid">
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							<span>Hari: <strong><?php echo esc_html( $hari ); ?></strong></span>
						</div>
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
							<span>Waktu: <strong><?php echo esc_html( $waktu ); ?></strong></span>
						</div>
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
							<span>Lokasi: <strong><?php echo esc_html( $lokasi ); ?></strong></span>
						</div>
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							<span>Jumlah Anggota: <strong><?php echo esc_html( $anggota ); ?></strong></span>
						</div>
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
							<span><?php echo esc_html( $pembina_label ); ?>: <strong><?php echo esc_html( $pembina ); ?></strong></span>
						</div>
						<div class="ekskul-detail-item">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							<span>Status: <strong><?php echo esc_html( $status ); ?></strong></span>
						</div>
					</div>
				</div>

				<!-- DESKRIPSI KONTEN UTAMA (BERSIH DARI FOTO & TEKS META DUPLIKAT) -->
				<div class="ekskul-content-body">
					<?php
					$clean_content = get_the_content();
					// 1. Hapus tag <img>
					$clean_content = preg_replace( '/<img[^>]+>/i', '', $clean_content );
					// 2. Hapus baris metadata duplikat (Hari, Waktu, Lokasi, Jumlah Anggota, Pembina/Pengajar/Pelatih/Coach, Status)
					$meta_keywords = 'Hari|Waktu|Lokasi|Tempat|Jumlah\s*Anggota|Pembina|Pengajar|Pelatih|Coach|Status';
					$clean_content = preg_replace( '/<(?:p|li|div)[^>]*>\s*(?:<[^>]+>\s*)*(?:' . $meta_keywords . ')\s*[\:\-\–\—\s][\s\S]*?<\/(?:p|li|div)>/i', '', $clean_content );
					$clean_content = preg_replace( '/^(?:\s*<[^>]+>)*\s*(?:' . $meta_keywords . ')\s*[\:\-\–\—\s].*$/mi', '', $clean_content );
					echo apply_filters( 'the_content', $clean_content );
					?>
				</div>

				<!-- TOMBOL BAGIKAN (SHARE BUTTONS) -->
				<?php get_template_part( 'template-parts/share-buttons' ); ?>

				<!-- SECTION EKSTRAKURIKULER LAINNYA -->
				<div class="staf-other-section" style="margin-top: 40px;">
					<div class="other-section-header">
						<h3 class="decorated-title">Ekstrakurikuler Lainnya</h3>
						<div class="other-nav-arrows">
							<button type="button" class="other-nav-btn" id="ekskulPrev" aria-label="Sebelumnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
							</button>
							<button type="button" class="other-nav-btn" id="ekskulNext" aria-label="Selanjutnya">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
							</button>
						</div>
					</div>

					<div class="other-staf-slider">
						<div class="other-staf-track" id="ekskulTrack">
							<?php
							$other_ekskul = new WP_Query( array(
								'post_type'      => 'ekskul',
								'post__not_in'   => array( $post_id ),
								'posts_per_page' => 6,
							) );

							if ( $other_ekskul->have_posts() ) :
								while ( $other_ekskul->have_posts() ) :
									$other_ekskul->the_post();
									$o_id    = get_the_ID();
									$o_thumb = sekolahku_get_ekskul_thumb( $o_id );
									$o_ang   = get_post_meta( $o_id, '_ekskul_anggota', true );
									$o_pem   = get_post_meta( $o_id, '_ekskul_pembina', true );
									?>
									<div class="other-ekskul-card">
										<div class="other-ekskul-img">
											<img src="<?php echo esc_url( $o_thumb ); ?>" alt="<?php the_title_attribute(); ?>">
										</div>
										<div class="other-ekskul-body">
											<h4><?php the_title(); ?></h4>
											<div class="other-ekskul-meta">
												<span>👥 Anggota: <strong><?php echo esc_html( $o_ang ? $o_ang : '20+' ); ?></strong></span>
												<span>👤 Pembina: <strong><?php echo esc_html( $o_pem ? $o_pem : '-' ); ?></strong></span>
											</div>
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
@media (max-width: 992px) {
	.staf-layout-grid {
		grid-template-columns: 1fr;
	}
}

/* JUDUL UTAMA EKSKUL */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}

/* GAMBAR HERO EKSKUL */
.ekskul-hero-wrapper {
	width: 100%;
	border-radius: 16px;
	overflow: hidden;
	margin-bottom: 24px;
	background: #f1f5f9;
	box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
}
.ekskul-hero-img {
	width: 100%;
	height: auto;
	max-height: 480px;
	object-fit: cover;
	display: block;
}

/* KOTAK INFO DETAIL META (GRID 2 KOLOM SOFT GRAY) */
.ekskul-meta-box {
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	padding: 20px 24px;
	margin-bottom: 32px;
}
.ekskul-meta-grid {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 14px 24px;
}
.ekskul-detail-item {
	display: flex;
	align-items: center;
	gap: 10px;
	font-size: 14px;
	color: #475569;
}
.ekskul-detail-item svg {
	color: #64748b;
	flex-shrink: 0;
}
.ekskul-detail-item strong {
	color: #0f172a;
	font-weight: 700;
}
@media (max-width: 640px) {
	.ekskul-meta-grid {
		grid-template-columns: 1fr;
		gap: 10px;
	}
}

/* DESKRIPSI KONTEN */
.ekskul-content-body {
	font-size: 15.5px;
	line-height: 1.85;
	color: #334155;
	margin-bottom: 32px;
}
.ekskul-content-body p {
	margin-bottom: 18px;
}

/* DEKORASI JUDUL "EKSTRAKURIKULER LAINNYA" (GARIS ORANYE) */
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

/* CONTAINER SLIDER & TRACK EKSKUL LAINNYA */
.other-staf-slider {
	overflow: hidden;
	width: 100%;
}
.other-staf-track {
	display: flex;
	gap: 16px;
	transition: transform 0.3s ease;
}

/* CARD EKSKUL LAINNYA */
.other-ekskul-card {
	flex: 0 0 calc(50% - 8px);
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.other-ekskul-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}
.other-ekskul-img {
	width: 100%;
	aspect-ratio: 16 / 9;
	background: #f1f5f9;
	overflow: hidden;
}
.other-ekskul-img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}
.other-ekskul-card:hover .other-ekskul-img img {
	transform: scale(1.05);
}
.other-ekskul-body {
	padding: 16px 18px;
	display: flex;
	flex-direction: column;
	flex: 1;
}
.other-ekskul-body h4 {
	font-size: 16px;
	font-weight: 700;
	color: #0f172a;
	margin-bottom: 8px;
	line-height: 1.35;
}
.other-ekskul-meta {
	display: flex;
	flex-direction: column;
	gap: 4px;
	font-size: 12.5px;
	color: #64748b;
	margin-bottom: 14px;
	flex: 1;
}
@media (max-width: 640px) {
	.other-ekskul-card {
		flex: 0 0 100%;
	}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('ekskulTrack');
	const prevBtn = document.getElementById('ekskulPrev');
	const nextBtn = document.getElementById('ekskulNext');
	if (!track || !prevBtn || !nextBtn) return;

	let scrollPos = 0;

	function getStep() {
		const firstCard = track.querySelector('.other-ekskul-card');
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

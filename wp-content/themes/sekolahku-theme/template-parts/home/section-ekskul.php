<?php
/**
 * Section Ekstrakulikuler - Redesain 2 Card Reversed (Foto Kiri, Data Kanan) & Slider Step-by-step.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_ekskul_eyebrow', 'EKSKUL SECTION' );
$title    = get_theme_mod( 'sekolahku_ekskul_title', 'Ekstrakulikuler' );
$subtitle = get_theme_mod( 'sekolahku_ekskul_subtitle', 'Ekstrakulikuler sekolah kami mencakup kegiatan yang menggabungkan kegiatan seni, olahraga, dan kegiatan sosial untuk meningkatkan minat serta potensi peserta didik.' );
$archive_link = get_post_type_archive_link( 'ekskul' );
if ( ! $archive_link ) {
	$archive_link = home_url( '/ekskul/' );
}

$dummy_ekskul = array(
	array(
		'title'   => 'Pramuka (Praja Muda Karana)',
		'anggota' => '120+ Siswa',
		'pembina' => 'Dra. Endang S. & Budi S.',
		'img'     => 'https://images.unsplash.com/photo-1526976668912-1a811878dd37?auto=format&fit=crop&w=600&q=80',
		'link'    => home_url( '/ekskul/' ),
	),
	array(
		'title'   => 'Paskibra (Pasukan Pengibar Bendera)',
		'anggota' => '65+ Siswa',
		'pembina' => 'Siti Rahmawati, S.Kom',
		'img'     => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&q=80',
		'link'    => home_url( '/ekskul/' ),
	),
	array(
		'title'   => 'PMR & Wira (Palang Merah Remaja)',
		'anggota' => '80+ Siswa',
		'pembina' => 'Ahmad Fauzi, S.Pd',
		'img'     => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80',
		'link'    => home_url( '/ekskul/' ),
	),
	array(
		'title'   => 'Futsal & Olahraga Tim',
		'anggota' => '95+ Siswa',
		'pembina' => 'Hendra Pratama, S.Si',
		'img'     => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=600&q=80',
		'link'    => home_url( '/ekskul/' ),
	),
);
?>

<!-- EKSTRAKULIKULER SECTION (Latar Belakang Soft #f8fafc) -->
<section class="section ekskul-section">
	<div class="container">
		<!-- HEADER ROW FLEX (Kiri: Teks & Garis Aksen, Kanan: Tombol & Panah Navigasi) -->
		<div class="ekskul-header-flex">
			<div class="ekskul-header-left">
				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="ekskul-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="ekskul-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>

			<div class="ekskul-header-right">
				<a href="<?php echo esc_url( $archive_link ); ?>" class="btn btn-see-all">
					<span>Lihat Semua</span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</a>

				<div class="ekskul-nav-arrows">
					<button type="button" class="ekskul-nav-btn ekskul-prev" id="ekskulPrev" aria-label="Ekskul Sebelumnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
					</button>
					<button type="button" class="ekskul-nav-btn ekskul-next" id="ekskulNext" aria-label="Ekskul Selanjutnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</button>
				</div>
			</div>
		</div>

		<!-- SLIDER TRACK CONTAINER (2 Card Reversed: Foto Kiri, Data Kanan) -->
		<div class="ekskul-slider-wrapper">
			<div class="ekskul-slider-track" id="ekskulTrack">
				<?php
				$ekskul_query = new WP_Query( array( 'post_type' => 'ekskul', 'posts_per_page' => 10 ) );
				if ( $ekskul_query->have_posts() ) :
					while ( $ekskul_query->have_posts() ) : $ekskul_query->the_post();
						$pembina = get_post_meta( get_the_ID(), '_ekskul_pembina', true );
						$anggota = get_post_meta( get_the_ID(), '_ekskul_anggota', true );
						?>
						<div class="card facility-card ekskul-card">
							<div class="facility-card-inner ekskul-card-inner">
								<div class="facility-thumb ekskul-thumb">
									<img src="<?php echo esc_url( sekolahku_get_ekskul_thumb( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="facility-img ekskul-img">
								</div>
								<div class="facility-text ekskul-text">
									<h3><?php the_title(); ?></h3>
									<?php
									$raw_content = get_the_content();
									// Replace break tags with newlines and strip all HTML tags so <strong> tags don't break regex
									$clean_content_text = wp_strip_all_tags( str_replace( array( '</li>', '</p>', '<br>', '<br/>' ), "\n", $raw_content ) );

									// 1. Jumlah Anggota
									$anggota = get_post_meta( get_the_ID(), '_ekskul_anggota', true );
									if ( ! $anggota && preg_match( '/Jumlah\s*Anggota\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
										$anggota = trim( $m[1] );
									}

									// 2. Pembina/Pengajar
									$pembina = get_post_meta( get_the_ID(), '_ekskul_pembina', true );
									if ( ! $pembina && preg_match( '/(?:Pengajar|Pembina|Pelatih)\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
										$pembina = trim( $m[1] );
									}
									?>
									<div class="ekskul-info-list" style="margin: 10px 0 16px; font-size: 0.875rem; color: #64748b; display: flex; flex-direction: column; gap: 6px;">
										<div style="display: flex; align-items: center; gap: 8px;">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
											<span>Jumlah Anggota: <strong><?php echo esc_html( $anggota ? $anggota : '-' ); ?></strong></span>
										</div>
										<div style="display: flex; align-items: center; gap: 8px;">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
											<span>Pembina: <strong><?php echo esc_html( $pembina ? $pembina : '-' ); ?></strong></span>
										</div>
									</div>
									<a href="<?php the_permalink(); ?>" class="facility-link">Selengkapnya &raquo;</a>
								</div>
							</div>
						</div>
						<?php
					endwhile; wp_reset_postdata();
				else :
					foreach ( $dummy_ekskul as $dummy ) :
						?>
						<div class="card facility-card ekskul-card">
							<div class="facility-card-inner ekskul-card-inner">
								<div class="facility-thumb ekskul-thumb">
									<img src="<?php echo esc_url( $dummy['img'] ); ?>" alt="<?php echo esc_attr( $dummy['title'] ); ?>" class="facility-img ekskul-img">
								</div>
								<div class="facility-text ekskul-text">
									<h3><?php echo esc_html( $dummy['title'] ); ?></h3>
									<div class="ekskul-info-list" style="margin: 10px 0 16px; font-size: 0.875rem; color: #64748b; display: flex; flex-direction: column; gap: 6px;">
										<div style="display: flex; align-items: center; gap: 8px;">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
											<span>Jumlah Anggota: <strong><?php echo esc_html( $dummy['anggota'] ); ?></strong></span>
										</div>
										<div style="display: flex; align-items: center; gap: 8px;">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
											<span>Pembina: <strong><?php echo esc_html( $dummy['pembina'] ); ?></strong></span>
										</div>
									</div>
									<a href="<?php echo esc_url( $dummy['link'] ); ?>" class="facility-link">Selengkapnya &raquo;</a>
								</div>
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('ekskulTrack');
	const prevBtn = document.getElementById('ekskulPrev');
	const nextBtn = document.getElementById('ekskulNext');

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

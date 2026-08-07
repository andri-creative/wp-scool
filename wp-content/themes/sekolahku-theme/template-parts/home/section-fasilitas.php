<?php
/**
 * Section Fasilitas Sekolah - Redesain 2 Card Horizontal & Slider Step-by-step.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_fasilitas_eyebrow', 'FACILITIES SECTION' );
$title    = get_theme_mod( 'sekolahku_fasilitas_title', 'Fasilitas Sekolah' );
$subtitle = get_theme_mod( 'sekolahku_fasilitas_subtitle', 'Fasilitas sekolah kami mencakup ruang kelas, laboratorium, dan peralatan yang memadai untuk membantu proses belajar peserta didik.' );
$archive_link = get_post_type_archive_link( 'fasilitas' );
if ( ! $archive_link ) {
	$archive_link = home_url( '/fasilitas/' );
}

$dummy_fasilitas = array(
	array(
		'title' => 'Kantin Sehat & Area Istirahat',
		'desc'  => 'Kantin sekolah merupakan fasilitas yang menyediakan makanan dan minuman bagi peserta didik dan staf dengan standar kebersihan tinggi.',
		'img'   => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/fasilitas/' ),
	),
	array(
		'title' => 'Lapangan Olahraga & Area Aktivitas',
		'desc'  => 'Lapangan olahraga merupakan fasilitas yang mendukung kegiatan fisik dan pengembangan potensi di bidang keolahragaan peserta didik.',
		'img'   => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/fasilitas/' ),
	),
	array(
		'title' => 'Laboratorium Komputer & Multimedia',
		'desc'  => 'Laboratorium ber-AC dilengkapi komputer spesifikasi tinggi, jaringan internet cepat, serta proyektor multimedia modern.',
		'img'   => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/fasilitas/' ),
	),
	array(
		'title' => 'Perpustakaan Digital & Ruang Baca',
		'desc'  => 'Perpustakaan sekolah yang menyediakan ribuan koleksi buku fisik serta ribuan judul e-book interaktif dalam suasana yang kondusif.',
		'img'   => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/fasilitas/' ),
	),
);
?>

<!-- FASILITAS SEKOLAH SECTION (Latar Belakang Putih) -->
<section class="section facility-section">
	<div class="container">
		<!-- HEADER ROW FLEX (Kiri: Teks & Garis Aksen, Kanan: Tombol & Panah Navigasi) -->
		<div class="facility-header-flex">
			<div class="facility-header-left">
				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="facility-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="facility-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>

			<div class="facility-header-right">
				<a href="<?php echo esc_url( $archive_link ); ?>" class="btn btn-see-all">
					<span>Lihat Semua</span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</a>

				<div class="facility-nav-arrows">
					<button type="button" class="facility-nav-btn facility-prev" id="facilityPrev" aria-label="Fasilitas Sebelumnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
					</button>
					<button type="button" class="facility-nav-btn facility-next" id="facilityNext" aria-label="Fasilitas Selanjutnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</button>
				</div>
			</div>
		</div>

		<!-- SLIDER TRACK CONTAINER (2 Card Horizontal Per View) -->
		<div class="facility-slider-wrapper">
			<div class="facility-slider-track" id="facilityTrack">
				<?php
				$fasilitas_query = new WP_Query( array( 'post_type' => 'fasilitas', 'posts_per_page' => 10 ) );
				if ( $fasilitas_query->have_posts() ) :
					while ( $fasilitas_query->have_posts() ) : $fasilitas_query->the_post();
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
					endwhile; wp_reset_postdata();
				else :
					foreach ( $dummy_fasilitas as $dummy ) :
						?>
						<div class="card facility-card">
							<div class="facility-card-inner">
								<div class="facility-text">
									<h3><?php echo esc_html( $dummy['title'] ); ?></h3>
									<p><?php echo esc_html( $dummy['desc'] ); ?></p>
									<a href="<?php echo esc_url( $dummy['link'] ); ?>" class="facility-link">Selengkapnya &raquo;</a>
								</div>
								<div class="facility-thumb">
									<img src="<?php echo esc_url( $dummy['img'] ); ?>" alt="<?php echo esc_attr( $dummy['title'] ); ?>" class="facility-img">
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
	const track = document.getElementById('facilityTrack');
	const prevBtn = document.getElementById('facilityPrev');
	const nextBtn = document.getElementById('facilityNext');

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

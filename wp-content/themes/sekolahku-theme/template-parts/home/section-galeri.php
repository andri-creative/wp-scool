<?php
/**
 * Section Galeri (Foto & Video) - Redesain 3 Card & Slider Step-by-step.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_galeri_eyebrow', 'GALLERY SECTION' );
$title    = get_theme_mod( 'sekolahku_galeri_title', 'Foto & Video' );
$subtitle = get_theme_mod( 'sekolahku_galeri_subtitle', 'Galeri sekolah kami mencakup berbagai kegiatan dan momen berharga yang membantu peserta didik mengenali potensi terbaiknya.' );
$archive_link = get_post_type_archive_link( 'galeri' );
if ( ! $archive_link ) {
	$archive_link = home_url( '/galeri/' );
}

$dummy_galeri = array(
	array(
		'title' => 'Kegiatan Class Meeting dan Kebersamaan Siswa',
		'badge' => '1',
		'img'   => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/galeri/' ),
	),
	array(
		'title' => 'Lomba Kreativitas dan Inovasi Siswa',
		'badge' => '1',
		'img'   => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/galeri/' ),
	),
	array(
		'title' => 'Kegiatan Bakti Sosial dan Peduli Lingkungan',
		'badge' => '1',
		'img'   => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/galeri/' ),
	),
	array(
		'title' => 'Pentas Seni & Budaya Nusantara',
		'badge' => '1',
		'img'   => 'https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=600&q=80',
		'link'  => home_url( '/galeri/' ),
	),
);
?>

<!-- GALERI FOTO & VIDEO SECTION (Latar Belakang Putih) -->
<section class="section gallery-section">
	<div class="container">
		<!-- HEADER ROW FLEX (Kiri: Teks & Garis Aksen, Kanan: Tombol & Panah Navigasi) -->
		<div class="gallery-header-flex">
			<div class="gallery-header-left">
				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="gallery-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="gallery-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>

			<div class="gallery-header-right">
				<a href="<?php echo esc_url( $archive_link ); ?>" class="btn btn-see-all">
					<span>Lihat Semua</span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</a>

				<div class="gallery-nav-arrows">
					<button type="button" class="gallery-nav-btn gallery-prev" id="galleryPrev" aria-label="Galeri Sebelumnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
					</button>
					<button type="button" class="gallery-nav-btn gallery-next" id="galleryNext" aria-label="Galeri Selanjutnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</button>
				</div>
			</div>
		</div>

		<!-- SLIDER TRACK CONTAINER (3 Cards Per View) -->
		<div class="gallery-slider-wrapper">
			<div class="gallery-slider-track" id="galleryTrack">
				<?php
				$galeri_query = new WP_Query( array( 'post_type' => 'galeri', 'posts_per_page' => 12 ) );
				if ( $galeri_query->have_posts() ) :
					while ( $galeri_query->have_posts() ) : $galeri_query->the_post();
						?>
						<div class="card gallery-card">
							<a href="<?php the_permalink(); ?>" class="gallery-card-inner">
								<div class="gallery-thumb">
									<img src="<?php echo esc_url( sekolahku_get_galeri_thumb( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="gallery-img">
									<span class="gallery-badge">
										<?php echo esc_html( sekolahku_get_galeri_badge( get_the_ID() ) ); ?>
									</span>
								</div>
								<div class="gallery-body">
									<h3><?php the_title(); ?></h3>
								</div>
							</a>
						</div>
						<?php
					endwhile; wp_reset_postdata();
				else :
					foreach ( $dummy_galeri as $dummy ) :
						?>
						<div class="card gallery-card">
							<a href="<?php echo esc_url( $dummy['link'] ); ?>" class="gallery-card-inner">
								<div class="gallery-thumb">
									<img src="<?php echo esc_url( $dummy['img'] ); ?>" alt="<?php echo esc_attr( $dummy['title'] ); ?>" class="gallery-img">
									<span class="gallery-badge">
										<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
										<?php echo esc_html( $dummy['badge'] ); ?>
									</span>
								</div>
								<div class="gallery-body">
									<h3><?php echo esc_html( $dummy['title'] ); ?></h3>
								</div>
							</a>
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
	const track = document.getElementById('galleryTrack');
	const prevBtn = document.getElementById('galleryPrev');
	const nextBtn = document.getElementById('galleryNext');

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

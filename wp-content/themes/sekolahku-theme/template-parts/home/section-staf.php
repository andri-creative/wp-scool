<?php
/**
 * Section Staf & Guru - Redesain & Slider Step-by-step.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_staf_eyebrow', 'STAFF SECTION' );
$title    = get_theme_mod( 'sekolahku_staf_title', 'Staf & Guru' );
$subtitle = get_theme_mod( 'sekolahku_staf_subtitle', 'Guru dan Staf sekolah kami terdiri dari tenaga profesional yang berpengalaman dan berkomitmen dalam mendukung pendidikan yang berkualitas.' );
$archive_link = get_post_type_archive_link( 'staf' );
if ( ! $archive_link ) {
	$archive_link = home_url( '/staf/' );
}


?>

<!-- STAF & GURU SECTION (Background Putih Sama Seperti Kepala Sekolah) -->
<section class="section staff-section">
	<div class="container">
		<!-- HEADER ROW FLEX (Kiri: Teks & Garis Aksen, Kanan: Tombol & Panah Navigasi) -->
		<div class="staff-header-flex">
			<div class="staff-header-left">
				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2 class="staff-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="staff-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>

			<div class="staff-header-right">
				<a href="<?php echo esc_url( $archive_link ); ?>" class="btn btn-see-all">
					<span>Lihat Semua</span>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</a>

				<div class="staff-nav-arrows">
					<button type="button" class="staff-nav-btn staff-prev" id="staffPrev" aria-label="Staf Sebelumnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
					</button>
					<button type="button" class="staff-nav-btn staff-next" id="staffNext" aria-label="Staf Selanjutnya">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</button>
				</div>
			</div>
		</div>

		<!-- SLIDER TRACK CONTAINER -->
		<div class="staff-slider-wrapper">
			<div class="staff-slider-track" id="staffTrack">
				<?php
				$staf_query = new WP_Query( array( 'post_type' => 'staf', 'posts_per_page' => 12 ) );
				if ( $staf_query->have_posts() ) :
					while ( $staf_query->have_posts() ) : $staf_query->the_post();
						?>
						<div class="card staff-card">
							<a href="<?php the_permalink(); ?>" class="staff-card-link">
								<div class="staff-thumb">
									<img src="<?php echo esc_url( sekolahku_get_staf_avatar( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="staff-img">
								</div>
								<div class="staff-body">
									<h3><?php the_title(); ?></h3>
									<?php 
									$raw_content = get_the_content();
									$clean_text  = wp_strip_all_tags( str_replace( array( '</li>', '</p>', '<br>', '<br/>' ), "\n", $raw_content ) );
									$staf_role   = get_post_meta( get_the_ID(), '_staf_role', true );
									if ( ! $staf_role ) {
										if ( preg_match( '/Jabatan\s*[:\-]?\s*([^\n\r]+)/i', $clean_text, $m_role ) ) {
											$staf_role = trim( $m_role[1] );
										} else {
											$staf_role = wp_trim_words( $clean_text, 5 );
										}
									}
									?>
									<p><?php echo esc_html( $staf_role ? $staf_role : 'Tenaga Pendidik' ); ?></p>
								</div>
							</a>
						</div>
						<?php
					endwhile; wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('staffTrack');
	const prevBtn = document.getElementById('staffPrev');
	const nextBtn = document.getElementById('staffNext');
	const navArrows = document.querySelector('.staff-nav-arrows');

	if (!track) return;

	let autoplayTimer = null;
	const pauseDuration = 3000; // Jeda 3 detik per kartu
	let isAnimating = false;

	function getVisibleCards() {
		const w = window.innerWidth;
		if (w < 640) return 1;
		if (w < 992) return 2;
		if (w < 1200) return 3;
		return 4;
	}

	function shouldSlide() {
		return track && track.children.length > getVisibleCards();
	}

	function updateControlsVisibility() {
		const canSlide = shouldSlide();
		if (navArrows) {
			navArrows.style.display = canSlide ? 'flex' : 'none';
		}
		if (!canSlide) {
			stopAutoplay();
		} else if (!autoplayTimer) {
			startAutoplay();
		}
	}

	function slideNext() {
		if (!shouldSlide() || isAnimating) return;
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
		if (!shouldSlide() || isAnimating) return;
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
		if (shouldSlide()) {
			autoplayTimer = setInterval(slideNext, pauseDuration);
		}
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
	track.addEventListener('mouseleave', function() {
		if (shouldSlide()) startAutoplay();
	});
	track.addEventListener('touchstart', stopAutoplay, { passive: true });
	track.addEventListener('touchend', function() {
		if (shouldSlide()) startAutoplay();
	}, { passive: true });

	window.addEventListener('resize', updateControlsVisibility);

	updateControlsVisibility();
});
</script>

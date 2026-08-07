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

$dummy_staff = array(
	array(
		'name' => 'Dewi Lestari, S.Sn',
		'role' => 'Guru DKV',
		'img'  => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
	),
	array(
		'name' => 'Budi Santoso, S.T',
		'role' => 'Guru TKR',
		'img'  => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80',
	),
	array(
		'name' => 'Siti Rahmawati, S.Kom',
		'role' => 'Guru RPL',
		'img'  => 'https://images.unsplash.com/photo-1580894732413-a75151b14f85?auto=format&fit=crop&w=600&q=80',
	),
	array(
		'name' => 'Ahmad Fauzi, S.Pd',
		'role' => 'Guru Fisika',
		'img'  => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
	),
	array(
		'name' => 'Rina Wijaya, M.Pd',
		'role' => 'Guru Bahasa Inggris',
		'img'  => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&q=80',
	),
	array(
		'name' => 'Hendra Pratama, S.Si',
		'role' => 'Guru Matematika',
		'img'  => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
	),
);
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
							<div class="staff-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'staff-img' ) ); ?>
								<?php else : ?>
									<img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80" alt="<?php the_title_attribute(); ?>" class="staff-img">
								<?php endif; ?>
							</div>
							<div class="staff-body">
								<h3><?php the_title(); ?></h3>
								<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							</div>
						</div>
						<?php
					endwhile; wp_reset_postdata();
				else :
					foreach ( $dummy_staff as $dummy ) :
						?>
						<div class="card staff-card">
							<div class="staff-thumb">
								<img src="<?php echo esc_url( $dummy['img'] ); ?>" alt="<?php echo esc_attr( $dummy['name'] ); ?>" class="staff-img">
							</div>
							<div class="staff-body">
								<h3><?php echo esc_html( $dummy['name'] ); ?></h3>
								<p><?php echo esc_html( $dummy['role'] ); ?></p>
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
	const track = document.getElementById('staffTrack');
	const prevBtn = document.getElementById('staffPrev');
	const nextBtn = document.getElementById('staffNext');

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

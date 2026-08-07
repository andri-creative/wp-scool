<?php
/**
 * Section Testimonial ("Apa Kata Mereka?") - Redesain 3 Card Avatar Top & Slider Step-by-step.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_testimoni_eyebrow', 'TESTIMONIAL SECTION' );
$title    = get_theme_mod( 'sekolahku_testimoni_title', 'Apa Kata Mereka?' );
$subtitle = get_theme_mod( 'sekolahku_testimoni_subtitle', 'Pendapat dan pengalaman dari orang tua serta peserta didik yang telah merasakan layanan pendidikan di sekolah kami.' );

$dummy_testi = array(
	array(
		'name'  => 'Ibu Sari Wulandari',
		'role'  => 'Orang Tua Siswa Kelas IX',
		'quote' => 'Komunikasi antara sekolah dan orang tua berjalan dengan sangat baik. Informasi mengenai perkembangan akademik maupun kegiatan sekolah selalu disampaikan secara jelas dan transparan. Kami merasa menjadi bagian dari komunitas pendidikan yang saling mendukung. Terima kasih atas dukungan dan pengajaran yang telah diberikan.',
		'img'   => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
	),
	array(
		'name'  => 'Dimas Pratama',
		'role'  => 'Alumni Angkatan 2021',
		'quote' => 'Selama bersekolah di sini, saya tidak hanya mendapatkan ilmu pengetahuan, tetapi juga pembinaan karakter dan motivasi untuk terus berkembang. Dukungan guru yang inspiratif serta suasana belajar yang kondusif membantu saya lebih siap menghadapi tantangan di jenjang pendidikan selanjutnya. Terbaik...!!!',
		'img'   => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=300&q=80',
	),
	array(
		'name'  => 'Bapak Andi Wijaya',
		'role'  => 'Orang Tua Alumni 2023',
		'quote' => 'Kami sangat bersyukur anak kami dapat menempuh pendidikan di sekolah ini. Selain prestasi akademik yang meningkat, kami juga melihat perkembangan karakter dan rasa tanggung jawab yang semakin baik. Lingkungan sekolah yang aman dan guru yang peduli menjadi nilai tambah yang luar biasa bagi kami sebagai orang tua.',
		'img'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
	),
	array(
		'name'  => 'Rina Pertiwi',
		'role'  => 'Orang Tua Siswa Kelas XI',
		'quote' => 'Fasilitas pembelajaran yang sangat lengkap dan bimbingan guru yang sabar membuat anak kami selalu semangat berangkat ke sekolah setiap hari.',
		'img'   => 'https://images.unsplash.com/photo-1580894732413-a75151b14f85?auto=format&fit=crop&w=300&q=80',
	),
);
?>

<!-- TESTIMONIAL SECTION (Latar Belakang Soft #f8fafc) -->
<section class="section testimonial-section">
	<div class="container">
		<!-- HEADER RATA TENGAH (CENTERED HEADER) -->
		<div class="testimonial-header-centered">
			<?php if ( $eyebrow ) : ?>
				<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
			<?php endif; ?>
			<?php if ( $title ) : ?>
				<h2 class="testimonial-title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $subtitle ) : ?>
				<p class="testimonial-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>
		</div>

		<!-- SLIDER TRACK CONTAINER (3 Cards Per View with Top Avatar) -->
		<div class="testimonial-slider-wrapper">
			<div class="testimonial-slider-track" id="testimonialTrack">
				<?php
				$testi_query = new WP_Query( array( 'post_type' => 'testimoni', 'posts_per_page' => 10 ) );
				if ( $testi_query->have_posts() ) :
					while ( $testi_query->have_posts() ) : $testi_query->the_post();
						$role = get_post_meta( get_the_ID(), '_testi_role', true );
						if ( ! $role ) {
							$role = 'Orang Tua / Alumni';
						}
						?>
						<div class="card testimonial-card">
							<div class="testimonial-avatar">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'testimonial-avatar-img' ) ); ?>
								<?php else : ?>
									<img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" alt="<?php the_title_attribute(); ?>" class="testimonial-avatar-img">
								<?php endif; ?>
							</div>
							<div class="testimonial-content">
								<p class="testimonial-quote"><?php echo esc_html( get_the_excerpt() ); ?></p>
								<div class="testimonial-author">
									<h4><?php the_title(); ?></h4>
									<span><?php echo esc_html( $role ); ?></span>
								</div>
							</div>
						</div>
						<?php
					endwhile; wp_reset_postdata();
				else :
					foreach ( $dummy_testi as $dummy ) :
						?>
						<div class="card testimonial-card">
							<div class="testimonial-avatar">
								<img src="<?php echo esc_url( $dummy['img'] ); ?>" alt="<?php echo esc_attr( $dummy['name'] ); ?>" class="testimonial-avatar-img">
							</div>
							<div class="testimonial-content">
								<p class="testimonial-quote"><?php echo esc_html( $dummy['quote'] ); ?></p>
								<div class="testimonial-author">
									<h4><?php echo esc_html( $dummy['name'] ); ?></h4>
									<span><?php echo esc_html( $dummy['role'] ); ?></span>
								</div>
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>

		<!-- PAGINATION DOTS INDICATOR -->
		<div class="testimonial-dots">
			<span class="testimonial-dot active"></span>
			<span class="testimonial-dot"></span>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('testimonialTrack');
	const dots = document.querySelectorAll('.testimonial-dot');

	if (!track) return;

	let autoplayTimer = null;
	const pauseDuration = 3000; // Jeda 3 detik per kartu
	let isAnimating = false;
	let currentDot = 0;

	function updateDots() {
		if (dots.length < 2) return;
		currentDot = (currentDot + 1) % dots.length;
		dots.forEach((dot, idx) => {
			if (idx === currentDot) {
				dot.classList.add('active');
			} else {
				dot.classList.remove('active');
			}
		});
	}

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
			updateDots();
		}, 500);
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

	dots.forEach(function(dot, idx) {
		dot.addEventListener('click', function() {
			if (isAnimating) return;
			stopAutoplay();
			slideNext();
			startAutoplay();
		});
	});

	track.addEventListener('mouseenter', stopAutoplay);
	track.addEventListener('mouseleave', startAutoplay);
	track.addEventListener('touchstart', stopAutoplay, { passive: true });
	track.addEventListener('touchend', startAutoplay, { passive: true });

	startAutoplay();
});
</script>

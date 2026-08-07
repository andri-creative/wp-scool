<?php
/**
 * Section Benefit ("Mengapa Memilih Kami?") - Tampilan Centered & Slider Horizontal ("Geser ke Kiri").
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_benefit_eyebrow', 'BENEFIT SECTION' );
$title    = get_theme_mod( 'sekolahku_benefit_title', 'Mengapa Memilih Kami?' );
$subtitle = get_theme_mod( 'sekolahku_benefit_subtitle', 'Berbagai keunggulan yang mendukung proses pembelajaran serta pengembangan potensi peserta didik secara optimal.' );

$default_items = array(
	1 => array(
		'title' => 'Guru Profesional',
		'desc'  => 'Tenaga pendidik berpengalaman dan tersertifikasi yang fokus pada perkembangan akademik dan karakter siswa.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
		'badge' => 'orange',
	),
	2 => array(
		'title' => 'Ekstrakurikuler Aktif',
		'desc'  => 'Beragam kegiatan non-akademik membantu siswa mengembangkan minat, bakat, kepemimpinan, dan kemampuan sosial.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
		'badge' => 'blue',
	),
	3 => array(
		'title' => 'Dukungan Karier',
		'desc'  => 'Program pembinaan dan kerja sama mitra industri membantu siswa merencanakan masa depan secara terarah dan profesional.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
		'badge' => 'blue',
	),
	4 => array(
		'title' => 'Kelas Modern & Multimedia',
		'desc'  => 'Ruang belajar ber-AC dengan proyektor multimedia, akses internet cepat, dan lingkungan kondusif.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
		'badge' => 'orange',
	),
	5 => array(
		'title' => 'Kurikulum Relevan',
		'desc'  => 'Materi pembelajaran terintegrasi dengan standar nasional dan kebutuhan dunia kerja masa kini.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
		'badge' => 'blue',
	),
	6 => array(
		'title' => 'Lingkungan Positif',
		'desc'  => 'Budaya sekolah yang disiplin, inklusif, dan suportif menciptakan suasana belajar aman, nyaman, serta mendorong prestasi.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
		'badge' => 'orange',
	),
	7 => array(
		'title' => 'Pembinaan Karakter & Akhlak',
		'desc'  => 'Program pembentukan kepribadian, kedisiplinan, spiritual, dan etika bermasyarakat secara berkelanjutan.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>',
		'badge' => 'blue',
	),
	8 => array(
		'title' => 'Sertifikasi & Prestasi',
		'desc'  => 'Kesempatan meraih sertifikasi keahlian terakreditasi dan pendampingan kompetisi hingga tingkat nasional.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
		'badge' => 'orange',
	),
	9 => array(
		'title' => 'Sarana Olahraga & Seni',
		'desc'  => 'Lapangan olahraga representatif, laboratorium musik, dan studio kreatif untuk minat siswa.',
		'svg'   => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>',
		'badge' => 'blue',
	),
);
?>

<!-- BENEFIT SECTION ("Mengapa Memilih Kami?") -->
<section class="section benefit-section">
	<div class="container">
		<?php if ( $eyebrow || $title || $subtitle ) : ?>
			<div class="section-title text-center">
				<?php if ( $eyebrow ) : ?>
					<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $title ) : ?>
					<h2><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!-- SLIDER CONTAINER (Autoplay Kanan & Tanpa Arrow) -->
		<div class="benefit-slider-wrapper">
			<div class="benefit-slider-track" id="benefitTrack">
				<?php for ( $i = 1; $i <= 9; $i++ ) : ?>
					<?php
					$item_title = get_theme_mod( "sekolahku_benefit_item_{$i}_title", $default_items[ $i ]['title'] );
					$item_desc  = get_theme_mod( "sekolahku_benefit_item_{$i}_desc", $default_items[ $i ]['desc'] );
					$item_icon  = get_theme_mod( "sekolahku_benefit_item_{$i}_icon", '' );
					$badge_cls  = $default_items[ $i ]['badge'];
					?>
					<div class="card benefit-card">
						<div class="benefit-icon-badge">
							<?php if ( $item_icon ) : ?>
								<img src="<?php echo esc_url( $item_icon ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" class="benefit-icon-img">
							<?php else : ?>
								<?php echo $default_items[ $i ]['svg']; ?>
							<?php endif; ?>
						</div>
						<h3 class="benefit-card-title"><?php echo esc_html( $item_title ); ?></h3>
						<p class="benefit-card-desc"><?php echo esc_html( $item_desc ); ?></p>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const track = document.getElementById('benefitTrack');
	if (!track) return;

	let autoplayTimer = null;
	const pauseDuration = 3000; // Jeda 3 detik per kartu

	function slideNext() {
		const firstCard = track.children[0];
		if (!firstCard) return;

		const cardWidth = firstCard.offsetWidth + 24; // Lebar kartu + gap 24px

		// Bergeser ke kiri 1 kartu dengan transisi CSS yang mulus
		track.style.transition = 'transform 0.5s ease-in-out';
		track.style.transform = 'translateX(-' + cardWidth + 'px)';

		// Setelah animasi 500ms selesai, matikan transisi dan pindahkan kartu ke posisi akhir
		setTimeout(function() {
			track.style.transition = 'none';
			track.appendChild(firstCard);
			track.style.transform = 'translateX(0)';
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

	// Pause saat hover / touch
	track.addEventListener('mouseenter', stopAutoplay);
	track.addEventListener('mouseleave', startAutoplay);
	track.addEventListener('touchstart', stopAutoplay, { passive: true });
	track.addEventListener('touchend', startAutoplay, { passive: true });

	// Mulai autoplay 3 detik
	startAutoplay();
});
</script>

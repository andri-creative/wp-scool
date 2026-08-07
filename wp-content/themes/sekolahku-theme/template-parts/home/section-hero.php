<?php
/**
 * Section Hero Slider & Stats Bar.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Slide 1 Theme Mods
$hero1_eyebrow  = get_theme_mod( 'sekolahku_hero_eyebrow', 'SEKOLAH UNGGULAN' );
$hero1_title    = get_theme_mod( 'sekolahku_hero_title', 'Membangun Generasi Emas' );
$hero1_subtitle = get_theme_mod( 'sekolahku_hero_subtitle', 'Lingkungan belajar modern dengan tenaga pendidik profesional dan program terarah untuk membentuk karakter, kompetensi, dan kesiapan karier siswa.' );
$hero1_btn_text = get_theme_mod( 'sekolahku_hero_btn_text', 'LIHAT PROGRAM KAMI' );
$hero1_btn_url  = get_theme_mod( 'sekolahku_hero_btn_url', '' );
$hero1_image    = get_theme_mod( 'sekolahku_hero_image', '' );
$hero1_bg       = $hero1_image ? esc_url( $hero1_image ) : get_template_directory_uri() . '/assets/images/hero-1.jpg';
$program_link   = get_post_type_archive_link( 'program' );
$hero1_url      = $hero1_btn_url ? esc_url( $hero1_btn_url ) : esc_url( $program_link );

// Slide 2 Theme Mods
$hero2_eyebrow  = get_theme_mod( 'sekolahku_hero2_eyebrow', 'PENDIDIKAN BERKARAKTER' );
$hero2_title    = get_theme_mod( 'sekolahku_hero2_title', 'Mengembangkan Potensi Terbaik' );
$hero2_subtitle = get_theme_mod( 'sekolahku_hero2_subtitle', 'Fokus pada kreativitas, kepemimpinan, dan nilai-nilai akhlak mulia untuk membekali masa depan generasi penerus bangsa.' );
$hero2_btn_text = get_theme_mod( 'sekolahku_hero2_btn_text', 'LIHAT PROGRAM KAMI' );
$hero2_btn_url  = get_theme_mod( 'sekolahku_hero2_btn_url', '' );
$hero2_image    = get_theme_mod( 'sekolahku_hero2_image', '' );
$hero2_bg       = $hero2_image ? esc_url( $hero2_image ) : get_template_directory_uri() . '/assets/images/hero-2.jpg';
$hero2_url      = $hero2_btn_url ? esc_url( $hero2_btn_url ) : esc_url( $program_link );

// Slide 3 Theme Mods
$hero3_eyebrow  = get_theme_mod( 'sekolahku_hero3_eyebrow', 'FASILITAS MODERN' );
$hero3_title    = get_theme_mod( 'sekolahku_hero3_title', 'Sarana Belajar Lengkap & Kondusif' );
$hero3_subtitle = get_theme_mod( 'sekolahku_hero3_subtitle', 'Didukung ruang kelas multimedia, laboratorium komputer terkini, perpustakaan digital, dan fasilitas olahraga yang representatif.' );
$hero3_btn_text = get_theme_mod( 'sekolahku_hero3_btn_text', 'LIHAT PROGRAM KAMI' );
$hero3_btn_url  = get_theme_mod( 'sekolahku_hero3_btn_url', '' );
$hero3_image    = get_theme_mod( 'sekolahku_hero3_image', '' );
$hero3_bg       = $hero3_image ? esc_url( $hero3_image ) : get_template_directory_uri() . '/assets/images/hero-3.jpg';
$hero3_url      = $hero3_btn_url ? esc_url( $hero3_btn_url ) : esc_url( $program_link );
?>

<!-- HERO SLIDER -->
<section class="hero-slider-section">
	<div class="hero-slider" id="heroSlider">
		<!-- Slide 1 -->
		<div class="hero-slide active" style="background-image: linear-gradient(180deg, rgba(15, 23, 42, 0.2), rgba(15, 23, 42, 0.4)), url('<?php echo $hero1_bg; ?>');">
			<div class="container hero-inner">
				<?php if ( $hero1_eyebrow ) : ?><span class="hero-eyebrow"><?php echo esc_html( $hero1_eyebrow ); ?></span><?php endif; ?>
				<h1><?php echo esc_html( $hero1_title ); ?></h1>
				<p><?php echo esc_html( $hero1_subtitle ); ?></p>
				<?php if ( $hero1_btn_text ) : ?>
					<div class="hero-actions">
						<a href="<?php echo $hero1_url; ?>" class="btn btn-accent btn-slider">
							<span><?php echo esc_html( $hero1_btn_text ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Slide 2 -->
		<div class="hero-slide" style="background-image: linear-gradient(180deg, rgba(15, 23, 42, 0.2), rgba(15, 23, 42, 0.4)), url('<?php echo $hero2_bg; ?>');">
			<div class="container hero-inner">
				<?php if ( $hero2_eyebrow ) : ?><span class="hero-eyebrow"><?php echo esc_html( $hero2_eyebrow ); ?></span><?php endif; ?>
				<h1><?php echo esc_html( $hero2_title ); ?></h1>
				<p><?php echo esc_html( $hero2_subtitle ); ?></p>
				<?php if ( $hero2_btn_text ) : ?>
					<div class="hero-actions">
						<a href="<?php echo $hero2_url; ?>" class="btn btn-accent btn-slider">
							<span><?php echo esc_html( $hero2_btn_text ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Slide 3 -->
		<div class="hero-slide" style="background-image: linear-gradient(180deg, rgba(15, 23, 42, 0.2), rgba(15, 23, 42, 0.4)), url('<?php echo $hero3_bg; ?>');">
			<div class="container hero-inner">
				<?php if ( $hero3_eyebrow ) : ?><span class="hero-eyebrow"><?php echo esc_html( $hero3_eyebrow ); ?></span><?php endif; ?>
				<h1><?php echo esc_html( $hero3_title ); ?></h1>
				<p><?php echo esc_html( $hero3_subtitle ); ?></p>
				<?php if ( $hero3_btn_text ) : ?>
					<div class="hero-actions">
						<a href="<?php echo $hero3_url; ?>" class="btn btn-accent btn-slider">
							<span><?php echo esc_html( $hero3_btn_text ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Navigation Arrows -->
		<button class="slider-arrow prev" id="slidePrev" aria-label="Previous Slide">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
		</button>
		<button class="slider-arrow next" id="slideNext" aria-label="Next Slide">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
		</button>
	</div>

	<!-- STATISTIK (Floats inside slider section) -->
	<div class="stats-bar">
		<div class="container stats-grid stats-grid-5">
			<div class="stat-item">
				<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_akreditasi', 'A' ) ); ?></span>
				<span class="stat-label">Akreditasi</span>
			</div>
			<div class="stat-item">
				<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_siswa', '650+' ) ); ?></span>
				<span class="stat-label">Siswa Aktif</span>
			</div>
			<div class="stat-item">
				<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_guru', '150+' ) ); ?></span>
				<span class="stat-label">Guru &amp; Staf</span>
			</div>
			<div class="stat-item">
				<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_ekskul', '15+' ) ); ?></span>
				<span class="stat-label">Ekstrakurikuler</span>
			</div>
			<div class="stat-item">
				<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_jurusan', '10' ) ); ?></span>
				<span class="stat-label">Jurusan</span>
			</div>
		</div>
	</div>
</section>

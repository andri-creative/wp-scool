<?php
/**
 * Section CTA Pendaftaran Peserta Didik Baru - Foto Siswa Transparan Overlapping di Kiri.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = get_theme_mod( 'sekolahku_cta_eyebrow', 'CTA SECTION' );
$title    = get_theme_mod( 'sekolahku_cta_title', 'Pendaftaran Peserta Didik Baru' );
$subtitle = get_theme_mod( 'sekolahku_cta_subtitle', 'Informasi lengkap mengenai jadwal, persyaratan, dan alur pendaftaran tersedia di sini.' );
$btn_text = get_theme_mod( 'sekolahku_cta_button_text', 'SELENGKAPNYA' );
$btn_url  = get_theme_mod( 'sekolahku_cta_button_url', home_url( '/ppdb/' ) );
$student_img_mod = get_theme_mod( 'sekolahku_cta_image', '' );
if ( is_numeric( $student_img_mod ) ) {
	$student_img = wp_get_attachment_url( $student_img_mod );
} else {
	$student_img = $student_img_mod;
}
if ( ! $student_img ) {
	$student_img = 'https://zekolla.oketheme.com/wp-content/uploads/2024/05/student-cta.png';
}
?>

<!-- CTA SECTION (Latar Belakang Soft #f8fafc) -->
<section class="section cta-section">
	<div class="container">
		<div class="cta-grid">
			<!-- SISI KIRI: FOTO SISWA TRANSPARAN OVERLAPPING (Kepala Siswa Melebihi Batas Atas Section) -->
			<div class="cta-student-col">
				<div class="cta-student-wrap">
					<img src="<?php echo esc_url( $student_img ); ?>" alt="Siswa SMP Pendaftaran Baru" class="cta-student-img">
				</div>
			</div>

			<!-- SISI KANAN: TEKS CTA & TOMBOL SELENGKAPNYA -->
			<div class="cta-content-col">
				<div class="cta-content">
					<?php if ( $eyebrow ) : ?>
						<span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
					<?php endif; ?>
					<?php if ( $title ) : ?>
						<h2 class="cta-title"><?php echo esc_html( $title ); ?></h2>
					<?php endif; ?>
					<?php if ( $subtitle ) : ?>
						<p class="cta-subtitle"><?php echo esc_html( $subtitle ); ?></p>
					<?php endif; ?>
					<div class="cta-action">
						<a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary btn-cta">
							<span><?php echo esc_html( $btn_text ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

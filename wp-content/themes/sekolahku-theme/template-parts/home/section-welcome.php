<?php
/**
 * Section Sambutan Kepala Sekolah.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$welcome_eyebrow = get_theme_mod( 'sekolahku_welcome_eyebrow', 'Sambutan' );
$welcome_title   = get_theme_mod( 'sekolahku_welcome_title', 'Sambutan Kepala Sekolah' );
$welcome_text    = get_theme_mod( 'sekolahku_welcome_text', 'Puji syukur ke hadirat Tuhan YME atas segala rahmat dan karunia-Nya. Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah dengan orang tua, peserta didik, serta masyarakat luas. Melalui media ini, kami berharap seluruh informasi mengenai kegiatan, prestasi, serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.' );
$welcome_name    = get_theme_mod( 'sekolahku_welcome_name', 'Ir. Sherly Puspita, M.Pd' );
$welcome_badge   = get_theme_mod( 'sekolahku_welcome_badge', 'Kepala Sekolah' );
$welcome_image   = get_theme_mod( 'sekolahku_welcome_image', '' );
?>

<!-- SAMBUTAN KEPALA SEKOLAH -->
<section class="section welcome-section">
	<div class="container welcome-grid">
		<div class="welcome-image">
			<div class="welcome-photo-frame">
				<?php if ( $welcome_image ) : ?>
					<img src="<?php echo esc_url( $welcome_image ); ?>" alt="<?php echo esc_attr( $welcome_name ); ?>">
				<?php else : ?>
					<div class="news-thumb-placeholder welcome-placeholder"></div>
				<?php endif; ?>
				<?php if ( $welcome_badge ) : ?>
					<span class="welcome-badge"><?php echo esc_html( $welcome_badge ); ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="welcome-content">
			<?php if ( $welcome_eyebrow ) : ?><span class="eyebrow"><?php echo esc_html( $welcome_eyebrow ); ?></span><?php endif; ?>
			<h2><?php echo esc_html( $welcome_title ); ?></h2>
			<svg class="welcome-quote-icon" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
			<p><?php echo esc_html( $welcome_text ); ?></p>
			<div class="welcome-signature">
				<strong><?php echo esc_html( $welcome_name ); ?></strong>
				<span><?php echo esc_html( $welcome_badge ? $welcome_badge : 'Kepala Sekolah' ); ?></span>
			</div>
		</div>
	</div>
</section>

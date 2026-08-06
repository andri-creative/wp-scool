<?php
/**
 * Fungsi bantuan (template tags) yang dipakai di berbagai template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tampilkan tanggal & kategori sebuah post berita.
 */
function sekolahku_post_meta() {
	echo '<div class="post-meta">';
	echo '<span class="post-date">' . esc_html( get_the_date() ) . '</span>';

	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		echo '<span class="post-cat">' . esc_html( $categories[0]->name ) . '</span>';
	}
	echo '</div>';
}

/**
 * Tampilkan top bar header: telepon, email, dan ikon sosial media.
 * Ikon dibuat manual dalam bentuk SVG sederhana (bukan aset pihak ketiga).
 */
function sekolahku_top_bar() {
	$telepon  = get_theme_mod( 'sekolahku_telepon', '' );
	$email    = get_theme_mod( 'sekolahku_email', '' );

	$socials = array(
		'facebook'  => get_theme_mod( 'sekolahku_social_facebook', '' ),
		'instagram' => get_theme_mod( 'sekolahku_social_instagram', '' ),
		'youtube'   => get_theme_mod( 'sekolahku_social_youtube', '' ),
		'whatsapp'  => get_theme_mod( 'sekolahku_social_whatsapp', '' ),
	);

	$has_social = array_filter( $socials );

	if ( ! $telepon && ! $email && empty( $has_social ) ) {
		return;
	}
	?>
	<div class="top-bar">
		<div class="container top-bar-inner">
			<div class="top-bar-contact">
				<?php if ( $telepon ) : ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $telepon ) ); ?>" class="top-bar-item">
						<?php sekolahku_icon( 'phone' ); ?>
						<span><?php echo esc_html( $telepon ); ?></span>
					</a>
				<?php endif; ?>

				<?php if ( $email ) : ?>
					<a href="mailto:<?php echo esc_attr( $email ); ?>" class="top-bar-item">
						<?php sekolahku_icon( 'mail' ); ?>
						<span><?php echo esc_html( $email ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $has_social ) ) : ?>
				<div class="top-bar-social">
					<?php foreach ( $socials as $name => $url ) : ?>
						<?php if ( $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $name ) ); ?>">
								<?php sekolahku_icon( $name ); ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Render ikon SVG sederhana (dibuat manual, bukan aset/logo pihak ketiga).
 * Bentuknya generik minimalis mewakili tiap platform, aman dipakai bebas.
 */
function sekolahku_icon( $name ) {
	$icons = array(
		'phone' => '<svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>',
		'mail' => '<svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor"><path d="M3 5h18a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm17 2.4-8 5.6-8-5.6V17h16V7.4zM4.5 6l7.5 5.2L19.5 6h-15z"/></svg>',
		'facebook' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14 9h3V6h-3c-2 0-3.5 1.5-3.5 3.5V11H8v3h2.5v6H13v-6h2.4l.6-3H13V9.7c0-.4.3-.7.7-.7z"/></svg>',
		'instagram' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 3c2.5 0 2.8 0 3.8.05 1 .05 1.7.2 2.3.45.6.25 1.1.6 1.6 1.1s.85 1 1.1 1.6c.25.6.4 1.3.45 2.3.05 1 .05 1.3.05 3.8s0 2.8-.05 3.8c-.05 1-.2 1.7-.45 2.3-.25.6-.6 1.1-1.1 1.6s-1 .85-1.6 1.1c-.6.25-1.3.4-2.3.45-1 .05-1.3.05-3.8.05s-2.8 0-3.8-.05c-1-.05-1.7-.2-2.3-.45-.6-.25-1.1-.6-1.6-1.1s-.85-1-1.1-1.6c-.25-.6-.4-1.3-.45-2.3C3 14.8 3 14.5 3 12s0-2.8.05-3.8c.05-1 .2-1.7.45-2.3.25-.6.6-1.1 1.1-1.6s1-.85 1.6-1.1c.6-.25 1.3-.4 2.3-.45C9.2 3 9.5 3 12 3zm0 2c-2.4 0-2.7 0-3.7.05-.8.04-1.3.16-1.6.28-.4.15-.7.34-1 .63-.29.3-.48.6-.63 1-.12.3-.24.8-.28 1.6C4.7 9.3 4.7 9.6 4.7 12s0 2.7.05 3.7c.04.8.16 1.3.28 1.6.15.4.34.7.63 1 .3.29.6.48 1 .63.3.12.8.24 1.6.28 1 .05 1.3.05 3.7.05s2.7 0 3.7-.05c.8-.04 1.3-.16 1.6-.28.4-.15.7-.34 1-.63.29-.3.48-.6.63-1 .12-.3.24-.8.28-1.6.05-1 .05-1.3.05-3.7s0-2.7-.05-3.7c-.04-.8-.16-1.3-.28-1.6a2.7 2.7 0 0 0-.63-1 2.7 2.7 0 0 0-1-.63c-.3-.12-.8-.24-1.6-.28C14.7 5 14.4 5 12 5zm0 3.4a3.6 3.6 0 1 1 0 7.2 3.6 3.6 0 0 1 0-7.2zm0 1.8a1.8 1.8 0 1 0 0 3.6 1.8 1.8 0 0 0 0-3.6zm3.9-2.3a.85.85 0 1 1 0 1.7.85.85 0 0 1 0-1.7z"/></svg>',
		'youtube' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M21.6 7.2s-.2-1.5-.85-2.1c-.8-.85-1.7-.85-2.1-.9C15.9 4 12 4 12 4h0s-3.9 0-6.65.2c-.4.05-1.3.05-2.1.9-.65.6-.85 2.1-.85 2.1S2.2 9 2.2 10.75v1.5C2.2 14 2.4 15.8 2.4 15.8s.2 1.5.85 2.1c.8.85 1.85.8 2.3.9 1.7.15 7.15.2 7.15.2s3.9 0 6.65-.2c.4-.05 1.3-.05 2.1-.9.65-.6.85-2.1.85-2.1s.2-1.75.2-3.5v-1.5c0-1.75-.2-3.55-.2-3.55zM9.8 14.6V8.9l5.6 2.85-5.6 2.85z"/></svg>',
		'whatsapp' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 3a9 9 0 0 0-7.7 13.6L3 21l4.5-1.3A9 9 0 1 0 12 3zm0 1.8a7.2 7.2 0 0 1 6.1 11c-.1.1 0 .3 0 .4l-1 3.6-3.7-1a.5.5 0 0 0-.4 0A7.2 7.2 0 1 1 12 4.8zm-3.3 3.5c-.2 0-.5 0-.7.3-.2.3-.9.9-.9 2.1s.9 2.4 1 2.6c.1.1 1.8 2.8 4.4 3.9 2.1.9 2.5.7 3 .7.4 0 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1-.1-.1-.3-.2-.5-.3l-1.9-.9c-.2-.1-.4-.1-.6.1l-.8 1c-.1.1-.3.2-.5.1-.7-.3-1.5-.8-2.2-1.5-.6-.6-1-1.3-1.2-1.6-.1-.2 0-.4.1-.5l.5-.7c.1-.2.1-.4 0-.6l-.9-2c-.1-.2-.3-.3-.5-.3H8.7z"/></svg>',
	);

	if ( isset( $icons[ $name ] ) ) {
		echo $icons[ $name ]; // phpcs:ignore -- output SVG statis internal, aman.
	}
}

/**
 * Format tanggal "Senin, 15 Agustus 2026" menjadi 3 span sejajar
 * (hari, tanggal besar, bulan+tahun). Tanggal dilepas dengan spasi.
 */
function sekolahku_tanggal_spans( $tanggal ) {
	if ( ! $tanggal ) {
		$tanggal = sekolahku_tanggal_indonesia();
	}
	$parts = preg_split( '/\s+/', trim( $tanggal ) );
	$day   = $parts[0] ?? '';          // "Senin,"
	$num   = $parts[1] ?? '';          // "15"
	$rest  = implode( ' ', array_slice( $parts, 2 ) ); // "Agustus 2026"

	return '<span class="tgl-day">' . esc_html( $day ) . '</span> '
	     . '<span class="tgl-num">' . esc_html( $num ) . '</span> '
	     . '<span class="tgl-rest">' . esc_html( $rest ) . '</span>';
}

/**
 * Kembalikan tanggal dalam bahasa Indonesia: "Senin, 15 Agustus 2026".
 * Menerima format MySQL/datetime apa saja; jika kosong pakai tanggal post aktif.
 * (Tak bergantung pada locale WordPress.)
 */
function sekolahku_tanggal_indonesia( $datetime = null ) {
	if ( $datetime === null || $datetime === '' ) {
		$timestamp = get_the_date( 'U' );
	} elseif ( is_numeric( $datetime ) ) {
		$timestamp = $datetime;
	} else {
		$timestamp = strtotime( $datetime );
		if ( $timestamp === false ) {
			$timestamp = get_the_date( 'U' );
		}
	}

	$hari = array( 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' );
	$bulan = array(
		'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
		'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
	);

	return $hari[ (int) date( 'w', $timestamp ) ] . ', '
	     . date( 'j', $timestamp ) . ' '
	     . $bulan[ (int) date( 'n', $timestamp ) - 1 ] . ' '
	     . date( 'Y', $timestamp );
}

/**
 * Breadcrumb sederhana untuk halaman dalam (Profil, Berita, Galeri, Kontak).
 */
function sekolahku_breadcrumb() {
	echo '<nav class="breadcrumb"><div class="container">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">Beranda</a> / ';

	if ( is_singular( 'post' ) ) {
		echo '<a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '">Berita</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'post' ) || is_home() ) {
		echo '<span>Berita</span>';
	} elseif ( is_page() ) {
		echo '<span>' . esc_html( get_the_title() ) . '</span>';
	}

	echo '</div></nav>';
}

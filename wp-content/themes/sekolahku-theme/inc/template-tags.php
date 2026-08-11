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
 * Breadcrumb lengkap & global untuk seluruh halaman tema SekolahKu.
 */
function sekolahku_breadcrumb() {
	if ( is_front_page() ) {
		return;
	}

	echo '<div class="staf-breadcrumb-bar"><div class="container"><nav class="breadcrumb">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">Beranda</a> / ';

	if ( is_singular( 'staf' ) ) {
		$staf_title       = get_the_title();
		// Hapus gelar akademik setelah koma (mis. , S.Pd) khusus untuk breadcrumb
		$staf_title_clean = preg_replace( '/,.*$/', '', $staf_title );
		echo '<a href="' . esc_url( get_post_type_archive_link( 'staf' ) ) . '">Staf & Guru</a> / <span>' . esc_html( trim( $staf_title_clean ) ) . '</span>';
	} elseif ( is_post_type_archive( 'staf' ) ) {
		echo '<span>Staf & Guru</span>';
	} elseif ( is_singular( 'ekskul' ) ) {
		echo '<a href="' . esc_url( get_post_type_archive_link( 'ekskul' ) ) . '">Ekstrakurikuler</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'ekskul' ) ) {
		echo '<span>Ekstrakurikuler</span>';
	} elseif ( is_singular( 'fasilitas' ) ) {
		echo '<a href="' . esc_url( home_url( '/fasilitas/' ) ) . '">Fasilitas Sekolah</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'fasilitas' ) ) {
		echo '<span>Fasilitas Sekolah</span>';
	} elseif ( is_singular( 'program' ) ) {
		echo '<a href="' . esc_url( home_url( '/program/' ) ) . '">Program</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'program' ) || is_page( 'program' ) || ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], 'program' ) !== false && ! is_singular( 'program' ) ) ) {
		echo '<span>Program</span>';
	} elseif ( is_singular( 'galeri' ) ) {
		echo '<a href="' . esc_url( home_url( '/galeri/' ) ) . '">Galeri</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'galeri' ) || is_page( 'galeri' ) || ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], 'galeri' ) !== false && ! is_singular( 'galeri' ) ) ) {
		echo '<span>Galeri</span>';
	} elseif ( is_singular( 'pengumuman' ) ) {
		echo '<a href="' . esc_url( home_url( '/pengumuman/' ) ) . '">Pengumuman</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'pengumuman' ) ) {
		echo '<span>Pengumuman</span>';
	} elseif ( is_singular( 'agenda' ) ) {
		echo '<a href="' . esc_url( home_url( '/agenda/' ) ) . '">Agenda</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'agenda' ) ) {
		echo '<span>Agenda</span>';
	} elseif ( is_singular( 'post' ) ) {
		echo '<a href="' . esc_url( home_url( '/berita/' ) ) . '">Berita</a> / <span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_post_type_archive( 'post' ) || is_home() || is_page( 'berita' ) || ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], 'berita' ) !== false && ! is_singular( 'post' ) ) ) {
		echo '<span>Berita</span>';
	} elseif ( is_page() ) {
		echo '<span>' . esc_html( get_the_title() ) . '</span>';
	} else {
		echo '<span>' . esc_html( get_the_title() ) . '</span>';
	}
	echo '</nav></div></div>';
	?>
	<style>
	.staf-breadcrumb-bar {
		background: #f8fafc;
		border-bottom: 1px solid #e2e8f0;
		padding: 10px 0;
		margin-bottom: 24px;
		font-size: 13.5px;
		color: #64748b;
		position: relative;
		z-index: 1;
	}
	.staf-breadcrumb-bar a {
		color: #475569;
		text-decoration: none;
	}
	.staf-breadcrumb-bar a:hover {
		color: #0284c7;
	}
	.staf-breadcrumb-bar nav.breadcrumb {
		margin: 0;
		padding: 0;
		background: transparent;
	}
	</style>
	<?php
}

/**
 * Helper function untuk mengkonversi tanggal PHP/WP ke Format Bahasa Indonesia 100% Murni.
 * Contoh: 'Sunday, 9 August 2026' -> 'Minggu, 9 Agustus 2026'
 */
function sekolahku_format_indo_date( $date_input = null ) {
	if ( empty( $date_input ) ) {
		$timestamp = current_time( 'timestamp' );
	} elseif ( is_numeric( $date_input ) ) {
		$timestamp = (int) $date_input;
	} else {
		$timestamp = strtotime( $date_input );
	}

	if ( ! $timestamp ) {
		return $date_input;
	}

	$days = array(
		'Sunday'    => 'Minggu',
		'Monday'    => 'Senin',
		'Tuesday'   => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday'  => 'Kamis',
		'Friday'    => 'Jumat',
		'Saturday'  => 'Sabtu',
	);

	$months = array(
		'January'   => 'Januari',
		'February'  => 'Februari',
		'March'     => 'Maret',
		'April'     => 'April',
		'May'       => 'Mei',
		'June'      => 'Juni',
		'July'      => 'Juli',
		'August'    => 'Agustus',
		'September' => 'September',
		'October'   => 'Oktober',
		'November'  => 'November',
		'December'  => 'Desember',
	);

	$day_en   = date( 'l', $timestamp );
	$month_en = date( 'F', $timestamp );
	$day_num  = date( 'j', $timestamp );
	$year     = date( 'Y', $timestamp );

	$day_id   = isset( $days[ $day_en ] ) ? $days[ $day_en ] : $day_en;
	$month_id = isset( $months[ $month_en ] ) ? $months[ $month_en ] : $month_en;

	return $day_id . ', ' . $day_num . ' ' . $month_id . ' ' . $year;
}

/**
 * Custom Comment Callback untuk merender komentar secara bersih & modern.
 */
function sekolahku_comment_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$avatar_url = get_avatar_url( $comment, array( 'size' => 64 ) );
	if ( empty( $avatar_url ) || false !== strpos( $avatar_url, 'gravatar.com/avatar/?s=' ) ) {
		$avatar_url = 'https://ui-avatars.com/api/?name=' . rawurlencode( get_comment_author() ) . '&background=0284c7&color=fff&size=64';
	}
	?>
	<li <?php comment_class( 'comment-item-wrapper' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-card-box">
			<div class="comment-avatar">
				<img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php comment_author(); ?>">
			</div>
			<div class="comment-content-wrap">
				<div class="comment-header-info">
					<h4 class="comment-author-name"><?php comment_author_link(); ?></h4>
					<span class="comment-date-time">
						<?php echo esc_html( sekolahku_tanggal_indonesia( get_comment_date( 'Y-m-d H:i:s' ) ) ); ?> pukul <?php echo esc_html( get_comment_time( 'H:i' ) ); ?>
					</span>
				</div>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation">
						Komentar Anda sedang dalam proses peninjauan (moderasi).
					</p>
				<?php endif; ?>
				<div class="comment-text-body">
					<?php comment_text(); ?>
				</div>
				<div class="comment-reply-action">
					<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' => 'Balas &raquo;',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
					) ) );
					?>
				</div>
			</div>
		</div>
	<?php
}


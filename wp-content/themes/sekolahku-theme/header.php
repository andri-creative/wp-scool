<?php
/**
 * Template header - dipakai di semua halaman.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php sekolahku_top_bar(); ?>

<div class="site-header-wrapper">
<header class="site-header" style="opacity: 0;">
	<!-- Baris Atas (Header Top) -->
	<div class="header-top-row">
		<div class="container header-top-inner">
			<!-- Mobile Nav Toggle -->
			<button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>

			<!-- Logo Area -->
			<div class="site-logo">
				<?php 
			if ( has_custom_logo() ) : 
				echo get_custom_logo();
			else : 
			?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="https://placehold.co/50x50/1d4ed8/ffffff?text=LOGO" alt="Logo Placeholder" width="50" height="50" class="logo-img-placeholder">
				</a>
			<?php endif; ?>
			</div>

			<!-- Search Bar -->
			<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="search-input-wrapper">
					<svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					<input type="search" class="search-field" placeholder="Cari informasi sekolah..." value="<?php echo get_search_query(); ?>" name="s" />
				</div>
				<button type="submit" class="search-submit">Cari</button>
			</form>

			<!-- Actions & Info -->
			<div class="header-top-actions">
				<?php 
				$telepon = get_theme_mod( 'sekolahku_telepon', '0851-2222-3333' );
				if ( $telepon ) : 
				?>
					<div class="header-contact-info">
						<svg class="phone-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
						<div class="contact-text">
							<span class="contact-label">HUBUNGI KAMI 24/7</span>
							<span class="contact-number"><?php echo esc_html( $telepon ); ?></span>
						</div>
					</div>
				<?php endif; ?>

				<!-- Language Switcher (Toggle) -->
				<?php 
				$current_lang = isset($_GET['lang']) ? sanitize_text_field($_GET['lang']) : 'id';
				if ( $current_lang === 'id' ) : ?>
					<div class="header-lang-switcher">
						<a href="?lang=en" class="lang-btn" title="Switch to English">🇬🇧</a>
					</div>
				<?php else : ?>
					<div class="header-lang-switcher">
						<a href="?lang=id" class="lang-btn" title="Ubah ke Bahasa Indonesia">🇮🇩</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Baris Bawah (Header Bottom / Navigation) -->
	<div class="header-bottom-row">
		<div class="container header-bottom-inner">
			<!-- Program Dropdown / Button -->
			<div class="header-program-dropdown">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>" class="program-dropdown-btn">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
					<span>Program Sekolah</span>
				</a>
			</div>

			<!-- Navigation Menu -->
			<nav class="site-nav" id="site-nav">
				<button type="button" class="drawer-close-btn" id="drawerClose" aria-label="Tutup menu">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-menu',
					'fallback_cb'    => 'sekolahku_fallback_menu',
				) );
				?>
			</nav>

		</div>
	</div>
</header>
</div>

<?php
/**
 * Menu fallback jika belum diatur di Appearance > Menus.
 */
function sekolahku_fallback_menu() {
	$is_home       = is_front_page() || is_home();
	$is_pengumuman = is_post_type_archive( 'pengumuman' ) || is_singular( 'pengumuman' );
	$is_agenda     = is_post_type_archive( 'agenda' ) || is_singular( 'agenda' );
	$is_berita     = is_post_type_archive( 'post' ) || is_singular( 'post' ) || is_category() || is_tag();
	$is_info       = $is_pengumuman || $is_agenda || $is_berita;
	$is_staf       = is_post_type_archive( 'staf' ) || is_singular( 'staf' );
	$is_fasilitas  = is_post_type_archive( 'fasilitas' ) || is_singular( 'fasilitas' );
	$is_ekskul     = is_post_type_archive( 'ekskul' ) || is_singular( 'ekskul' );
	$is_galeri     = is_page( 'galeri' ) || is_post_type_archive( 'galeri' ) || is_singular( 'galeri' );
	$is_profil     = is_page( 'profil-sekolah' ) || is_page( 'profil' );

	echo '<ul class="primary-menu">';
	echo '<li class="' . ( $is_home ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( home_url( '/' ) ) . '">Beranda</a></li>';
	echo '<li class="menu-item-has-children ' . ( $is_info ? 'current-menu-ancestor active' : '' ) . '"><a href="#">Informasi</a><ul class="sub-menu">';
	echo '<li class="' . ( $is_pengumuman ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'pengumuman' ) ) . '">Pengumuman</a></li>';
	echo '<li class="' . ( $is_agenda ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'agenda' ) ) . '">Agenda</a></li>';
	echo '<li class="' . ( $is_berita ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '">Berita</a></li>';
	echo '</ul></li>';
	echo '<li class="' . ( $is_staf ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'staf' ) ) . '">Staf &amp; Guru</a></li>';
	echo '<li class="' . ( $is_fasilitas ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'fasilitas' ) ) . '">Fasilitas</a></li>';
	echo '<li class="' . ( $is_ekskul ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'ekskul' ) ) . '">Ekstrakurikuler</a></li>';
	echo '<li class="' . ( $is_galeri ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( home_url( '/galeri/' ) ) . '">Foto &amp; Video</a></li>';
	echo '<li class="' . ( $is_profil ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( home_url( '/profil-sekolah/' ) ) . '">Profil Sekolah</a></li>';
	echo '</ul>';
}

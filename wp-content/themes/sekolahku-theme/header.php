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

<div class="site-header-wrapper">
	<!-- Baris 1: Top Bar (Transparan Paling Atas, Telepon/Email & Ikon Medsos Mini) -->
	<div class="header-announcement-bar">
		<div class="container header-announcement-inner">
			<div class="header-announcement-left">
				<?php 
				$telepon = get_theme_mod( 'sekolahku_telepon', '+184 1234-5678 99' );
				$email   = get_theme_mod( 'sekolahku_email', 'info@sekolahku.sch.id' );
				?>
				<span class="top-info-item">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
					<span><?php echo esc_html( $telepon ); ?></span>
				</span>
				<span class="top-info-sep">|</span>
				<span class="top-info-item">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					<span><?php echo esc_html( $email ); ?></span>
				</span>
			</div>
			<div class="header-announcement-right">
				<a href="<?php echo esc_url( get_theme_mod( 'sekolahku_facebook', '#' ) ); ?>" class="top-social-icon" title="Facebook" target="_blank" rel="noopener">
					<svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'sekolahku_instagram', '#' ) ); ?>" class="top-social-icon" title="Instagram" target="_blank" rel="noopener">
					<svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'sekolahku_youtube', '#' ) ); ?>" class="top-social-icon" title="YouTube" target="_blank" rel="noopener">
					<svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 1.96A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-1.96 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33zM9.75 15.02V8.48l5.75 3.27-5.75 3.27z"/></svg>
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'sekolahku_whatsapp', '#' ) ); ?>" class="top-social-icon" title="WhatsApp" target="_blank" rel="noopener">
					<svg width="13" height="13" viewBox="0 0 360 362" fill="none"><path fill="currentColor" fill-rule="evenodd" d="M307.546 52.566C273.709 18.684 228.706.017 180.756 0 81.951 0 1.538 80.404 1.504 179.235c-.017 31.594 8.242 62.432 23.928 89.609L0 361.736l95.024-24.925c26.179 14.285 55.659 21.805 85.655 21.814h.077c98.788 0 179.21-80.413 179.244-179.244.017-47.898-18.608-92.926-52.454-126.807v-.008Zm-126.79 275.788h-.06c-26.73-.008-52.952-7.194-75.831-20.765l-5.44-3.231-56.391 14.791 15.05-54.981-3.542-5.638c-14.912-23.721-22.793-51.139-22.776-79.286.035-82.14 66.867-148.973 149.051-148.973 39.793.017 77.198 15.53 105.328 43.695 28.131 28.157 43.61 65.596 43.593 105.398-.035 82.149-66.867 148.982-148.982 148.982v.008Zm81.719-111.577c-4.478-2.243-26.497-13.073-30.606-14.568-4.108-1.496-7.09-2.243-10.073 2.243-2.982 4.487-11.568 14.577-14.181 17.559-2.613 2.991-5.226 3.361-9.704 1.117-4.477-2.243-18.908-6.97-36.02-22.226-13.313-11.878-22.304-26.54-24.916-31.027-2.613-4.486-.275-6.91 1.959-9.136 2.011-2.011 4.478-5.234 6.721-7.847 2.244-2.613 2.983-4.486 4.478-7.469 1.496-2.991.748-5.603-.369-7.847-1.118-2.243-10.073-24.289-13.812-33.253-3.636-8.732-7.331-7.546-10.073-7.692-2.613-.13-5.595-.155-8.586-.155-2.991 0-7.839 1.118-11.947 5.604-4.108 4.486-15.677 15.324-15.677 37.361s16.047 43.344 18.29 46.335c2.243 2.991 31.585 48.225 76.51 67.632 10.684 4.615 19.029 7.374 25.535 9.437 10.727 3.412 20.49 2.931 28.208 1.779 8.604-1.289 26.498-10.838 30.228-21.298 3.73-10.46 3.73-19.433 2.613-21.298-1.117-1.865-4.108-2.991-8.586-5.234l.008-.017Z" clip-rule="evenodd"/></svg>
				</a>
			</div>
		</div>
	</div>

	<!-- Background Belakang Khusus Baris 2 & Baris 3 -->
	<div class="header-card-wrapper">
		<header class="site-header">
			<!-- Baris 2: Middle Row (Logo, Search Bar Oval, & Dark/Light Switcher) -->
			<div class="header-top-row">
				<div class="container header-top-inner">
					<!-- Mobile Nav Toggle -->
					<button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
						<span></span><span></span><span></span>
					</button>

					<!-- Logo Area (Standard WordPress Custom Logo from WP Admin) -->
					<div class="site-logo">
						<?php 
						if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : 
							the_custom_logo();
						else : 
						?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-brand">
								<span class="logo-icon-box">🎓</span>
								<div class="logo-text-group">
									<span class="logo-main-text"><?php bloginfo( 'name' ); ?></span>
									<span class="logo-sub-text"><?php bloginfo( 'description' ); ?></span>
								</div>
							</a>
						<?php endif; ?>
					</div>

					<!-- Search Bar Oval (Tengah) -->
					<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="search-input-wrapper">
							<svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							<input type="search" class="search-field" id="headerSearchInput" placeholder="Cari berita, program, staf, fasilitas..." value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
							<div class="live-search-dropdown" id="liveSearchDropdown"></div>
						</div>
						<button type="submit" class="search-submit">Search</button>
					</form>

					<!-- Switch Dark / Light Mode (Kanan Baris 2) -->
					<div class="header-top-actions">
						<div class="header-theme-toggle">
							<button type="button" class="theme-toggle-btn" id="themeToggle" aria-label="Ubah Mode Gelap / Terang" title="Ubah Mode Gelap / Terang">
								<!-- Ikon Bulan (Dark Mode) -->
								<span class="theme-icon-dark">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
									</svg>
								</span>
								<!-- Ikon Matahari (Light Mode) -->
								<span class="theme-icon-light" style="display:none;">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<circle cx="12" cy="12" r="5"/>
										<line x1="12" y1="1" x2="12" y2="3"/>
										<line x1="12" y1="21" x2="12" y2="23"/>
										<line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
										<line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
										<line x1="1" y1="12" x2="3" y2="12"/>
										<line x1="21" y1="12" x2="23" y2="12"/>
										<line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
										<line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
									</svg>
								</span>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Baris 3: Bottom Navigation Bar (Bar Melayang Biru Motif Wajik) -->
			<div class="header-bottom-row">
				<div class="container header-bottom-inner">
					<!-- Program Dropdown / Button -->
					<div class="header-program-dropdown">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>" class="program-dropdown-btn">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
							<span>Program Sekolah</span>
						</a>
					</div>

					<!-- Pembatas Garis Vertikal -->
					<div class="nav-divider"></div>

					<!-- Navigation Menu (Tengah) -->
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
</div>

<script>
(function() {
	function initStickyHeader() {
		var headerBottom = document.querySelector( '.header-bottom-row' );
		if ( !headerBottom ) return;
		
		function onScroll() {
			if ( window.scrollY > 120 ) {
				headerBottom.classList.add( 'is-sticky' );
			} else {
				headerBottom.classList.remove( 'is-sticky' );
			}
		}
		
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}
	
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initStickyHeader );
	} else {
		initStickyHeader();
	}
})();
</script>

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
	$berita_link   = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/berita/' );
	echo '<li class="' . ( $is_berita ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( $berita_link ) . '">Berita</a></li>';
	echo '</ul></li>';
	echo '<li class="' . ( $is_staf ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'staf' ) ) . '">Staf &amp; Guru</a></li>';
	echo '<li class="' . ( $is_fasilitas ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'fasilitas' ) ) . '">Fasilitas</a></li>';
	echo '<li class="' . ( $is_ekskul ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( get_post_type_archive_link( 'ekskul' ) ) . '">Ekstrakurikuler</a></li>';
	echo '<li class="' . ( $is_galeri ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( home_url( '/galeri/' ) ) . '">Foto &amp; Video</a></li>';
	echo '<li class="' . ( $is_profil ? 'current-menu-item active' : '' ) . '"><a href="' . esc_url( home_url( '/profil-sekolah/' ) ) . '">Profil Sekolah</a></li>';
	echo '</ul>';
}

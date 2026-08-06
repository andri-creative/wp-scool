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

<header class="site-header">
	<div class="container site-header-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="site-logo-text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<nav class="site-nav" id="site-nav">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'primary-menu',
				'fallback_cb'    => 'sekolahku_fallback_menu',
			) );
			?>
		</nav>

		<div class="site-header-actions">
			<a href="<?php echo esc_url( home_url( '/ppdb-kontak/' ) ); ?>" class="btn btn-accent">Daftar PPDB</a>
			<button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<?php
/**
 * Menu fallback jika belum diatur di Appearance > Menus.
 */
function sekolahku_fallback_menu() {
	echo '<ul class="primary-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Beranda</a></li>';
	echo '<li class="menu-item-has-children"><a href="#">Informasi</a><ul class="sub-menu">';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'pengumuman' ) ) . '">Pengumuman</a></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'agenda' ) ) . '">Agenda</a></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '">Berita</a></li>';
	echo '</ul></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'program' ) ) . '">Program</a></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'staf' ) ) . '">Staf &amp; Guru</a></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'fasilitas' ) ) . '">Fasilitas</a></li>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'ekskul' ) ) . '">Ekstrakurikuler</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/galeri/' ) ) . '">Foto &amp; Video</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/ppdb-kontak/' ) ) . '">PPDB</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/profil-sekolah/' ) ) . '">Profil Sekolah</a></li>';
	echo '</ul>';
}

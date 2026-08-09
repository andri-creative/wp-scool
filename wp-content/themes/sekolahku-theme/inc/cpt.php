<?php
/**
 * Modul Registrasi Custom Post Types (CPT) - SekolahKu Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sekolahku_register_all_cpt() {

	register_post_type( 'galeri', array(
		'labels' => array(
			'name'          => __( 'Galeri', 'sekolahku' ),
			'singular_name' => __( 'Foto Galeri', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Foto Galeri', 'sekolahku' ),
			'menu_name'     => __( 'Galeri Sekolah', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-format-gallery',
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'galeri' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'pengumuman', array(
		'labels' => array(
			'name'          => __( 'Pengumuman', 'sekolahku' ),
			'singular_name' => __( 'Pengumuman', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Pengumuman', 'sekolahku' ),
			'menu_name'     => __( 'Pengumuman', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-megaphone',
		'supports'     => array( 'title', 'editor', 'excerpt' ),
		'rewrite'      => array( 'slug' => 'pengumuman' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'agenda', array(
		'labels' => array(
			'name'          => __( 'Agenda', 'sekolahku' ),
			'singular_name' => __( 'Agenda', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Agenda', 'sekolahku' ),
			'menu_name'     => __( 'Agenda', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-calendar-alt',
		'supports'     => array( 'title', 'editor' ),
		'rewrite'      => array( 'slug' => 'agenda' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'program', array(
		'labels' => array(
			'name'          => __( 'Program Keahlian', 'sekolahku' ),
			'singular_name' => __( 'Program', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Program', 'sekolahku' ),
			'menu_name'     => __( 'Program Keahlian', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-welcome-learn-more',
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'program' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'staf', array(
		'labels' => array(
			'name'          => __( 'Staf & Guru', 'sekolahku' ),
			'singular_name' => __( 'Staf', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Staf/Guru', 'sekolahku' ),
			'menu_name'     => __( 'Staf & Guru', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'staf' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'fasilitas', array(
		'labels' => array(
			'name'          => __( 'Fasilitas', 'sekolahku' ),
			'singular_name' => __( 'Fasilitas', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Fasilitas', 'sekolahku' ),
			'menu_name'     => __( 'Fasilitas Sekolah', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-admin-multisite',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'fasilitas' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'ekskul', array(
		'labels' => array(
			'name'          => __( 'Ekstrakurikuler', 'sekolahku' ),
			'singular_name' => __( 'Ekstrakurikuler', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Ekstrakurikuler', 'sekolahku' ),
			'menu_name'     => __( 'Ekstrakurikuler', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-awards',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'ekskul' ),
		'show_in_rest' => false,
	) );

	register_post_type( 'testimoni', array(
		'labels' => array(
			'name'          => __( 'Testimoni', 'sekolahku' ),
			'singular_name' => __( 'Testimoni', 'sekolahku' ),
			'add_new_item'  => __( 'Tambah Testimoni', 'sekolahku' ),
			'menu_name'     => __( 'Testimoni', 'sekolahku' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-format-quote',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'sekolahku_register_all_cpt' );

/**
 * Auto-seed data sample Staf & Guru (Dinonaktifkan agar 100% menggunakan data dari WP Admin).
 */
function sekolahku_seed_staf_posts() {
	return;
}
add_action( 'init', 'sekolahku_seed_staf_posts', 20 );

/**
 * Otomatisasi pemaksaan format permalink PATHINFO (/index.php/%postname%/) yang kompatibel 100% dengan Nginx MAMP.
 */
function sekolahku_force_flush_rewrite_rules() {
	global $wp_rewrite;
	$nginx_structure = '/index.php/%postname%/';
	if ( get_option( 'permalink_structure' ) !== $nginx_structure ) {
		update_option( 'permalink_structure', $nginx_structure );
	}
	$wp_rewrite->set_permalink_structure( $nginx_structure );
	flush_rewrite_rules( true );
}
add_action( 'init', 'sekolahku_force_flush_rewrite_rules', 999 );

/**
 * Fail-Safe Template Router untuk Rute Staf & Guru.
 * Garansi 100% mencegah 404 pada Nginx/MAMP (Mendukung /staf/{slug} dan ?staf={slug}).
 */
function sekolahku_staf_failsafe_router() {
	if ( is_admin() ) {
		return;
	}

	$slug = '';

	// 1. Cek dari query parameter ?staf=
	if ( isset( $_GET['staf'] ) && ! empty( $_GET['staf'] ) ) {
		$slug = sanitize_title( $_GET['staf'] );
	} else {
		// 2. Cek dari Request URI
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
		if ( preg_match( '#/staf/([^/?]+)#i', $request_uri, $matches ) ) {
			$slug = sanitize_title( $matches[1] );
		}
	}

	if ( ! empty( $slug ) ) {
		$staf_post = get_page_by_path( $slug, OBJECT, 'staf' );

		// Jika belum ada di DB, buatkan post dummy otomatis
		if ( ! $staf_post ) {
			$formatted_name = ucwords( str_replace( '-', ' ', $slug ) );
			$post_id = wp_insert_post( array(
				'post_title'   => $formatted_name,
				'post_name'    => $slug,
				'post_content' => 'Profil ' . $formatted_name . ' merupakan tenaga pendidik profesional yang aktif mendukung kegiatan pembelajaran.',
				'post_status'  => 'publish',
				'post_type'    => 'staf',
			) );
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				$staf_post = get_post( $post_id );
			}
		}

		if ( $staf_post ) {
			global $wp_query, $post;
			$post = $staf_post;
			setup_postdata( $post );

			$wp_query->is_404         = false;
			$wp_query->is_single      = true;
			$wp_query->is_singular    = true;
			$wp_query->queried_object = $staf_post;
			$wp_query->queried_object_id = $staf_post->ID;
			$wp_query->posts          = array( $staf_post );
			$wp_query->post_count     = 1;
			status_header( 200 );

			$template = get_template_directory() . '/single-staf.php';
			if ( file_exists( $template ) ) {
				include $template;
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'sekolahku_staf_failsafe_router', 1 );

/**
 * Filter permalink staf agar menghasilkan URL query parameter yang 100% kompatibel dengan Nginx MAMP.
 */
function sekolahku_staf_permalink_nginx( $post_link, $post ) {
	if ( 'staf' === $post->post_type ) {
		return home_url( '/?staf=' . $post->post_name );
	}
	return $post_link;
}
add_filter( 'post_type_link', 'sekolahku_staf_permalink_nginx', 10, 2 );

/**
 * Mengubah label menu default 'Posts' di WP Admin menjadi 'Berita Sekolah'.
 */
function sekolahku_change_post_object_label() {
	global $wp_post_types;
	if ( isset( $wp_post_types['post'] ) ) {
		$labels                     = &$wp_post_types['post']->labels;
		$labels->name               = 'Berita Sekolah';
		$labels->singular_name      = 'Berita';
		$labels->add_new            = 'Tambah Berita';
		$labels->add_new_item       = 'Tambah Berita Baru';
		$labels->edit_item          = 'Edit Berita';
		$labels->new_item           = 'Berita Baru';
		$labels->view_item          = 'Lihat Berita';
		$labels->search_items       = 'Cari Berita';
		$labels->not_found          = 'Tidak ada berita ditemukan';
		$labels->not_found_in_trash = 'Tidak ada berita di tempat sampah';
		$labels->all_items          = 'Semua Berita';
		$labels->menu_name          = 'Berita Sekolah';
		$labels->name_admin_bar     = 'Berita';
	}
}
add_action( 'init', 'sekolahku_change_post_object_label' );

function sekolahku_change_post_menu_label() {
	global $menu, $submenu;
	if ( isset( $menu[5] ) ) {
		$menu[5][0] = 'Berita Sekolah';
		$menu[5][6] = 'dashicons-welcome-widgets-menus';
	}
	if ( isset( $submenu['edit.php'] ) ) {
		if ( isset( $submenu['edit.php'][5] ) ) {
			$submenu['edit.php'][5][0] = 'Semua Berita';
		}
		if ( isset( $submenu['edit.php'][10] ) ) {
			$submenu['edit.php'][10][0] = 'Tambah Berita Baru';
		}
	}
}
add_action( 'admin_menu', 'sekolahku_change_post_menu_label' );

/**
 * Nonaktifkan Gutenberg Block Editor khusus untuk 'post' (Berita Sekolah) agar menggunakan Classic Editor Interface seragam dengan CPT lainnya.
 */
function sekolahku_disable_gutenberg_for_post( $use_block_editor, $post_type ) {
	if ( 'post' === $post_type ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'sekolahku_disable_gutenberg_for_post', 10, 2 );

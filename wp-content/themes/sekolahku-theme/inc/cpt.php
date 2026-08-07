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
		'show_in_rest' => true,
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
		'show_in_rest' => true,
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

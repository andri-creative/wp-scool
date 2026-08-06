<?php
/**
 * Pengaturan tema lewat WordPress Customizer bawaan (Appearance > Customize).
 * Ini menggantikan "panel theme options" custom seperti pada tema premium
 * pada umumnya, tapi murni pakai API inti WordPress (tanpa plugin tambahan).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sekolahku_customize_register( $wp_customize ) {

	// Section: Hero / Beranda.
	$wp_customize->add_section( 'sekolahku_hero', array(
		'title'    => __( 'Hero Beranda', 'sekolahku' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'sekolahku_hero_title', array(
		'default'           => 'Membentuk Generasi Cerdas, Berkarakter, dan Siap Masa Depan',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_title', array(
		'label'   => __( 'Judul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_subtitle', array(
		'default'           => 'Sekolah dengan kurikulum modern, guru berpengalaman, dan fasilitas lengkap untuk mendukung tumbuh kembang siswa.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_subtitle', array(
		'label'   => __( 'Subjudul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_hero_image', array(
		'label'   => __( 'Gambar Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
	) ) );

	// Section: Statistik singkat (jumlah siswa, guru, prestasi, dll).
	$wp_customize->add_section( 'sekolahku_stats', array(
		'title'    => __( 'Statistik Sekolah', 'sekolahku' ),
		'priority' => 31,
	) );

	$stats_defaults = array(
		'akreditasi' => 'A',
		'siswa'      => '650+',
		'guru'       => '150+',
		'ekskul'     => '15+',
		'jurusan'    => '10',
	);

	foreach ( $stats_defaults as $key => $default ) {
		$wp_customize->add_setting( 'sekolahku_stat_' . $key, array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'sekolahku_stat_' . $key, array(
			'label'   => ucfirst( $key ),
			'section' => 'sekolahku_stats',
			'type'    => 'text',
		) );
	}

	// Section: Sambutan Kepala Sekolah.
	$wp_customize->add_section( 'sekolahku_welcome', array(
		'title'    => __( 'Sambutan Kepala Sekolah', 'sekolahku' ),
		'priority' => 31,
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_text', array(
		'default'           => 'Selamat datang di website resmi sekolah kami. Kami berkomitmen menghadirkan pendidikan berkualitas yang membentuk siswa unggul secara akademik maupun karakter, siap menghadapi tantangan masa depan.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_text', array(
		'label'   => __( 'Teks Sambutan', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_name', array(
		'default'           => 'Nama Kepala Sekolah, M.Pd',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_name', array(
		'label'   => __( 'Nama Kepala Sekolah', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_welcome_image', array(
		'label'   => __( 'Foto Kepala Sekolah', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
	) ) );

	// Section: Info Kontak / PPDB.
	$wp_customize->add_section( 'sekolahku_contact', array(
		'title'    => __( 'Info Kontak & PPDB', 'sekolahku' ),
		'priority' => 32,
	) );

	$contact_fields = array(
		'alamat'   => 'Jl. Pendidikan No. 1, Kota Anda',
		'telepon'  => '0851-2222-3333',
		'email'    => 'info@sekolahku.sch.id',
		'jam'      => 'Senin - Jumat, 07.00 - 15.00',
	);

	foreach ( $contact_fields as $key => $default ) {
		$wp_customize->add_setting( 'sekolahku_' . $key, array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'sekolahku_' . $key, array(
			'label'   => ucfirst( $key ),
			'section' => 'sekolahku_contact',
			'type'    => 'text',
		) );
	}

	// Section: Sosial Media (dipakai di top bar header).
	$wp_customize->add_section( 'sekolahku_social', array(
		'title'    => __( 'Sosial Media', 'sekolahku' ),
		'priority' => 33,
		'description' => __( 'Isi link akun sosial media sekolah. Kosongkan jika tidak ingin menampilkan ikon tertentu.', 'sekolahku' ),
	) );

	$social_fields = array(
		'facebook'  => 'https://facebook.com/',
		'instagram' => 'https://instagram.com/',
		'youtube'   => 'https://youtube.com/',
		'whatsapp'  => 'https://wa.me/6285122223333',
	);

	foreach ( $social_fields as $key => $default ) {
		$wp_customize->add_setting( 'sekolahku_social_' . $key, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'sekolahku_social_' . $key, array(
			'label'   => ucfirst( $key ),
			'section' => 'sekolahku_social',
			'type'    => 'url',
		) );
	}

	// Warna utama tema.
	$wp_customize->add_setting( 'sekolahku_color_primary', array(
		'default'           => '#1d4ed8',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sekolahku_color_primary', array(
		'label'   => __( 'Warna Utama', 'sekolahku' ),
		'section' => 'colors',
	) ) );
}
add_action( 'customize_register', 'sekolahku_customize_register' );

/**
 * Terapkan warna utama dari Customizer sebagai CSS variable inline.
 */
function sekolahku_customizer_css() {
	$primary = get_theme_mod( 'sekolahku_color_primary', '#1d4ed8' );
	echo '<style>:root{--color-primary:' . esc_attr( $primary ) . ';}</style>';
}
add_action( 'wp_head', 'sekolahku_customizer_css' );

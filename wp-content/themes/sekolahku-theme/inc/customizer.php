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
		'title'       => __( 'Hero Beranda', 'sekolahku' ),
		'description' => __( 'Atur judul, deskripsi, tombol, dan gambar slide di area hero beranda.', 'sekolahku' ),
		'priority'    => 30,
	) );

	// Slide 1
	$wp_customize->add_setting( 'sekolahku_hero_eyebrow', array(
		'default'           => 'SEKOLAH UNGGULAN',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_eyebrow', array(
		'label'   => __( 'Slide 1 - Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_title', array(
		'default'           => 'Membangun Generasi Emas',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_title', array(
		'label'   => __( 'Slide 1 - Judul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_subtitle', array(
		'default'           => 'Lingkungan belajar modern dengan tenaga pendidik profesional dan program terarah untuk membentuk karakter, kompetensi, dan kesiapan karier siswa.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_subtitle', array(
		'label'   => __( 'Slide 1 - Subjudul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_btn_text', array(
		'default'           => 'LIHAT PROGRAM KAMI',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero_btn_text', array(
		'label'   => __( 'Slide 1 - Teks Tombol', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_btn_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'sekolahku_hero_btn_url', array(
		'label'       => __( 'Slide 1 - Link Tombol', 'sekolahku' ),
		'description' => __( 'Kosongkan untuk mengarah otomatis ke daftar program.', 'sekolahku' ),
		'section'     => 'sekolahku_hero',
		'type'        => 'url',
	) );

	$wp_customize->add_setting( 'sekolahku_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_hero_image', array(
		'label'   => __( 'Slide 1 - Gambar Background', 'sekolahku' ),
		'section' => 'sekolahku_hero',
	) ) );

	// Slide 2
	$wp_customize->add_setting( 'sekolahku_hero2_eyebrow', array(
		'default'           => 'PENDIDIKAN BERKARAKTER',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero2_eyebrow', array(
		'label'   => __( 'Slide 2 - Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero2_title', array(
		'default'           => 'Mengembangkan Potensi Terbaik',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero2_title', array(
		'label'   => __( 'Slide 2 - Judul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero2_subtitle', array(
		'default'           => 'Fokus pada kreativitas, kepemimpinan, dan nilai-nilai akhlak mulia untuk membekali masa depan generasi penerus bangsa.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero2_subtitle', array(
		'label'   => __( 'Slide 2 - Subjudul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_hero2_btn_text', array(
		'default'           => 'LIHAT PROGRAM KAMI',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero2_btn_text', array(
		'label'   => __( 'Slide 2 - Teks Tombol', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero2_btn_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'sekolahku_hero2_btn_url', array(
		'label'   => __( 'Slide 2 - Link Tombol', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'sekolahku_hero2_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_hero2_image', array(
		'label'   => __( 'Slide 2 - Gambar Background', 'sekolahku' ),
		'section' => 'sekolahku_hero',
	) ) );

	// Slide 3
	$wp_customize->add_setting( 'sekolahku_hero3_eyebrow', array(
		'default'           => 'FASILITAS MODERN',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero3_eyebrow', array(
		'label'   => __( 'Slide 3 - Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero3_title', array(
		'default'           => 'Sarana Belajar Lengkap & Kondusif',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero3_title', array(
		'label'   => __( 'Slide 3 - Judul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero3_subtitle', array(
		'default'           => 'Didukung ruang kelas multimedia, laboratorium komputer terkini, perpustakaan digital, dan fasilitas olahraga yang representatif.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero3_subtitle', array(
		'label'   => __( 'Slide 3 - Subjudul Hero', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_hero3_btn_text', array(
		'default'           => 'LIHAT PROGRAM KAMI',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_hero3_btn_text', array(
		'label'   => __( 'Slide 3 - Teks Tombol', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_hero3_btn_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'sekolahku_hero3_btn_url', array(
		'label'   => __( 'Slide 3 - Link Tombol', 'sekolahku' ),
		'section' => 'sekolahku_hero',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'sekolahku_hero3_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_hero3_image', array(
		'label'   => __( 'Slide 3 - Gambar Background', 'sekolahku' ),
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

	$wp_customize->add_setting( 'sekolahku_welcome_eyebrow', array(
		'default'           => 'Sambutan',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_title', array(
		'default'           => 'Sambutan Kepala Sekolah',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_title', array(
		'label'   => __( 'Judul Utama', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_text', array(
		'default'           => 'Puji syukur ke hadirat Tuhan YME atas segala rahmat dan karunia-Nya. Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah dengan orang tua, peserta didik, serta masyarakat luas. Melalui media ini, kami berharap seluruh informasi mengenai kegiatan, prestasi, serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_text', array(
		'label'   => __( 'Teks Sambutan', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_name', array(
		'default'           => 'Ir. Sherly Puspita, M.Pd',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_name', array(
		'label'   => __( 'Nama Kepala Sekolah', 'sekolahku' ),
		'section' => 'sekolahku_welcome',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_welcome_badge', array(
		'default'           => 'Kepala Sekolah',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_welcome_badge', array(
		'label'   => __( 'Jabatan / Badge', 'sekolahku' ),
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

	// Section: Info Kontak & PPDB.
	$wp_customize->add_section( 'sekolahku_contact', array(
		'title'    => __( 'Info Kontak & PPDB', 'sekolahku' ),
		'priority' => 32,
	) );

	$contact_fields = array(
		'alamat'   => 'Jl. Raya Sukarno Hatta No. 123, Jakarta, Indonesia',
		'telepon'  => '021234567',
		'wa'       => '08123456789',
		'email'    => 'halo@sekolah.sch.id',
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

	$wp_customize->add_setting( 'sekolahku_footer_about', array(
		'default'           => 'SekolahKu SMP adalah lembaga pendidikan unggulan yang berkomitmen mencetak generasi terampil, cerdas, dan berkarakter mulia melalui pembelajaran modern serta lingkungan sekolah yang kondusif.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_footer_about', array(
		'label'   => __( 'Teks Tentang Sekolah Kami (Footer)', 'sekolahku' ),
		'section' => 'sekolahku_contact',
		'type'    => 'textarea',
	) );

	// Section: Sosial Media.
	$wp_customize->add_section( 'sekolahku_social', array(
		'title'       => __( 'Sosial Media', 'sekolahku' ),
		'priority'    => 33,
		'description' => __( 'Isi link akun sosial media sekolah. Kosongkan jika tidak ingin menampilkan ikon tertentu.', 'sekolahku' ),
	) );

	$social_fields = array(
		'facebook'  => 'https://facebook.com/',
		'instagram' => 'https://instagram.com/',
		'youtube'   => 'https://youtube.com/',
		'whatsapp'  => 'https://wa.me/628123456789',
		'tiktok'    => 'https://tiktok.com/',
		'threads'   => 'https://threads.net/',
		'twitter'   => 'https://x.com/',
	);

	foreach ( $social_fields as $key => $default ) {
		$wp_customize->add_setting( 'sekolahku_social_' . $key, array(
			'default'           => $default,
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'sekolahku_social_' . $key, array(
			'label'   => ucfirst( $key ),
			'section' => 'sekolahku_social',
			'type'    => 'url',
		) );
	}

	// Section: Staf & Guru Section.
	$wp_customize->add_section( 'sekolahku_staf_section', array(
		'title'       => __( 'Staf & Guru (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Staf & Guru di beranda.', 'sekolahku' ),
		'priority'    => 32,
	) );

	$wp_customize->add_setting( 'sekolahku_staf_eyebrow', array(
		'default'           => 'STAFF SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_staf_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_staf_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_staf_title', array(
		'default'           => 'Staf & Guru',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_staf_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_staf_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_staf_subtitle', array(
		'default'           => 'Guru dan Staf sekolah kami terdiri dari tenaga profesional yang berpengalaman dan berkomitmen dalam mendukung pendidikan yang berkualitas.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_staf_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_staf_section',
		'type'    => 'textarea',
	) );

	// Section: Fasilitas Sekolah Section.
	$wp_customize->add_section( 'sekolahku_fasilitas_section', array(
		'title'       => __( 'Fasilitas Sekolah (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Fasilitas Sekolah di beranda.', 'sekolahku' ),
		'priority'    => 33,
	) );

	$wp_customize->add_setting( 'sekolahku_fasilitas_eyebrow', array(
		'default'           => 'FACILITIES SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_fasilitas_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_fasilitas_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_fasilitas_title', array(
		'default'           => 'Fasilitas Sekolah',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_fasilitas_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_fasilitas_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_fasilitas_subtitle', array(
		'default'           => 'Fasilitas sekolah kami mencakup ruang kelas, laboratorium, dan peralatan yang memadai untuk membantu proses belajar peserta didik.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_fasilitas_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_fasilitas_section',
		'type'    => 'textarea',
	) );

	// Section: Ekstrakulikuler Section.
	$wp_customize->add_section( 'sekolahku_ekskul_section', array(
		'title'       => __( 'Ekstrakulikuler (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Ekstrakulikuler di beranda.', 'sekolahku' ),
		'priority'    => 34,
	) );

	$wp_customize->add_setting( 'sekolahku_ekskul_eyebrow', array(
		'default'           => 'EKSKUL SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_ekskul_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_ekskul_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_ekskul_title', array(
		'default'           => 'Ekstrakulikuler',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_ekskul_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_ekskul_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_ekskul_subtitle', array(
		'default'           => 'Ekstrakulikuler sekolah kami mencakup kegiatan yang menggabungkan kegiatan seni, olahraga, dan kegiatan sosial untuk meningkatkan minat serta potensi peserta didik.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_ekskul_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_ekskul_section',
		'type'    => 'textarea',
	) );

	// Section: Galeri (Foto & Video) Section.
	$wp_customize->add_section( 'sekolahku_galeri_section', array(
		'title'       => __( 'Galeri Foto & Video (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Galeri Foto & Video di beranda.', 'sekolahku' ),
		'priority'    => 35,
	) );

	$wp_customize->add_setting( 'sekolahku_galeri_eyebrow', array(
		'default'           => 'GALLERY SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_galeri_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_galeri_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_galeri_title', array(
		'default'           => 'Foto & Video',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_galeri_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_galeri_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_galeri_subtitle', array(
		'default'           => 'Galeri sekolah kami mencakup berbagai kegiatan dan momen berharga yang membantu peserta didik mengenali potensi terbaiknya.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_galeri_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_galeri_section',
		'type'    => 'textarea',
	) );

	// Section: Testimoni Section.
	$wp_customize->add_section( 'sekolahku_testimoni_section', array(
		'title'       => __( 'Testimoni (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Testimoni di beranda.', 'sekolahku' ),
		'priority'    => 36,
	) );

	$wp_customize->add_setting( 'sekolahku_testimoni_eyebrow', array(
		'default'           => 'TESTIMONIAL SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_testimoni_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_testimoni_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_testimoni_title', array(
		'default'           => 'Apa Kata Mereka?',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_testimoni_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_testimoni_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_testimoni_subtitle', array(
		'default'           => 'Pendapat dan pengalaman dari orang tua serta peserta didik yang telah merasakan layanan pendidikan di sekolah kami.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_testimoni_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_testimoni_section',
		'type'    => 'textarea',
	) );

	// Section: Berita & Artikel Section.
	$wp_customize->add_section( 'sekolahku_berita_section', array(
		'title'       => __( 'Berita & Artikel (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, dan deskripsi untuk section Berita & Artikel di beranda.', 'sekolahku' ),
		'priority'    => 37,
	) );

	$wp_customize->add_setting( 'sekolahku_berita_eyebrow', array(
		'default'           => 'NEWS SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_berita_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_berita_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_berita_title', array(
		'default'           => 'Berita & Artikel',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_berita_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_berita_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_berita_subtitle', array(
		'default'           => 'Berita dan artikel sekolah kami mencakup informasi terkini dan terbaru tentang sekolah kami.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_berita_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_berita_section',
		'type'    => 'textarea',
	) );

	// Section: CTA Section (Pendaftaran Peserta Didik Baru).
	$wp_customize->add_section( 'sekolahku_cta_section', array(
		'title'       => __( 'CTA Pendaftaran (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur label eyebrow, judul, deskripsi, teks tombol, dan gambar siswa untuk CTA Pendaftaran.', 'sekolahku' ),
		'priority'    => 38,
	) );

	$wp_customize->add_setting( 'sekolahku_cta_eyebrow', array(
		'default'           => 'CTA SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_cta_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_cta_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_cta_title', array(
		'default'           => 'Pendaftaran Peserta Didik Baru',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_cta_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_cta_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_cta_subtitle', array(
		'default'           => 'Informasi lengkap mengenai jadwal, persyaratan, dan alur pendaftaran tersedia di sini.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_cta_subtitle', array(
		'label'   => __( 'Sub-deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_cta_section',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'sekolahku_cta_button_text', array(
		'default'           => 'SELENGKAPNYA',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_cta_button_text', array(
		'label'   => __( 'Teks Tombol CTA', 'sekolahku' ),
		'section' => 'sekolahku_cta_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_cta_button_url', array(
		'default'           => home_url( '/ppdb/' ),
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'sekolahku_cta_button_url', array(
		'label'   => __( 'URL Link Tombol CTA', 'sekolahku' ),
		'section' => 'sekolahku_cta_section',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'sekolahku_cta_image', array(
		'default'           => 'https://zekolla.oketheme.com/wp-content/uploads/2024/05/student-cta.png',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_cta_image', array(
		'label'    => __( 'Gambar Siswa Transparan (PNG Cutout)', 'sekolahku' ),
		'section'  => 'sekolahku_cta_section',
		'settings' => 'sekolahku_cta_image',
	) ) );

	// Section: Benefit Section (Mengapa Memilih Kami).
	$wp_customize->add_section( 'sekolahku_benefit', array(
		'title'       => __( 'Benefit Section (Beranda)', 'sekolahku' ),
		'description' => __( 'Atur judul, deskripsi, serta 9 item keunggulan (termasuk ikon SVG) pada Benefit Section.', 'sekolahku' ),
		'priority'    => 31,
	) );

	$wp_customize->add_setting( 'sekolahku_benefit_eyebrow', array(
		'default'           => 'BENEFIT SECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_benefit_eyebrow', array(
		'label'   => __( 'Label Atas (Eyebrow)', 'sekolahku' ),
		'section' => 'sekolahku_benefit',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_benefit_title', array(
		'default'           => 'Mengapa Memilih Kami?',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_benefit_title', array(
		'label'   => __( 'Judul Section', 'sekolahku' ),
		'section' => 'sekolahku_benefit',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'sekolahku_benefit_subtitle', array(
		'default'           => 'Berbagai keunggulan yang mendukung proses pembelajaran serta pengembangan potensi peserta didik secara optimal.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'sekolahku_benefit_subtitle', array(
		'label'   => __( 'Subjudul / Deskripsi Section', 'sekolahku' ),
		'section' => 'sekolahku_benefit',
		'type'    => 'textarea',
	) );

	$default_benefits = array(
		1 => array(
			'title' => 'Guru Profesional',
			'desc'  => 'Tenaga pendidik berpengalaman dan tersertifikasi yang fokus pada perkembangan akademik dan karakter siswa.',
		),
		2 => array(
			'title' => 'Ekstrakurikuler Aktif',
			'desc'  => 'Beragam kegiatan seni, olahraga, dan sains untuk mengembangkan minat, bakat, serta kepemimpinan.',
		),
		3 => array(
			'title' => 'Kelas Modern & Multimedia',
			'desc'  => 'Ruang belajar ber-AC dengan proyektor multimedia, akses internet cepat, dan lingkungan kondusif.',
		),
		4 => array(
			'title' => 'Kurikulum Relevan',
			'desc'  => 'Materi pembelajaran terintegrasi dengan standar nasional dan kebutuhan industri masa kini.',
		),
		5 => array(
			'title' => 'Lingkungan Positif & Inklusif',
			'desc'  => 'Budaya sekolah yang aman, islami/berakhlak mulia, disiplin, dan mendukung kesuksesan siswa.',
		),
		6 => array(
			'title' => 'Dukungan Karier & Industri',
			'desc'  => 'Program bimbingan karier, magang kerja, serta jaringan kemitraan dunia usaha & kerja.',
		),
		7 => array(
			'title' => 'Pembinaan Karakter & Akhlak',
			'desc'  => 'Program pembentukan kepribadian, kedisiplinan, spiritual, dan etika bermasyarakat.',
		),
		8 => array(
			'title' => 'Sertifikasi & Prestasi',
			'desc'  => 'Kesempatan meraih sertifikasi keahlian dan pendampingan kompetisi hingga tingkat nasional.',
		),
		9 => array(
			'title' => 'Sarana Olahraga & Seni',
			'desc'  => 'Lapang olahraga representatif, laboratorium musik, dan studio seni untuk kreativitas siswa.',
		),
	);

	foreach ( $default_benefits as $i => $item ) {
		// Judul Item
		$wp_customize->add_setting( "sekolahku_benefit_item_{$i}_title", array(
			'default'           => $item['title'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "sekolahku_benefit_item_{$i}_title", array(
			'label'   => sprintf( __( 'Item %d - Judul', 'sekolahku' ), $i ),
			'section' => 'sekolahku_benefit',
			'type'    => 'text',
		) );

		// Deskripsi Item
		$wp_customize->add_setting( "sekolahku_benefit_item_{$i}_desc", array(
			'default'           => $item['desc'],
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "sekolahku_benefit_item_{$i}_desc", array(
			'label'   => sprintf( __( 'Item %d - Deskripsi', 'sekolahku' ), $i ),
			'section' => 'sekolahku_benefit',
			'type'    => 'textarea',
		) );

		// Upload Ikon (SVG / Gambar)
		$wp_customize->add_setting( "sekolahku_benefit_item_{$i}_icon", array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "sekolahku_benefit_item_{$i}_icon", array(
			'label'       => sprintf( __( 'Item %d - Ikon SVG / Gambar', 'sekolahku' ), $i ),
			'description' => __( 'Upload file SVG atau gambar PNG/JPG ikon.', 'sekolahku' ),
			'section'     => 'sekolahku_benefit',
		) ) );
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

	// Section: Halaman Login.
	$wp_customize->add_section( 'sekolahku_login', array(
		'title'       => __( 'Halaman Login (Login Screen)', 'sekolahku' ),
		'description' => __( 'Atur foto latar belakang, logo, dan teks pada halaman login WordPress (wp-login.php).', 'sekolahku' ),
		'priority'    => 190,
	) );

	// Login Background Image
	$wp_customize->add_setting( 'sekolahku_login_bg_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_login_bg_image', array(
		'label'       => __( 'Foto Latar Belakang (Background Image)', 'sekolahku' ),
		'description' => __( 'Upload foto gedung/siswa sekolah untuk dijadikan background halaman login.', 'sekolahku' ),
		'section'     => 'sekolahku_login',
	) ) );

	// Login Logo Image
	$wp_customize->add_setting( 'sekolahku_login_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sekolahku_login_logo', array(
		'label'       => __( 'Logo Halaman Login', 'sekolahku' ),
		'description' => __( 'Upload logo sekolah untuk ditampilkan di atas form login.', 'sekolahku' ),
		'section'     => 'sekolahku_login',
	) ) );

	// Login Title
	$wp_customize->add_setting( 'sekolahku_login_title', array(
		'default'           => 'Portal Admin Sekolah',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_login_title', array(
		'label'   => __( 'Judul Form Login', 'sekolahku' ),
		'section' => 'sekolahku_login',
		'type'    => 'text',
	) );

	// Login Subtitle
	$wp_customize->add_setting( 'sekolahku_login_subtitle', array(
		'default'           => 'Silakan masuk untuk mengelola sistem informasi sekolah',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'sekolahku_login_subtitle', array(
		'label'   => __( 'Subjudul Form Login', 'sekolahku' ),
		'section' => 'sekolahku_login',
		'type'    => 'text',
	) );
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

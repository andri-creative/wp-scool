<?php
/**
 * SekolahKu Theme - functions.php
 * Setup dasar tema: dukungan fitur, menu, widget area, CPT Galeri, enqueue asset.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Keamanan: cegah akses langsung ke file.
}

define( 'SEKOLAHKU_VERSION', '1.2.4' );

/**
 * Theme setup: dukungan fitur bawaan WordPress.
 */
function sekolahku_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'comment-list', 'comment-form' ) );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'primary' => __( 'Menu Utama', 'sekolahku' ),
		'footer'  => __( 'Menu Footer', 'sekolahku' ),
	) );
}
add_action( 'after_setup_theme', 'sekolahku_theme_setup' );

/**
 * Enqueue CSS & JS tema.
 */
function sekolahku_assets() {
	wp_enqueue_style( 'sekolahku-style', get_stylesheet_uri(), array(), SEKOLAHKU_VERSION );
	wp_enqueue_style( 'sekolahku-main', get_template_directory_uri() . '/assets/css/main.css', array( 'sekolahku-style' ), SEKOLAHKU_VERSION );
	wp_enqueue_script( 'sekolahku-main', get_template_directory_uri() . '/assets/js/main.js', array(), SEKOLAHKU_VERSION, true );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sekolahku_assets' );

/**
 * Widget area (sidebar) untuk halaman Berita & footer.
 */
function sekolahku_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Berita', 'sekolahku' ),
		'id'            => 'sidebar-berita',
		'before_widget' => '<div class="widget card">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Kolom', 'sekolahku' ),
		'id'            => 'footer-kolom',
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'sekolahku_widgets_init' );

/**
 * Custom Post Types untuk kebutuhan website sekolah:
 * Pengumuman, Agenda, Program Keahlian, Staf & Guru, Fasilitas,
 * Ekstrakurikuler, dan Testimoni.
 */
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
		'show_in_rest' => true,
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
		'show_in_rest' => true,
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
		'show_in_rest' => true,
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
		'show_in_rest' => true,
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
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'sekolahku_register_all_cpt' );

/**
 * Meta box tambahan sederhana: keterangan singkat untuk Ekstrakurikuler
 * (pembina, jumlah anggota) dan Agenda (tanggal & lokasi kegiatan),
 * disimpan sebagai post meta bawaan tanpa perlu plugin custom fields.
 */
function sekolahku_register_meta_boxes() {
	add_meta_box( 'sekolahku_ekskul_meta', 'Detail Ekstrakurikuler', 'sekolahku_render_ekskul_meta', 'ekskul', 'side' );
	add_meta_box( 'sekolahku_agenda_meta', 'Detail Agenda', 'sekolahku_render_agenda_meta', 'agenda', 'side' );
}
add_action( 'add_meta_boxes', 'sekolahku_register_meta_boxes' );

function sekolahku_render_ekskul_meta( $post ) {
	$pembina = get_post_meta( $post->ID, '_ekskul_pembina', true );
	$anggota = get_post_meta( $post->ID, '_ekskul_anggota', true );
	wp_nonce_field( 'sekolahku_save_ekskul_meta', 'sekolahku_ekskul_nonce' );
	echo '<p><label>Nama Pembina/Pelatih</label><br><input type="text" style="width:100%" name="ekskul_pembina" value="' . esc_attr( $pembina ) . '"></p>';
	echo '<p><label>Jumlah Anggota</label><br><input type="text" style="width:100%" name="ekskul_anggota" value="' . esc_attr( $anggota ) . '"></p>';
}

function sekolahku_render_agenda_meta( $post ) {
	$tanggal = get_post_meta( $post->ID, '_agenda_tanggal', true );
	$waktu   = get_post_meta( $post->ID, '_agenda_waktu', true );
	$lokasi  = get_post_meta( $post->ID, '_agenda_lokasi', true );
	wp_nonce_field( 'sekolahku_save_agenda_meta', 'sekolahku_agenda_nonce' );
	echo '<p><label>Tanggal (mis. 5 Agustus 2026)</label><br><input type="text" style="width:100%" name="agenda_tanggal" value="' . esc_attr( $tanggal ) . '"></p>';
	echo '<p><label>Jam (mis. 09.00 - 12.00)</label><br><input type="text" style="width:100%" name="agenda_waktu" value="' . esc_attr( $waktu ) . '"></p>';
	echo '<p><label>Lokasi</label><br><input type="text" style="width:100%" name="agenda_lokasi" value="' . esc_attr( $lokasi ) . '"></p>';
}

function sekolahku_save_meta_boxes( $post_id ) {
	if ( isset( $_POST['sekolahku_ekskul_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_ekskul_nonce'], 'sekolahku_save_ekskul_meta' ) ) {
		if ( isset( $_POST['ekskul_pembina'] ) ) {
			update_post_meta( $post_id, '_ekskul_pembina', sanitize_text_field( wp_unslash( $_POST['ekskul_pembina'] ) ) );
		}
		if ( isset( $_POST['ekskul_anggota'] ) ) {
			update_post_meta( $post_id, '_ekskul_anggota', sanitize_text_field( wp_unslash( $_POST['ekskul_anggota'] ) ) );
		}
	}

	if ( isset( $_POST['sekolahku_agenda_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_agenda_nonce'], 'sekolahku_save_agenda_meta' ) ) {
		foreach ( array( 'agenda_tanggal', 'agenda_waktu', 'agenda_lokasi' ) as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
	}
}
add_action( 'save_post', 'sekolahku_save_meta_boxes' );

/**
 * Excerpt otomatis lebih pendek untuk kartu berita.
 */
function sekolahku_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'sekolahku_excerpt_length' );

function sekolahku_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'sekolahku_excerpt_more' );

/**
 * Halaman Kontak: proses pengiriman form sederhana lewat wp_mail().
 * Catatan: untuk kebutuhan produksi, disarankan pakai plugin form
 * (Contact Form 7 / WPForms) agar ada validasi & anti-spam yang lebih matang.
 */
function sekolahku_handle_contact_form() {
	if (
		isset( $_POST['sekolahku_contact_nonce'] ) &&
		wp_verify_nonce( $_POST['sekolahku_contact_nonce'], 'sekolahku_contact_submit' )
	) {
		$nama    = isset( $_POST['nama'] ) ? sanitize_text_field( wp_unslash( $_POST['nama'] ) ) : '';
		$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$pesan   = isset( $_POST['pesan'] ) ? sanitize_textarea_field( wp_unslash( $_POST['pesan'] ) ) : '';
		$to      = get_option( 'admin_email' );
		$subject = 'Pesan baru dari website - ' . get_bloginfo( 'name' );
		$body    = "Nama: $nama\nEmail: $email\n\nPesan:\n$pesan";
		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

		if ( $nama && is_email( $email ) && $pesan ) {
			wp_mail( $to, $subject, $body, $headers );
			wp_safe_redirect( add_query_arg( 'kontak', 'sukses', wp_get_referer() ) );
			exit;
		}

		wp_safe_redirect( add_query_arg( 'kontak', 'gagal', wp_get_referer() ) );
		exit;
	}
}
add_action( 'template_redirect', 'sekolahku_handle_contact_form' );

/**
 * Include file tambahan.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';

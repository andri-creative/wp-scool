<?php
/**
 * SekolahKu Theme - functions.php
 * Setup dasar tema: dukungan fitur, menu, widget area, enqueue asset, dan memuat modul inc.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Keamanan: cegah akses langsung ke file.
}

define( 'SEKOLAHKU_VERSION', '1.3.0.' . time() );

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
 * Custom Template Router untuk mengarahkan single custom post types ke template-parts/single/
 */
function sekolahku_custom_single_templates( $template ) {
	if ( is_singular() ) {
		$post_type       = get_post_type();
		$custom_template = get_template_directory() . "/template-parts/single/single-{$post_type}.php";
		if ( file_exists( $custom_template ) ) {
			return $custom_template;
		}
	}
	return $template;
}
add_filter( 'single_template', 'sekolahku_custom_single_templates' );

/**
 * Naikkan ambang batas ukuran foto berukuran besar (kamera/iPhone) agar tidak memicu error pemrosesan memori.
 */
add_filter( 'big_image_size_threshold', function() {
	return 4000;
} );

/**
 * Izinkan upload file SVG di WordPress Media Library untuk ikon tema.
 */
function sekolahku_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'sekolahku_mime_types' );

/**
 * Memuat Modul-modul Terpisah di folder inc/
 */
require_get_template_directory( '/inc/cpt.php' );
require_get_template_directory( '/inc/helpers.php' );
require_get_template_directory( '/inc/metaboxes.php' );
require_get_template_directory( '/inc/login.php' );
require_get_template_directory( '/inc/template-tags.php' );
require_get_template_directory( '/inc/customizer.php' );

function require_get_template_directory( $path ) {
	$file = get_template_directory() . $path;
	if ( file_exists( $file ) ) {
		require $file;
	}
}

// Force URL Rewrite (Menghapus paksa index.php) walau server tidak mendukung
add_filter( 'got_url_rewrite', '__return_true' );

// [Bypass SSL Local] Memaksa WordPress mengabaikan error SSL lokal (Berguna untuk MAMP / Localhost)
// Agar plugin pihak ketiga bisa terhubung ke server MinIO yang sertifikatnya ditolak oleh cURL lokal.
add_filter( 'https_ssl_verify', '__return_false' );
add_filter( 'https_local_ssl_verify', '__return_false' );

/**
 * Mengubah nama file secara otomatis saat diunggah.
 * Format: JamMenitDetik-TanggalBulanTahun_3KarakterAcak.ekstensi (Misal: 143045-110826_aB3.jpg)
 */
function sekolahku_rename_uploaded_file( $file ) {
	$info = pathinfo( $file['name'] );
	$ext  = empty( $info['extension'] ) ? '' : '.' . $info['extension'];
	
	// Format Waktu: His (JamMenitDetik), dmy (TanggalBulanTahun)
	$time_format = date( 'His-dmy' );
	
	// 3 Karakter Acak
	$random_chars = substr( str_shuffle( '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 0, 3 );
	
	// Gabungkan format baru
	$file['name'] = $time_format . '_' . $random_chars . $ext;
	
	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'sekolahku_rename_uploaded_file' );

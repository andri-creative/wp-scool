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

	wp_localize_script( 'sekolahku-main', 'sekolahku_vars', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	) );

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

/**
 * Automatic Subfolder Template Loader (template-parts/archive & template-parts/single).
 */
function sekolahku_custom_template_include( $template ) {
	if ( is_singular() ) {
		$post_type     = get_post_type();
		$custom_single = get_template_directory() . "/template-parts/single/single-{$post_type}.php";
		if ( file_exists( $custom_single ) ) {
			return $custom_single;
		}
	} elseif ( is_post_type_archive() ) {
		$post_type      = get_post_type();
		$custom_archive = get_template_directory() . "/template-parts/archive/archive-{$post_type}.php";
		if ( file_exists( $custom_archive ) ) {
			return $custom_archive;
		}
	}
	return $template;
}
add_filter( 'template_include', 'sekolahku_custom_template_include' );

/**
 * Pencarian Global: Sertakan semua tipe konten di pencarian WordPress.
 */
function sekolahku_search_all_post_types( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'post_type', array( 'post', 'page', 'program', 'staf', 'fasilitas', 'ekskul', 'galeri', 'pengumuman', 'agenda' ) );
	}
}
add_action( 'pre_get_posts', 'sekolahku_search_all_post_types' );

/**
 * Live Search AJAX Handler (Debounce & All Post Types).
 */
function sekolahku_live_search_ajax() {
	$keyword = isset( $_POST['keyword'] ) ? sanitize_text_field( $_POST['keyword'] ) : '';

	if ( empty( $keyword ) || mb_strlen( $keyword ) < 2 ) {
		wp_die();
	}

	$post_types = array( 'post', 'page', 'program', 'staf', 'fasilitas', 'ekskul', 'galeri', 'pengumuman', 'agenda' );

	$args = array(
		'post_type'      => $post_types,
		'posts_per_page' => 8,
		'post_status'    => 'publish',
		's'              => $keyword,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		echo '<ul class="live-search-results">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$p_id   = get_the_ID();
			$type   = get_post_type();
			$title  = get_the_title();
			$link   = get_permalink();

			// Determine Badge Label
			$badge_label = 'Konten';
			switch ( $type ) {
				case 'post':        $badge_label = 'Berita'; break;
				case 'page':        $badge_label = 'Halaman'; break;
				case 'program':     $badge_label = 'Program'; break;
				case 'staf':        $badge_label = 'Staf'; break;
				case 'fasilitas':   $badge_label = 'Fasilitas'; break;
				case 'ekskul':      $badge_label = 'Ekskul'; break;
				case 'galeri':       $badge_label = 'Galeri'; break;
				case 'pengumuman':   $badge_label = 'Pengumuman'; break;
				case 'agenda':       $badge_label = 'Agenda'; break;
			}

			// Determine Thumbnail
			$thumb = '';
			if ( has_post_thumbnail( $p_id ) ) {
				$thumb = get_the_post_thumbnail_url( $p_id, 'thumbnail' );
			} elseif ( $type === 'staf' && function_exists( 'sekolahku_get_staf_avatar' ) ) {
				$thumb = sekolahku_get_staf_avatar( $p_id );
			} elseif ( $type === 'fasilitas' && function_exists( 'sekolahku_get_fasilitas_thumb' ) ) {
				$thumb = sekolahku_get_fasilitas_thumb( $p_id );
			} elseif ( $type === 'ekskul' && function_exists( 'sekolahku_get_ekskul_thumb' ) ) {
				$thumb = sekolahku_get_ekskul_thumb( $p_id );
			}

			echo '<li class="live-search-item">';
			echo '<a href="' . esc_url( $link ) . '" class="live-search-link">';
			if ( $thumb ) {
				echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( $title ) . '" class="live-search-thumb">';
			} else {
				echo '<div class="live-search-thumb-placeholder">🎓</div>';
			}
			echo '<div class="live-search-details">';
			echo '<span class="live-search-title">' . esc_html( $title ) . '</span>';
			echo '<span class="live-search-badge badge-' . esc_attr( $type ) . '">' . esc_html( $badge_label ) . '</span>';
			echo '</div>';
			echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
		echo '<div class="live-search-footer">';
		echo '<a href="' . esc_url( home_url( '/?s=' . urlencode( $keyword ) ) ) . '" class="live-search-see-all">';
		echo 'Lihat Semua Hasil untuk "<strong>' . esc_html( $keyword ) . '</strong>" &rarr;';
		echo '</a>';
		echo '</div>';
		wp_reset_postdata();
	} else {
		echo '<div class="live-search-no-results">';
		echo '<p>Tidak ditemukan hasil untuk "<strong>' . esc_html( $keyword ) . '</strong>"</p>';
		echo '</div>';
	}

	wp_die();
}
add_action( 'wp_ajax_sekolahku_live_search', 'sekolahku_live_search_ajax' );
add_action( 'wp_ajax_nopriv_sekolahku_live_search', 'sekolahku_live_search_ajax' );

/**
 * Smart Search Keyword Redirect (pengu -> /pengumuman/, staf -> /staf/, dll).
 */
function sekolahku_smart_search_redirect() {
	if ( is_search() && ! is_admin() ) {
		$search_query = trim( get_search_query() );
		$s_lower      = strtolower( $search_query );

		$redirect_map = array(
			'pengu'           => 'pengumuman',
			'pengumuman'      => 'pengumuman',
			'pengumunan'      => 'pengumuman',
			'berita'          => 'post',
			'kabar'           => 'post',
			'program'         => 'program',
			'jurusan'         => 'program',
			'staf'            => 'staf',
			'guru'            => 'staf',
			'pengajar'        => 'staf',
			'fasilitas'       => 'fasilitas',
			'sarana'          => 'fasilitas',
			'ekskul'          => 'ekskul',
			'ekstrakurikuler' => 'ekskul',
			'galeri'          => 'galeri',
			'foto'            => 'galeri',
			'video'           => 'galeri',
			'agenda'          => 'agenda',
			'jadwal'          => 'agenda',
		);

		if ( isset( $redirect_map[ $s_lower ] ) ) {
			$pt         = $redirect_map[ $s_lower ];
			$target_url = ( $pt === 'post' ) ? home_url( '/berita/' ) : get_post_type_archive_link( $pt );

			if ( ! empty( $target_url ) ) {
				wp_safe_redirect( $target_url );
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'sekolahku_smart_search_redirect' );

<?php
/** Modul Helper Pintar - SekolahKu Theme. */
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Mengubah URL absolut (seperti http://localhost:8888) menjadi URL dinamis yang menyesuaikan domain saat ini.
 * Membantu gambar tetap tampil meski pindah dari localhost ke domain live.
 */
function sekolahku_make_url_dynamic($url)
{
	if (is_string($url) && strpos($url, '/wp-content/uploads/') !== false) {
		$parts = explode('/wp-content/uploads/', $url);
		return site_url('/wp-content/uploads/' . end($parts));
	}
	return $url;
}

/**
 * Helper pintar untuk mendeteksi foto Staf/Guru dari 4 pilihan lokasi.
 */
function sekolahku_get_staf_avatar($post_id)
{
	// 1. Featured Image
	if (has_post_thumbnail($post_id)) {
		$thumb = get_the_post_thumbnail_url($post_id, 'large');
		if ($thumb) {
			return $thumb;
		}
	}

	// 2. Custom Meta Field _staf_foto
	$custom_foto = get_post_meta($post_id, '_staf_foto', true);
	if ($custom_foto) {
		return sekolahku_make_url_dynamic($custom_foto);
	}

	// 3. Extract gambar pertama dari isi konten editor
	$post = get_post($post_id);
	if ($post && !empty($post->post_content)) {
		if (preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches)) {
			if (!empty($matches[1])) {
				return sekolahku_make_url_dynamic($matches[1]);
			}
		}
	}

	// 4. Default Fallback Image
	return 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto Fasilitas Sekolah.
 */
function sekolahku_get_fasilitas_thumb($post_id)
{
	if (has_post_thumbnail($post_id)) {
		$thumb = get_the_post_thumbnail_url($post_id, 'medium_large');
		if ($thumb) {
			return $thumb;
		}
	}

	$post = get_post($post_id);
	if ($post && !empty($post->post_content)) {
		if (preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches)) {
			if (!empty($matches[1])) {
				return sekolahku_make_url_dynamic($matches[1]);
			}
		}
	}

	return 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto Ekstrakurikuler.
 */
function sekolahku_get_ekskul_thumb($post_id)
{
	if (has_post_thumbnail($post_id)) {
		$thumb = get_the_post_thumbnail_url($post_id, 'medium_large');
		if ($thumb) {
			return $thumb;
		}
	}

	$custom_foto = get_post_meta($post_id, '_ekskul_foto', true);
	if ($custom_foto) {
		return sekolahku_make_url_dynamic($custom_foto);
	}

	$post = get_post($post_id);
	if ($post && !empty($post->post_content)) {
		if (preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches)) {
			if (!empty($matches[1])) {
				return sekolahku_make_url_dynamic($matches[1]);
			}
		}
	}

	return 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto Berita Sekolah.
 */
function sekolahku_get_berita_thumb($post_id)
{
	// 1. Featured Image
	if (has_post_thumbnail($post_id)) {
		$thumb = get_the_post_thumbnail_url($post_id, 'medium_large');
		if ($thumb) {
			return $thumb;
		}
	}

	// 2. Custom Meta Foto (jika ada)
	$custom_foto = get_post_meta($post_id, '_berita_foto', true);
	if ($custom_foto) {
		return sekolahku_make_url_dynamic($custom_foto);
	}

	// 3. Extract tag <img> pertama dari isi konten editor
	$post = get_post($post_id);
	if ($post && !empty($post->post_content)) {
		if (preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches)) {
			if (!empty($matches[1])) {
				return sekolahku_make_url_dynamic($matches[1]);
			}
		}
	}

	// 4. Default Fallback Image (Unsplash Berita/Sekolah)
	return 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80';
}


/**
 * Helper pintar untuk mendeteksi foto/sampul Galeri (Foto & Video).
 */
function sekolahku_get_galeri_thumb($post_id)
{
	// 1. Featured Image
	if (has_post_thumbnail($post_id)) {
		$thumb = get_the_post_thumbnail_url($post_id, 'large');
		if ($thumb) {
			return $thumb;
		}
	}

	$post = get_post($post_id);
	if ($post && !empty($post->post_content)) {
		// 2. Extract tag <img> dari isi konten (Add Media)
		if (preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches)) {
			if (!empty($matches[1])) {
				return sekolahku_make_url_dynamic($matches[1]);
			}
		}

		// 3. Extract YouTube Thumbnail
		if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $post->post_content, $yt_matches)) {
			if (!empty($yt_matches[1])) {
				return 'https://img.youtube.com/vi/' . $yt_matches[1] . '/hqdefault.jpg';
			}
		}
	}

	// 4. Default Fallback Image
	return 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk menghitung jumlah media (Foto / Video) pada Galeri.
 */
function sekolahku_get_galeri_badge($post_id)
{
	$post = get_post($post_id);
	$count = 0;
	if (has_post_thumbnail($post_id)) {
		$count++;
	}
	if ($post && !empty($post->post_content)) {
		preg_match_all('/<img[^>]+>/i', $post->post_content, $img_matches);
		if (!empty($img_matches[0])) {
			$count += count($img_matches[0]);
		}
		$has_video = preg_match('/<iframe|<video|youtube\.com|youtu\.be|vimeo\.com|\.mp4/i', $post->post_content);
		if ($has_video) {
			return '🎥 Video';
		}
	}

	return ($count > 0) ? ('📷 ' . $count . ' Media') : '📷 1';
}

/**
 * Helper pintar untuk merender komponen Tombol Bagikan (Share Buttons).
 */
function sekolahku_render_share_buttons()
{
	get_template_part('template-parts/share-buttons');
}

/**
 * Mengecek apakah agenda sudah terlewat (kedaluwarsa).
 * Akan membandingkan tanggal event dengan tanggal hari ini.
 */
function sekolahku_is_agenda_passed($tanggal_indo)
{
	if (empty($tanggal_indo))
		return false;

	// Hapus nama hari dari string agar tidak membuat strtotime error
	$hari_indo = array('Senin,', 'Selasa,', 'Rabu,', 'Kamis,', 'Jumat,', 'Sabtu,', 'Minggu,', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
	$tanggal_indo = str_ireplace($hari_indo, '', trim($tanggal_indo));

	$bulan_indo = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$bulan_eng = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

	$tanggal_eng = str_ireplace($bulan_indo, $bulan_eng, trim($tanggal_indo));

	$timestamp_event = strtotime($tanggal_eng . ' 23:59:59');

	if (!$timestamp_event)
		return false;

	return time() > $timestamp_event;
}

/**
 * Mengambil agenda yang diurutkan secara cerdas:
 * 1. Agenda Mendatang (paling dekat duluan / ASC)
 * 2. Agenda Terlewat (paling baru terlewat duluan / DESC)
 */
function sekolahku_get_sorted_agendas($limit = -1)
{
	$args = array(
		'post_type' => 'agenda',
		'posts_per_page' => 300,  // Ambil sebanyak mungkin untuk di-sort
		'post_status' => 'publish',
	);
	$query = new WP_Query($args);

	$upcoming_agendas = array();
	$passed_agendas = array();
	$now = time();

	if ($query->have_posts()) {
		foreach ($query->posts as $post) {
			$tanggal = get_post_meta($post->ID, '_agenda_tanggal', true);
			$tgl_disp = $tanggal ? $tanggal : sekolahku_tanggal_indonesia(get_the_date('Y-m-d H:i:s', $post));

			$hari_indo = array('Senin,', 'Selasa,', 'Rabu,', 'Kamis,', 'Jumat,', 'Sabtu,', 'Minggu,', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
			$tanggal_indo = str_ireplace($hari_indo, '', trim($tgl_disp));
			$bulan_indo = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$bulan_eng = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$tanggal_eng = str_ireplace($bulan_indo, $bulan_eng, trim($tanggal_indo));

			$timestamp = strtotime($tanggal_eng . ' 23:59:59');
			if (!$timestamp)
				$timestamp = strtotime($post->post_date);

			$post->agenda_timestamp = $timestamp;

			if ($now > $timestamp) {
				$passed_agendas[] = $post;
			} else {
				$upcoming_agendas[] = $post;
			}
		}
	}

	// Urutkan Mendatang: paling dekat (terkecil) duluan
	usort($upcoming_agendas, function ($a, $b) {
		return $a->agenda_timestamp - $b->agenda_timestamp;
	});

	// Urutkan Terlewat: paling baru terlewat (terbesar) duluan
	usort($passed_agendas, function ($a, $b) {
		return $b->agenda_timestamp - $a->agenda_timestamp;
	});

	$sorted_posts = array_merge($upcoming_agendas, $passed_agendas);

	if ($limit > 0) {
		$sorted_posts = array_slice($sorted_posts, 0, $limit);
	}

	return $sorted_posts;
}

/** Endpoint AJAX untuk Load More Pengumuman */
add_action('wp_ajax_load_more_pengumuman', 'sekolahku_load_more_pengumuman_ajax');
add_action('wp_ajax_nopriv_load_more_pengumuman', 'sekolahku_load_more_pengumuman_ajax');

function sekolahku_load_more_pengumuman_ajax()
{
	// Pastikan data aman
	$paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

	$args = array(
		'post_type' => 'pengumuman',
		'posts_per_page' => 12,
		'paged' => $paged,
		'post_status' => 'publish',
	);

	$query = new WP_Query($args);

	if ($query->have_posts()):
		while ($query->have_posts()):
			$query->the_post();
			?>
			<article class="pengumuman-card-item">
				<a href="<?php the_permalink(); ?>" class="pengumuman-card-link">
					<h3 class="pengumuman-card-title"><?php the_title(); ?></h3>
					<div class="pengumuman-card-meta">
						<?php echo esc_html(sekolahku_tanggal_indonesia(get_the_date('Y-m-d H:i:s'))); ?>
					</div>
				</a>
			</article>
			<?php
		endwhile;
	endif;

	wp_die();
}

/** Endpoint AJAX untuk Load More Berita */
add_action('wp_ajax_load_more_berita', 'sekolahku_load_more_berita_ajax');
add_action('wp_ajax_nopriv_load_more_berita', 'sekolahku_load_more_berita_ajax');

function sekolahku_load_more_berita_ajax()
{
	$paged    = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
	$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$search   = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'paged'          => $paged,
		'post_status'    => 'publish',
	);

	if (!empty($category)) {
		$args['category_name'] = $category;
	}

	if (!empty($search)) {
		$args['s'] = $search;
	}

	$query = new WP_Query($args);

	if ($query->have_posts()):
		while ($query->have_posts()):
			$query->the_post();
			$post_id   = get_the_ID();
			$cats      = get_the_category();
			$cat_name  = !empty($cats) ? $cats[0]->name : 'Berita';
			$thumb_url = sekolahku_get_berita_thumb($post_id);
			?>
			<article class="berita-card-item">
				<div class="berita-card-img">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
					</a>
				</div>
				<div class="berita-card-body">
					<div class="berita-card-cat"><?php echo esc_html($cat_name); ?></div>
					<h3 class="berita-card-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="berita-card-date">
						<?php echo esc_html(sekolahku_tanggal_indonesia(get_the_date('Y-m-d H:i:s'))); ?>
					</div>
					<div class="berita-card-excerpt">
						<?php echo esc_html(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : get_the_content(), 15)); ?>
					</div>
					<a href="<?php the_permalink(); ?>" class="berita-card-more">Selengkapnya &raquo;</a>
				</div>
			</article>
			<?php
		endwhile;
	endif;

	wp_die();
}


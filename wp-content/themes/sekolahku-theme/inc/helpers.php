<?php
/**
 * Modul Helper Pintar - SekolahKu Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mengubah URL absolut (seperti http://localhost:8888) menjadi URL dinamis yang menyesuaikan domain saat ini.
 * Membantu gambar tetap tampil meski pindah dari localhost ke domain live.
 */
function sekolahku_make_url_dynamic( $url ) {
	if ( is_string( $url ) && strpos( $url, '/wp-content/uploads/' ) !== false ) {
		$parts = explode( '/wp-content/uploads/', $url );
		return site_url( '/wp-content/uploads/' . end( $parts ) );
	}
	return $url;
}

/**
 * Helper pintar untuk mendeteksi foto Staf/Guru dari 4 pilihan lokasi.
 */
function sekolahku_get_staf_avatar( $post_id ) {
	// 1. Featured Image
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'large' );
		if ( $thumb ) {
			return $thumb;
		}
	}

	// 2. Custom Meta Field _staf_foto
	$custom_foto = get_post_meta( $post_id, '_staf_foto', true );
	if ( $custom_foto ) {
		return sekolahku_make_url_dynamic( $custom_foto );
	}

	// 3. Extract gambar pertama dari isi konten editor
	$post = get_post( $post_id );
	if ( $post && ! empty( $post->post_content ) ) {
		if ( preg_match( '/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches ) ) {
			if ( ! empty( $matches[1] ) ) {
				return sekolahku_make_url_dynamic( $matches[1] );
			}
		}
	}

	// 4. Default Fallback Image
	return 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto Fasilitas Sekolah.
 */
function sekolahku_get_fasilitas_thumb( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'medium_large' );
		if ( $thumb ) {
			return $thumb;
		}
	}

	$post = get_post( $post_id );
	if ( $post && ! empty( $post->post_content ) ) {
		if ( preg_match( '/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches ) ) {
			if ( ! empty( $matches[1] ) ) {
				return sekolahku_make_url_dynamic( $matches[1] );
			}
		}
	}

	return 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto Ekstrakurikuler.
 */
function sekolahku_get_ekskul_thumb( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'medium_large' );
		if ( $thumb ) {
			return $thumb;
		}
	}

	$custom_foto = get_post_meta( $post_id, '_ekskul_foto', true );
	if ( $custom_foto ) {
		return sekolahku_make_url_dynamic( $custom_foto );
	}

	$post = get_post( $post_id );
	if ( $post && ! empty( $post->post_content ) ) {
		if ( preg_match( '/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches ) ) {
			if ( ! empty( $matches[1] ) ) {
				return sekolahku_make_url_dynamic( $matches[1] );
			}
		}
	}

	return 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&q=80';
}

/**
 * Helper pintar untuk mendeteksi foto/sampul Galeri (Foto & Video).
 */
function sekolahku_get_galeri_thumb( $post_id ) {
	// 1. Featured Image
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'large' );
		if ( $thumb ) {
			return $thumb;
		}
	}

	$post = get_post( $post_id );
	if ( $post && ! empty( $post->post_content ) ) {
		// 2. Extract tag <img> dari isi konten (Add Media)
		if ( preg_match( '/<img.+?src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $matches ) ) {
			if ( ! empty( $matches[1] ) ) {
				return sekolahku_make_url_dynamic( $matches[1] );
			}
		}

		// 3. Extract YouTube Thumbnail
		if ( preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $post->post_content, $yt_matches ) ) {
			if ( ! empty( $yt_matches[1] ) ) {
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
function sekolahku_get_galeri_badge( $post_id ) {
	$post = get_post( $post_id );
	$count = 0;
	if ( has_post_thumbnail( $post_id ) ) {
		$count++;
	}
	if ( $post && ! empty( $post->post_content ) ) {
		preg_match_all( '/<img[^>]+>/i', $post->post_content, $img_matches );
		if ( ! empty( $img_matches[0] ) ) {
			$count += count( $img_matches[0] );
		}
		$has_video = preg_match( '/<iframe|<video|youtube\.com|youtu\.be|vimeo\.com|\.mp4/i', $post->post_content );
		if ( $has_video ) {
			return '🎥 Video';
		}
	}

	return ( $count > 0 ) ? ( '📷 ' . $count . ' Media' ) : '📷 1';
}

/**
 * Helper pintar untuk merender komponen Tombol Bagikan (Share Buttons).
 */
function sekolahku_render_share_buttons() {
	get_template_part( 'template-parts/share-buttons' );
}



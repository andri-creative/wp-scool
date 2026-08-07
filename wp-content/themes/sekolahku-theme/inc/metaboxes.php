<?php
/**
 * Modul Registrasi Metaboxes Tambahan - SekolahKu Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sekolahku_register_meta_boxes() {
	add_meta_box( 'sekolahku_agenda_meta', 'Detail Agenda', 'sekolahku_render_agenda_meta', 'agenda', 'normal', 'high' );
	add_meta_box( 'sekolahku_testi_meta', 'Detail Testimoni', 'sekolahku_render_testi_meta', 'testimoni', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'sekolahku_register_meta_boxes' );

function sekolahku_render_staf_meta( $post ) {
	// Dummy safe fallback
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

function sekolahku_render_testi_meta( $post ) {
	$role = get_post_meta( $post->ID, '_testi_role', true );
	wp_nonce_field( 'sekolahku_save_testi_meta', 'sekolahku_testi_nonce' );
	echo '<p><label>Jabatan / Kelas (mis. Orang Tua Siswa Kelas IX)</label><br><input type="text" style="width:100%" name="testi_role" value="' . esc_attr( $role ) . '"></p>';
}

function sekolahku_save_meta_boxes( $post_id ) {
	if ( isset( $_POST['sekolahku_ekskul_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_ekskul_nonce'], 'sekolahku_save_ekskul_meta' ) ) {
		$ekskul_fields = array( 'ekskul_foto', 'ekskul_hari', 'ekskul_waktu', 'ekskul_lokasi', 'ekskul_anggota', 'ekskul_pembina', 'ekskul_status' );
		foreach ( $ekskul_fields as $field_key ) {
			if ( isset( $_POST[ $field_key ] ) ) {
				update_post_meta( $post_id, '_' . $field_key, sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) ) );
			}
		}
	}

	if ( isset( $_POST['sekolahku_agenda_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_agenda_nonce'], 'sekolahku_save_agenda_meta' ) ) {
		foreach ( array( 'agenda_tanggal', 'agenda_waktu', 'agenda_lokasi' ) as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
	}

	if ( isset( $_POST['sekolahku_testi_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_testi_nonce'], 'sekolahku_save_testi_meta' ) ) {
		if ( isset( $_POST['testi_role'] ) ) {
			update_post_meta( $post_id, '_testi_role', sanitize_text_field( wp_unslash( $_POST['testi_role'] ) ) );
		}
	}

	if ( isset( $_POST['sekolahku_staf_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_staf_nonce'], 'sekolahku_save_staf_meta' ) ) {
		$staf_fields = array( 'staf_foto', 'staf_role', 'staf_status', 'staf_nip', 'staf_nuptk', 'staf_aktif', 'staf_gender', 'staf_ttl', 'staf_agama', 'staf_alamat', 'staf_kontak' );
		foreach ( $staf_fields as $field_key ) {
			if ( isset( $_POST[ $field_key ] ) ) {
				update_post_meta( $post_id, '_' . $field_key, sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) ) );
			}
		}
	}
}
add_action( 'save_post', 'sekolahku_save_meta_boxes' );

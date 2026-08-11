<?php
/**
 * Modul Registrasi Metaboxes Tambahan - SekolahKu Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sekolahku_register_meta_boxes() {
	add_meta_box( 'sekolahku_staf_meta', 'Detail Profil Staf & Guru', 'sekolahku_render_staf_meta', 'staf', 'normal', 'high' );
	add_meta_box( 'sekolahku_agenda_meta', 'Detail Agenda', 'sekolahku_render_agenda_meta', 'agenda', 'normal', 'high' );
	add_meta_box( 'sekolahku_testi_meta', 'Detail Testimoni', 'sekolahku_render_testi_meta', 'testimoni', 'normal', 'high' );
	add_meta_box( 'sekolahku_berita_author_meta', 'Detail Penulis Berita (Custom Author)', 'sekolahku_render_berita_author_meta', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'sekolahku_register_meta_boxes' );

function sekolahku_render_staf_meta( $post ) {
	wp_nonce_field( 'sekolahku_save_staf_meta', 'sekolahku_staf_nonce' );
	$role   = get_post_meta( $post->ID, '_staf_role', true );
	$status = get_post_meta( $post->ID, '_staf_status', true );
	$nip    = get_post_meta( $post->ID, '_staf_nip', true );
	$nuptk  = get_post_meta( $post->ID, '_staf_nuptk', true );
	$aktif  = get_post_meta( $post->ID, '_staf_aktif', true );
	$gender = get_post_meta( $post->ID, '_staf_gender', true );
	$ttl    = get_post_meta( $post->ID, '_staf_ttl', true );
	$agama  = get_post_meta( $post->ID, '_staf_agama', true );
	$alamat = get_post_meta( $post->ID, '_staf_alamat', true );
	$kontak = get_post_meta( $post->ID, '_staf_kontak', true );
	$foto   = get_post_meta( $post->ID, '_staf_foto', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
		<p><label><strong>Jabatan / Mata Pelajaran</strong></label><br><input type="text" style="width:100%" name="staf_role" value="<?php echo esc_attr( $role ); ?>" placeholder="Contoh: Guru DKV"></p>
		<p><label><strong>Status Kepegawaian</strong></label><br><input type="text" style="width:100%" name="staf_status" value="<?php echo esc_attr( $status ); ?>" placeholder="Contoh: Honorer / PNS / Tetap"></p>
		<p><label><strong>NIP</strong></label><br><input type="text" style="width:100%" name="staf_nip" value="<?php echo esc_attr( $nip ); ?>" placeholder="Contoh: 198709102015041001"></p>
		<p><label><strong>NUPTK</strong></label><br><input type="text" style="width:100%" name="staf_nuptk" value="<?php echo esc_attr( $nuptk ); ?>" placeholder="Contoh: 4234567890123456"></p>
		<p><label><strong>Masa Aktif / Tahun Masuk</strong></label><br><input type="text" style="width:100%" name="staf_aktif" value="<?php echo esc_attr( $aktif ); ?>" placeholder="Contoh: 2019 - Sekarang"></p>
		<p><label><strong>Jenis Kelamin</strong></label><br><input type="text" style="width:100%" name="staf_gender" value="<?php echo esc_attr( $gender ); ?>" placeholder="Contoh: Perempuan / Laki-laki"></p>
		<p><label><strong>Tempat, Tanggal Lahir</strong></label><br><input type="text" style="width:100%" name="staf_ttl" value="<?php echo esc_attr( $ttl ); ?>" placeholder="Contoh: Bandung, 15 March 1994"></p>
		<p><label><strong>Agama</strong></label><br><input type="text" style="width:100%" name="staf_agama" value="<?php echo esc_attr( $agama ); ?>" placeholder="Contoh: Islam"></p>
		<p><label><strong>Alamat Lengkap</strong></label><br><input type="text" style="width:100%" name="staf_alamat" value="<?php echo esc_attr( $alamat ); ?>" placeholder="Contoh: Jl. Anggrek No. 8, Bandung"></p>
		<p><label><strong>No. Kontak / Telepon</strong></label><br><input type="text" style="width:100%" name="staf_kontak" value="<?php echo esc_attr( $kontak ); ?>" placeholder="Contoh: 081377788899"></p>
	</div>
	
	<?php
	$staf_name = get_the_title( $post->ID );
	$default_avatar = 'https://ui-avatars.com/api/?name=' . rawurlencode( ! empty( $staf_name ) ? $staf_name : 'Guru' ) . '&background=3858e9&color=fff&size=128';
	$preview_photo  = ! empty( $foto ) ? $foto : $default_avatar;
	?>
	<div style="margin-top: 16px;">
		<label><strong>Foto Profil / Avatar Guru</strong></label><br>
		<div style="display: flex; align-items: center; gap: 15px; margin-top: 8px;">
			<div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; background: #f1f5f9; border: 1px solid #cbd5e1; flex-shrink:0;">
				<img id="staf_photo_preview" src="<?php echo esc_url( $preview_photo ); ?>" style="width:100%; height:100%; object-fit:cover;">
			</div>
			<div>
				<input type="hidden" id="staf_foto" name="staf_foto" value="<?php echo esc_attr( $foto ); ?>">
				<button type="button" class="button button-secondary" id="btn_upload_staf_photo">📷 Pilih / Upload Foto Guru</button>
				<button type="button" class="button button-link-delete" id="btn_remove_staf_photo" style="<?php echo empty( $foto ) ? 'display:none;' : ''; ?>margin-left: 8px;">Hapus Foto</button>
				<p class="description" style="margin-top: 5px; font-size: 11px;">Upload foto profil. Jika tidak ada, sistem akan menampilkan inisial nama secara otomatis.</p>
			</div>
		</div>
	</div>

	<script>
	jQuery(document).ready(function($){
		var stafFrame;
		$('#btn_upload_staf_photo').on('click', function(e){
			e.preventDefault();
			if (stafFrame) {
				stafFrame.open();
				return;
			}
			stafFrame = wp.media({
				title: 'Pilih atau Upload Foto Guru',
				button: { text: 'Gunakan Foto Ini' },
				multiple: false
			});
			stafFrame.on('select', function(){
				var attachment = stafFrame.state().get('selection').first().toJSON();
				$('#staf_foto').val(attachment.url);
				$('#staf_photo_preview').attr('src', attachment.url);
				$('#btn_remove_staf_photo').show();
			});
			stafFrame.open();
		});

		$('#btn_remove_staf_photo').on('click', function(e){
			e.preventDefault();
			$('#staf_foto').val('');
			var defaultAvatar = '<?php echo esc_js($default_avatar); ?>';
			$('#staf_photo_preview').attr('src', defaultAvatar);
			$(this).hide();
		});
	});
	</script>
	<?php
}

function sekolahku_render_agenda_meta( $post ) {
	$tanggal = get_post_meta( $post->ID, '_agenda_tanggal', true );
	$waktu   = get_post_meta( $post->ID, '_agenda_waktu', true );
	$lokasi  = get_post_meta( $post->ID, '_agenda_lokasi', true );
	wp_nonce_field( 'sekolahku_save_agenda_meta', 'sekolahku_agenda_nonce' );
	?>
	<p><label><strong>Tanggal Agenda</strong> (Kosongkan jika ingin menggunakan tanggal publish)</label><br>
	<input type="text" style="width:100%" name="agenda_tanggal" value="<?php echo esc_attr( $tanggal ); ?>" placeholder="Contoh: 17 Agustus 2026"></p>
	<p><label><strong>Jadwal Waktu / Jam</strong></label><br>
	<input type="text" style="width:100%" name="agenda_waktu" value="<?php echo esc_attr( $waktu ); ?>" placeholder="Contoh: 07:00 - 11:00"></p>
	<p><label><strong>Lokasi Pelaksanaan</strong></label><br>
	<input type="text" style="width:100%" name="agenda_lokasi" value="<?php echo esc_attr( $lokasi ); ?>" placeholder="Contoh: Lapangan Sekolah & Ruang Multimedia"></p>
	<?php
}

function sekolahku_render_testi_meta( $post ) {
	$role = get_post_meta( $post->ID, '_testi_role', true );
	wp_nonce_field( 'sekolahku_save_testi_meta', 'sekolahku_testi_nonce' );
	echo '<p><label>Jabatan / Kelas (mis. Orang Tua Siswa Kelas IX)</label><br><input type="text" style="width:100%" name="testi_role" value="' . esc_attr( $role ) . '"></p>';
}

function sekolahku_admin_enqueue_media( $hook ) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'sekolahku_admin_enqueue_media' );

function sekolahku_render_berita_author_meta( $post ) {
	wp_nonce_field( 'sekolahku_save_berita_meta', 'sekolahku_berita_nonce' );
	$author_name  = get_post_meta( $post->ID, '_berita_author_name', true );
	$author_photo = get_post_meta( $post->ID, '_berita_author_photo', true );
	$author_bio   = get_post_meta( $post->ID, '_berita_author_bio', true );

	$default_avatar = 'https://ui-avatars.com/api/?name=' . rawurlencode( ! empty( $author_name ) ? $author_name : 'Penulis' ) . '&background=ff7a00&color=fff&size=128';
	$preview_photo  = ! empty( $author_photo ) ? $author_photo : $default_avatar;
	?>
	<p><label><strong>Nama Penulis / Redaksi</strong> (Kosongkan jika menggunakan nama akun WP Admin)</label><br>
	<input type="text" style="width:100%" id="berita_author_name" name="berita_author_name" value="<?php echo esc_attr( $author_name ); ?>" placeholder="Contoh: Tim Humas Sekolah / Drs. Ahmad Fauzi"></p>

	<div style="margin-bottom: 16px;">
		<label><strong>Foto / Avatar Penulis</strong></label><br>
		<div style="display: flex; align-items: center; gap: 15px; margin-top: 8px;">
			<div style="width: 64px; height: 64px; border-radius: 50%; overflow: hidden; background: #f1f5f9; border: 1px solid #cbd5e1; flex-shrink:0;">
				<img id="author_photo_preview" src="<?php echo esc_url( $preview_photo ); ?>" style="width:100%; height:100%; object-fit:cover;">
			</div>
			<div>
				<input type="hidden" id="berita_author_photo" name="berita_author_photo" value="<?php echo esc_attr( $author_photo ); ?>">
				<button type="button" class="button button-secondary" id="btn_upload_author_photo">📷 Pilih / Upload Foto Penulis</button>
				<button type="button" class="button button-link-delete" id="btn_remove_author_photo" style="<?php echo empty( $author_photo ) ? 'display:none;' : ''; ?>margin-left: 8px;">Hapus Foto</button>
				<p class="description" style="margin-top: 5px; font-size: 11px;">Jika tidak memilih foto, sistem otomatis menggunakan Avatar Placeholder.</p>
			</div>
		</div>
	</div>

	<p><label><strong>Keterangan / Bio Singkat Penulis</strong></label><br>
	<textarea style="width:100%; height:70px;" name="berita_author_bio" placeholder="Contoh: Staf Pengajar & Kepala Laboratorium Komputer SMK SekolahKu..."><?php echo esc_textarea( $author_bio ); ?></textarea></p>

	<script>
	jQuery(document).ready(function($){
		var frame;
		$('#btn_upload_author_photo').on('click', function(e){
			e.preventDefault();
			if (frame) {
				frame.open();
				return;
			}
			frame = wp.media({
				title: 'Pilih atau Upload Foto Penulis',
				button: { text: 'Gunakan Foto Ini' },
				multiple: false
			});
			frame.on('select', function(){
				var attachment = frame.state().get('selection').first().toJSON();
				$('#berita_author_photo').val(attachment.url);
				$('#author_photo_preview').attr('src', attachment.url);
				$('#btn_remove_author_photo').show();
			});
			frame.open();
		});

		$('#btn_remove_author_photo').on('click', function(e){
			e.preventDefault();
			$('#berita_author_photo').val('');
			var authorName = $('#berita_author_name').val() || 'Penulis';
			var defaultAvatar = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(authorName) + '&background=ff7a00&color=fff&size=128';
			$('#author_photo_preview').attr('src', defaultAvatar);
			$(this).hide();
		});
	});
	</script>
	<?php
}

function sekolahku_save_meta_boxes( $post_id ) {
	if ( isset( $_POST['sekolahku_berita_nonce'] ) && wp_verify_nonce( $_POST['sekolahku_berita_nonce'], 'sekolahku_save_berita_meta' ) ) {
		foreach ( array( 'berita_author_name', 'berita_author_photo', 'berita_author_bio' ) as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
	}

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

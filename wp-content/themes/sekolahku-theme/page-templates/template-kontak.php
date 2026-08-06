<?php
/**
 * Template Name: PPDB & Kontak
 * Description: Info kontak sekolah + form pesan singkat (wp_mail, tanpa plugin).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();

$status = isset( $_GET['kontak'] ) ? sanitize_text_field( wp_unslash( $_GET['kontak'] ) ) : '';
?>

<section class="page-header">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<p>Hubungi kami untuk informasi pendaftaran siswa baru atau pertanyaan lainnya.</p>
	</div>
</section>

<div class="container page-content">

	<?php if ( 'sukses' === $status ) : ?>
		<div class="form-notice form-success">Pesan Anda berhasil dikirim. Tim kami akan segera menghubungi Anda kembali.</div>
	<?php elseif ( 'gagal' === $status ) : ?>
		<div class="form-notice form-error">Mohon lengkapi semua kolom dengan benar sebelum mengirim pesan.</div>
	<?php endif; ?>

	<div class="grid grid-2 kontak-grid">

		<div class="card kontak-info">
			<h3>Informasi Kontak</h3>
			<ul class="kontak-list">
				<li><strong>Alamat:</strong> <?php echo esc_html( get_theme_mod( 'sekolahku_alamat', 'Jl. Pendidikan No. 1, Kota Anda' ) ); ?></li>
				<li><strong>Telepon / WhatsApp:</strong> <?php echo esc_html( get_theme_mod( 'sekolahku_telepon', '0851-2222-3333' ) ); ?></li>
				<li><strong>Email:</strong> <?php echo esc_html( get_theme_mod( 'sekolahku_email', 'info@sekolahku.sch.id' ) ); ?></li>
				<li><strong>Jam Layanan:</strong> <?php echo esc_html( get_theme_mod( 'sekolahku_jam', 'Senin - Jumat, 07.00 - 15.00' ) ); ?></li>
			</ul>

			<div class="kontak-map">
				<!-- Ganti src di bawah dengan link embed Google Maps lokasi sekolah -->
				<iframe
					src="https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed"
					width="100%" height="260" style="border:0;" loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>

		<div class="card kontak-form-wrap">
			<h3>Kirim Pesan / Pertanyaan PPDB</h3>
			<form method="post" class="kontak-form" action="<?php echo esc_url( get_permalink() ); ?>">
				<?php wp_nonce_field( 'sekolahku_contact_submit', 'sekolahku_contact_nonce' ); ?>

				<label for="nama">Nama Lengkap</label>
				<input type="text" name="nama" id="nama" required>

				<label for="email">Alamat Email</label>
				<input type="email" name="email" id="email" required>

				<label for="pesan">Pesan</label>
				<textarea name="pesan" id="pesan" rows="5" required></textarea>

				<button type="submit" class="btn btn-primary">Kirim Pesan</button>
			</form>
			<p class="form-note">Catatan: untuk kebutuhan produksi (validasi lebih ketat, anti-spam), pertimbangkan memakai plugin form seperti Contact Form 7 atau WPForms.</p>
		</div>

	</div>
</div>

<?php get_footer(); ?>

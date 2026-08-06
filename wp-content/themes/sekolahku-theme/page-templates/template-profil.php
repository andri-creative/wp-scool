<?php
/**
 * Template Name: Profil Sekolah
 * Description: Halaman visi misi, sejarah, dan fasilitas sekolah.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<section class="page-header">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<p>Mengenal lebih dekat visi, misi, dan perjalanan sekolah kami.</p>
	</div>
</section>

<div class="container page-content">

	<!-- Konten halaman dari editor WordPress -->
	<div class="page-editor-content">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>

	<!-- VISI MISI -->
	<div class="grid grid-2 profil-visi-misi">
		<div class="card profil-block">
			<h3>Visi</h3>
			<p>Menjadi lembaga pendidikan unggul yang menghasilkan generasi cerdas, berakhlak mulia, dan berdaya saing global.</p>
		</div>
		<div class="card profil-block">
			<h3>Misi</h3>
			<ul class="misi-list">
				<li>Menyelenggarakan pembelajaran yang aktif, kreatif, dan menyenangkan.</li>
				<li>Mengembangkan potensi siswa melalui kegiatan akademik dan non-akademik.</li>
				<li>Membangun karakter siswa yang berlandaskan nilai kebangsaan dan moral.</li>
				<li>Menjalin kerja sama aktif dengan orang tua dan masyarakat.</li>
			</ul>
		</div>
	</div>

	<!-- FASILITAS -->
	<div class="section-title">
		<span class="eyebrow">Sarana &amp; Prasarana</span>
		<h2>Fasilitas Sekolah</h2>
	</div>

	<div class="grid grid-3">
		<?php
		$fasilitas_query = new WP_Query( array(
			'post_type'      => 'fasilitas',
			'posts_per_page' => 6,
		) );

		if ( $fasilitas_query->have_posts() ) :
			while ( $fasilitas_query->have_posts() ) :
				$fasilitas_query->the_post();
				?>
				<div class="card feature-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium' ); ?>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<div class="card feature-card">
				<h3>Laboratorium Komputer</h3>
				<p>Ruang praktik teknologi informasi dengan perangkat lengkap dan terkini.</p>
			</div>
			<div class="card feature-card">
				<h3>Perpustakaan</h3>
				<p>Koleksi buku pelajaran dan bacaan umum untuk mendukung minat baca siswa.</p>
			</div>
			<div class="card feature-card">
				<h3>Ruang Ekstrakurikuler</h3>
				<p>Fasilitas untuk kegiatan seni, olahraga, dan pengembangan bakat siswa.</p>
			</div>
			<?php
		endif;
		?>
	</div>

</div>

<?php get_footer(); ?>

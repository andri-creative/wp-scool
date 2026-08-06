<?php
/**
 * Template Beranda (Homepage) - versi lengkap.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$hero_image = get_theme_mod( 'sekolahku_hero_image', '' );
?>

<!-- HERO -->
<section class="hero" <?php if ( $hero_image ) : ?>style="background-image:linear-gradient(180deg, rgba(29,78,216,.85), rgba(30,58,138,.9)), url('<?php echo esc_url( $hero_image ); ?>');"<?php endif; ?>>
	<div class="container hero-inner">
		<span class="hero-eyebrow">Selamat Datang</span>
		<h1><?php echo esc_html( get_theme_mod( 'sekolahku_hero_title', 'Membentuk Generasi Cerdas, Berkarakter, dan Siap Masa Depan' ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'sekolahku_hero_subtitle', 'Sekolah dengan kurikulum modern, guru berpengalaman, dan fasilitas lengkap untuk mendukung tumbuh kembang siswa.' ) ); ?></p>
		<div class="hero-actions">
			<a href="<?php echo esc_url( home_url( '/ppdb-kontak/' ) ); ?>" class="btn btn-accent">Daftar PPDB Sekarang</a>
			<a href="<?php echo esc_url( home_url( '/profil-sekolah/' ) ); ?>" class="btn btn-outline">Profil Sekolah</a>
		</div>
	</div>
</section>

<!-- STATISTIK -->
<section class="stats-bar">
	<div class="container stats-grid stats-grid-5">
		<div class="stat-item">
			<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_akreditasi', 'A' ) ); ?></span>
			<span class="stat-label">Akreditasi</span>
		</div>
		<div class="stat-item">
			<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_siswa', '650+' ) ); ?></span>
			<span class="stat-label">Siswa Aktif</span>
		</div>
		<div class="stat-item">
			<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_guru', '150+' ) ); ?></span>
			<span class="stat-label">Guru &amp; Staf</span>
		</div>
		<div class="stat-item">
			<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_ekskul', '15+' ) ); ?></span>
			<span class="stat-label">Ekstrakurikuler</span>
		</div>
		<div class="stat-item">
			<span class="stat-number"><?php echo esc_html( get_theme_mod( 'sekolahku_stat_jurusan', '10' ) ); ?></span>
			<span class="stat-label">Jurusan</span>
		</div>
	</div>
</section>

<!-- SAMBUTAN KEPALA SEKOLAH -->
<section class="section">
	<div class="container welcome-grid">
		<div class="welcome-image">
			<?php
			$welcome_image = get_theme_mod( 'sekolahku_welcome_image', '' );
			if ( $welcome_image ) :
				?>
				<img src="<?php echo esc_url( $welcome_image ); ?>" alt="Foto Kepala Sekolah">
			<?php else : ?>
				<div class="news-thumb-placeholder welcome-placeholder"></div>
			<?php endif; ?>
		</div>
		<div class="welcome-content">
			<span class="eyebrow">Sambutan</span>
			<h2>Sambutan Kepala Sekolah</h2>
			<p><?php echo esc_html( get_theme_mod( 'sekolahku_welcome_text', 'Selamat datang di website resmi sekolah kami.' ) ); ?></p>
			<div class="welcome-signature">
				<strong><?php echo esc_html( get_theme_mod( 'sekolahku_welcome_name', 'Nama Kepala Sekolah, M.Pd' ) ); ?></strong>
				<span>Kepala Sekolah</span>
			</div>
		</div>
	</div>
</section>

<!-- PENGUMUMAN -->
<section class="section section-alt">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Info Penting</span>
			<h2>Pengumuman</h2>
		</div>

		<div class="grid grid-2">
			<?php
			$pengumuman_query = new WP_Query( array( 'post_type' => 'pengumuman', 'posts_per_page' => 4 ) );
			if ( $pengumuman_query->have_posts() ) :
				while ( $pengumuman_query->have_posts() ) : $pengumuman_query->the_post();
					?>
					<article class="card announcement-card">
						<span class="announcement-date"><?php echo esc_html( get_the_date() ); ?></span>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
						<a href="<?php the_permalink(); ?>" class="read-more">Selengkapnya &rarr;</a>
					</article>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada pengumuman. Tambahkan lewat menu "Pengumuman" di dashboard.</p>';
			endif;
			?>
		</div>
		<div class="section-cta">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'pengumuman' ) ); ?>" class="btn btn-primary">Lihat Semua Pengumuman</a>
		</div>
	</div>
</section>

<!-- AGENDA -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Jadwal Kegiatan</span>
			<h2>Agenda Sekolah</h2>
		</div>

		<div class="agenda-list">
			<?php
			$agenda_query = new WP_Query( array( 'post_type' => 'agenda', 'posts_per_page' => 5 ) );
			if ( $agenda_query->have_posts() ) :
				while ( $agenda_query->have_posts() ) : $agenda_query->the_post();
					$tanggal = get_post_meta( get_the_ID(), '_agenda_tanggal', true );
					$waktu   = get_post_meta( get_the_ID(), '_agenda_waktu', true );
					$lokasi  = get_post_meta( get_the_ID(), '_agenda_lokasi', true );
					?>
					<article class="agenda-item card">
						<div class="agenda-date-box">
							<?php echo esc_html( $tanggal ? $tanggal : get_the_date() ); ?>
						</div>
						<div class="agenda-info">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p>
								<?php if ( $waktu ) : ?><span><?php echo esc_html( $waktu ); ?></span><?php endif; ?>
								<?php if ( $lokasi ) : ?><span> &middot; <?php echo esc_html( $lokasi ); ?></span><?php endif; ?>
							</p>
						</div>
					</article>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada agenda. Tambahkan lewat menu "Agenda" di dashboard.</p>';
			endif;
			?>
		</div>
		<div class="section-cta">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'agenda' ) ); ?>" class="btn btn-primary">Lihat Semua Agenda</a>
		</div>
	</div>
</section>

<!-- KEUNGGULAN -->
<section class="section section-alt">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Kenapa Memilih Kami</span>
			<h2>Keunggulan Sekolah Kami</h2>
		</div>

		<div class="grid grid-3">
			<div class="card feature-card"><div class="feature-icon">🧑‍🏫</div><h3>Guru Profesional</h3><p>Tenaga pendidik berpengalaman yang fokus pada perkembangan akademik dan karakter siswa.</p></div>
			<div class="card feature-card"><div class="feature-icon">🏫</div><h3>Fasilitas Modern</h3><p>Ruang belajar nyaman dan sarana praktik lengkap untuk mendukung pembelajaran.</p></div>
			<div class="card feature-card"><div class="feature-icon">📘</div><h3>Kurikulum Relevan</h3><p>Materi disusun mengikuti standar nasional dan kebutuhan dunia kerja.</p></div>
			<div class="card feature-card"><div class="feature-icon">🌱</div><h3>Lingkungan Positif</h3><p>Budaya sekolah yang disiplin, inklusif, dan mendukung prestasi siswa.</p></div>
			<div class="card feature-card"><div class="feature-icon">🎨</div><h3>Ekstrakurikuler Aktif</h3><p>Beragam kegiatan untuk mengembangkan minat, bakat, dan kemampuan sosial siswa.</p></div>
			<div class="card feature-card"><div class="feature-icon">💼</div><h3>Dukungan Karier</h3><p>Program pembinaan dan kerja sama mitra industri untuk masa depan siswa.</p></div>
		</div>
	</div>
</section>

<!-- PROGRAM KEAHLIAN -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Pilihan Jurusan</span>
			<h2>Program Keahlian</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$program_query = new WP_Query( array( 'post_type' => 'program', 'posts_per_page' => 6 ) );
			if ( $program_query->have_posts() ) :
				while ( $program_query->have_posts() ) : $program_query->the_post();
					?>
					<a href="<?php the_permalink(); ?>" class="card program-card">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?>
							<div class="news-thumb-placeholder"></div>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
					</a>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada data program. Tambahkan lewat menu "Program Keahlian" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- STAF & GURU -->
<section class="section section-alt">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Tenaga Pendidik</span>
			<h2>Staf &amp; Guru</h2>
		</div>

		<div class="grid grid-4">
			<?php
			$staf_query = new WP_Query( array( 'post_type' => 'staf', 'posts_per_page' => 8 ) );
			if ( $staf_query->have_posts() ) :
				while ( $staf_query->have_posts() ) : $staf_query->the_post();
					?>
					<div class="card staff-card">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?>
							<div class="news-thumb-placeholder"></div>
						<?php endif; ?>
						<div class="staff-body">
							<h3><?php the_title(); ?></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						</div>
					</div>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada data staf/guru. Tambahkan lewat menu "Staf & Guru" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- FASILITAS -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Sarana &amp; Prasarana</span>
			<h2>Fasilitas Sekolah</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$fasilitas_query = new WP_Query( array( 'post_type' => 'fasilitas', 'posts_per_page' => 6 ) );
			if ( $fasilitas_query->have_posts() ) :
				while ( $fasilitas_query->have_posts() ) : $fasilitas_query->the_post();
					?>
					<div class="card feature-card facility-card">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); endif; ?>
						<h3><?php the_title(); ?></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
					</div>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada data fasilitas. Tambahkan lewat menu "Fasilitas Sekolah" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- EKSTRAKURIKULER -->
<section class="section section-alt">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Kegiatan Non-Akademik</span>
			<h2>Ekstrakurikuler</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$ekskul_query = new WP_Query( array( 'post_type' => 'ekskul', 'posts_per_page' => 6 ) );
			if ( $ekskul_query->have_posts() ) :
				while ( $ekskul_query->have_posts() ) : $ekskul_query->the_post();
					$pembina = get_post_meta( get_the_ID(), '_ekskul_pembina', true );
					$anggota = get_post_meta( get_the_ID(), '_ekskul_anggota', true );
					?>
					<div class="card feature-card">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); endif; ?>
						<h3><?php the_title(); ?></h3>
						<?php if ( $anggota ) : ?><p>Jumlah Anggota: <?php echo esc_html( $anggota ); ?></p><?php endif; ?>
						<?php if ( $pembina ) : ?><p>Pembina: <?php echo esc_html( $pembina ); ?></p><?php endif; ?>
					</div>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada data ekstrakurikuler. Tambahkan lewat menu "Ekstrakurikuler" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- GALERI PREVIEW -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Dokumentasi</span>
			<h2>Galeri Kegiatan Sekolah</h2>
		</div>

		<div class="gallery-preview-grid">
			<?php
			$galeri_query = new WP_Query( array( 'post_type' => 'galeri', 'posts_per_page' => 6 ) );
			if ( $galeri_query->have_posts() ) :
				while ( $galeri_query->have_posts() ) : $galeri_query->the_post();
					?>
					<a href="<?php echo esc_url( home_url( '/galeri/' ) ); ?>" class="gallery-item">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?>
							<div class="news-thumb-placeholder"></div>
						<?php endif; ?>
						<span class="gallery-caption"><?php the_title(); ?></span>
					</a>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada foto galeri.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- TESTIMONI -->
<section class="section section-alt">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Apa Kata Mereka</span>
			<h2>Testimoni</h2>
		</div>

		<div class="grid grid-2">
			<?php
			$testi_query = new WP_Query( array( 'post_type' => 'testimoni', 'posts_per_page' => 4 ) );
			if ( $testi_query->have_posts() ) :
				while ( $testi_query->have_posts() ) : $testi_query->the_post();
					?>
					<div class="card testi-card">
						<p class="testi-text">&ldquo;<?php the_content(); ?>&rdquo;</p>
						<div class="testi-author">
							<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'thumbnail' ); endif; ?>
							<strong><?php the_title(); ?></strong>
						</div>
					</div>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada testimoni. Tambahkan lewat menu "Testimoni" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- BERITA TERBARU -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Info Terkini</span>
			<h2>Berita &amp; Artikel</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$berita_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3 ) );
			if ( $berita_query->have_posts() ) :
				while ( $berita_query->have_posts() ) : $berita_query->the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada berita yang dipublikasikan.</p>';
			endif;
			?>
		</div>
		<div class="section-cta">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn btn-primary">Lihat Semua Berita</a>
		</div>
	</div>
</section>

<!-- CTA PPDB -->
<section class="cta-ppdb">
	<div class="container cta-ppdb-inner">
		<div>
			<h2>Pendaftaran Siswa Baru Sudah Dibuka!</h2>
			<p>Informasi lengkap mengenai jadwal, persyaratan, dan alur pendaftaran tersedia di halaman PPDB.</p>
		</div>
		<a href="<?php echo esc_url( home_url( '/ppdb-kontak/' ) ); ?>" class="btn btn-accent">Daftar Sekarang</a>
	</div>
</section>

<?php get_footer(); ?>

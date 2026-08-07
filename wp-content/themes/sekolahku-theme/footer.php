<?php
/**
 * Template footer - Redesain Full Width (Skema Warna Biru Utama Navbar & Data 3 Kolom).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$alamat  = get_theme_mod( 'sekolahku_alamat', 'Jl. Raya Sukarno Hatta No. 123, Jakarta, Indonesia' );
$telepon = get_theme_mod( 'sekolahku_telepon', '021234567' );
$wa      = get_theme_mod( 'sekolahku_wa', '08123456789' );
$email   = get_theme_mod( 'sekolahku_email', 'halo@sekolah.sch.id' );

$fb      = get_theme_mod( 'sekolahku_social_facebook', '#' );
$ig      = get_theme_mod( 'sekolahku_social_instagram', '#' );
$yt      = get_theme_mod( 'sekolahku_social_youtube', '#' );
$tiktok  = get_theme_mod( 'sekolahku_social_tiktok', '#' );
$threads = get_theme_mod( 'sekolahku_social_threads', '#' );
$twitter = get_theme_mod( 'sekolahku_social_twitter', '#' );
?>

	<!-- FOOTER SECTION FULL WIDTH (WARNA BIRU UTAMA NAVBAR) -->
	<footer class="site-footer">
		<div class="container">
			<div class="footer-grid-3">

				<!-- KOLOM 1: LOGO & INFORMASI KONTAK SEKOLAH -->
				<div class="footer-col footer-col-brand">
					<div class="footer-brand">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<h2 class="footer-site-title"><?php bloginfo( 'name' ); ?></h2>
						<?php endif; ?>
					</div>

					<ul class="footer-contact-list">
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
							<span><?php echo esc_html( $alamat ); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<span><?php echo esc_html( $wa ); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<span><?php echo esc_html( $telepon ); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							<span><?php echo esc_html( $email ); ?></span>
						</li>
					</ul>

					<!-- BARIS IKON MEDIA SOSIAL -->
					<div class="footer-social-box">
						<a href="<?php echo esc_url( $fb ); ?>" class="social-btn" aria-label="Facebook" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.592 0 9 1.582 9 4.615V8z"/></svg>
						</a>
						<a href="<?php echo esc_url( $ig ); ?>" class="social-btn" aria-label="Instagram" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
						</a>
						<a href="<?php echo esc_url( $tiktok ); ?>" class="social-btn" aria-label="TikTok" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 1 1-5.2-1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V5.8a6.34 6.34 0 0 0-1-.08A6.33 6.33 0 1 0 15.68 12V8.45a8.16 8.16 0 0 0 4.77 1.52V6.52a4.85 4.85 0 0 1-.86.17z"/></svg>
						</a>
						<a href="<?php echo esc_url( $yt ); ?>" class="social-btn" aria-label="YouTube" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
						</a>
						<a href="<?php echo esc_url( $threads ); ?>" class="social-btn" aria-label="Threads" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 18.25c-3.452 0-6.25-2.798-6.25-6.25S8.548 5.75 12 5.75s6.25 2.798 6.25 6.25-2.798 6.25-6.25 6.25z"/></svg>
						</a>
						<a href="<?php echo esc_url( $twitter ); ?>" class="social-btn" aria-label="X" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
						</a>
					</div>
				</div>

				<!-- KOLOM 2: LATEST POST (BERITA TERBARU) -->
				<div class="footer-col footer-col-posts">
					<h3 class="footer-title">Latest Post</h3>
					<ul class="footer-posts-list">
						<?php
						$recent_posts = wp_get_recent_posts( array(
							'numberposts' => 5,
							'post_status' => 'publish',
						) );
						if ( ! empty( $recent_posts ) ) :
							foreach ( $recent_posts as $post_item ) :
								?>
								<li>
									<a href="<?php echo esc_url( get_permalink( $post_item['ID'] ) ); ?>">
										<span class="bullet-dot"></span>
										<span><?php echo esc_html( $post_item['post_title'] ); ?></span>
									</a>
								</li>
								<?php
							endforeach;
							wp_reset_query();
						else :
							?>
							<li><a href="#"><span class="bullet-dot"></span><span>Inovasi Pembelajaran untuk Meningkatkan Minat Belajar Siswa</span></a></li>
							<li><a href="#"><span class="bullet-dot"></span><span>Pentingnya Kolaborasi antara Sekolah dan Dunia Usaha</span></a></li>
							<li><a href="#"><span class="bullet-dot"></span><span>Cara Sekolah Mempersiapkan Siswa Menghadapi Masa Depan</span></a></li>
							<li><a href="#"><span class="bullet-dot"></span><span>Fasilitas Modern Sekolah untuk Mendukung Pembelajaran Berkualitas</span></a></li>
							<li><a href="#"><span class="bullet-dot"></span><span>Kegiatan Ekstrakurikuler dan Manfaatnya Bagi Siswa</span></a></li>
							<?php
						endif;
						?>
					</ul>
				</div>

				<!-- KOLOM 3: TENTANG SEKOLAH KAMI -->
				<div class="footer-col footer-col-about">
					<h3 class="footer-title">Tentang Sekolah Kami</h3>
					<p class="footer-about-text">
						<?php echo esc_html( get_theme_mod( 'sekolahku_footer_about', 'SekolahKu SMP adalah lembaga pendidikan unggulan yang berkomitmen mencetak generasi terampil, cerdas, dan berkarakter mulia melalui pembelajaran modern serta lingkungan sekolah yang kondusif.' ) ); ?>
					</p>
					<p class="footer-about-text">
						Dengan dukungan tenaga pengajar profesional dan fasilitas pembelajaran yang memadai, kami siap mendampingi setiap peserta didik mengenali potensi terbaiknya.
					</p>
				</div>

			</div>

			<!-- FOOTER BOTTOM BAR (COPYRIGHT & BACK TO TOP) -->
			<div class="footer-bottom-bar">
				<div class="footer-copyright">
					<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Terampil, Cerdas, Berkarakter.</p>
				</div>
				<button id="backToTop" class="back-to-top-btn" aria-label="Kembali ke Atas">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
				</button>
			</div>
		</div>
	</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const backToTopBtn = document.getElementById('backToTop');
	if (backToTopBtn) {
		window.addEventListener('scroll', function() {
			if (window.scrollY > 300) {
				backToTopBtn.classList.add('show');
			} else {
				backToTopBtn.classList.remove('show');
			}
		});
		backToTopBtn.addEventListener('click', function() {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		});
	}
});
</script>

<?php wp_footer(); ?>
</body>
</html>

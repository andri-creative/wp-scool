<?php
/** Template footer - Redesain Full Width (Skema Warna Biru Utama Navbar & Data 3 Kolom). */
if (!defined('ABSPATH')) {
	exit;
}

$alamat = get_theme_mod('sekolahku_alamat', 'Jl. Raya Sukarno Hatta No. 123, Jakarta, Indonesia');
$telepon = get_theme_mod('sekolahku_telepon', '021234567');
$wa = get_theme_mod('sekolahku_wa', '08123456789');
$email = get_theme_mod('sekolahku_email', 'halo@sekolah.sch.id');

$fb = get_theme_mod('sekolahku_social_facebook', '#');
$ig = get_theme_mod('sekolahku_social_instagram', '#');
$yt = get_theme_mod('sekolahku_social_youtube', '#');
$tiktok = get_theme_mod('sekolahku_social_tiktok', '#');
$threads = get_theme_mod('sekolahku_social_threads', '#');
$twitter   = get_theme_mod('sekolahku_social_twitter', '#');
$pinterest = get_theme_mod('sekolahku_social_pinterest', '#');
?>

	<!-- FOOTER SECTION FULL WIDTH (WARNA BIRU UTAMA NAVBAR) -->
	<footer class="site-footer">
		<div class="container">
			<div class="footer-grid-3">

				<!-- KOLOM 1: LOGO & INFORMASI KONTAK SEKOLAH -->
				<div class="footer-col footer-col-brand">
					<div class="footer-brand">
					<?php
					// Logo utama dari WordPress Site Identity
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						echo '<h2 class="footer-site-title">' . esc_html( get_bloginfo( 'name' ) ) . '</h2>';
					}

					// Loop 8 slot logo dinamis dari Customizer
					for ( $i = 1; $i <= 8; $i++ ) {
						$extra_logo = get_theme_mod( "sekolahku_footer_logo_{$i}", '' );
						if ( ! $extra_logo ) continue;
						?>
						<img src="<?php echo esc_url( $extra_logo ); ?>"
						     class="footer-extra-logo"
						     alt="<?php echo esc_attr( sprintf( __( 'Logo Partner %d', 'sekolahku' ), $i ) ); ?>"
						     loading="lazy">
						<?php
					}
					?>
				</div>

					<ul class="footer-contact-list">
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
							<span><?php echo esc_html($alamat); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<span><?php echo esc_html($wa); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<span><?php echo esc_html($telepon); ?></span>
						</li>
						<li>
							<svg class="footer-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							<span><?php echo esc_html($email); ?></span>
						</li>
					</ul>

					<!-- BARIS IKON MEDIA SOSIAL -->
					<div class="footer-social-box">
						<a href="<?php echo esc_url($fb); ?>" class="social-btn" aria-label="Facebook" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.592 0 9 1.582 9 4.615V8z"/></svg>
						</a>
						<a href="<?php echo esc_url($ig); ?>" class="social-btn" aria-label="Instagram" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
						</a>
						<a href="<?php echo esc_url($tiktok); ?>" class="social-btn" aria-label="TikTok" target="_blank" rel="noopener">
							<svg id="tiktok_icon_dark__Layer_2" width="16" height="16" viewBox="0 0 352.28 398.67" fill="currentColor"><g id="tiktok_icon_dark__Layer_1-2"><path d="M137.17 156.98v-15.56c-5.34-.73-10.76-1.18-16.29-1.18C54.23 140.24 0 194.47 0 261.13c0 40.9 20.43 77.09 51.61 98.97-20.12-21.6-32.46-50.53-32.46-82.31 0-65.7 52.69-119.28 118.03-120.81Z"/><path d="M140.02 333c29.74 0 54-23.66 55.1-53.13l.11-263.2h48.08c-1-5.41-1.55-10.97-1.55-16.67h-65.67l-.11 263.2c-1.1 29.47-25.36 53.13-55.1 53.13-9.24 0-17.95-2.31-25.61-6.34C105.3 323.9 121.6 333 140.02 333ZM333.13 106V91.37c-18.34 0-35.43-5.45-49.76-14.8 12.76 14.65 30.09 25.22 49.76 29.43Z"/><path d="M283.38 76.57c-13.98-16.05-22.47-37-22.47-59.91h-17.59c4.63 25.02 19.48 46.49 40.06 59.91ZM120.88 205.92c-30.44 0-55.21 24.77-55.21 55.21 0 21.2 12.03 39.62 29.6 48.86-6.55-9.08-10.45-20.18-10.45-32.2 0-30.44 24.77-55.21 55.21-55.21 5.68 0 11.13.94 16.29 2.55v-67.05c-5.34-.73-10.76-1.18-16.29-1.18-.96 0-1.9.05-2.85.07v51.49c-5.16-1.61-10.61-2.55-16.29-2.55Z"/><path d="M333.13 106v51.04c-34.05 0-65.61-10.89-91.37-29.38v133.47c0 66.66-54.23 120.88-120.88 120.88-25.76 0-49.64-8.12-69.28-21.91 22.08 23.71 53.54 38.57 88.42 38.57 66.66 0 120.88-54.23 120.88-120.88V144.33c25.76 18.49 57.32 29.38 91.37 29.38v-65.68c-6.57 0-12.97-.71-19.14-2.03Z"/><path d="M241.76 261.13V127.66c25.76 18.49 57.32 29.38 91.37 29.38V106c-19.67-4.21-37-14.77-49.76-29.43-20.58-13.42-35.43-34.88-40.06-59.91h-48.08l-.11 263.2c-1.1 29.47-25.36 53.13-55.1 53.13-18.42 0-34.72-9.1-44.75-23.01-17.57-9.25-29.6-27.67-29.6-48.86 0-30.44 24.77-55.21 55.21-55.21 5.68 0 11.13.94 16.29 2.55v-51.49C71.83 158.5 19.14 212.08 19.14 277.78c0 31.78 12.34 60.71 32.46 82.31C71.23 373.87 95.12 382 120.88 382c66.65 0 120.88-54.23 120.88-120.88Z" style="fill:#fff"/></g></svg>
						</a>
						<a href="<?php echo esc_url($yt); ?>" class="social-btn" aria-label="YouTube" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
						</a>
						<a href="<?php echo esc_url($threads); ?>" class="social-btn" aria-label="Threads" target="_blank" rel="noopener">
							<svg width="16" height="16" viewBox="0 0 192 192"><path fill="#fff" d="M141.537 88.988a66.667 66.667 0 0 0-2.518-1.143c-1.482-27.307-16.403-42.94-41.457-43.1h-.34c-14.986 0-27.449 6.396-35.12 18.036l13.779 9.452c5.73-8.695 14.724-10.548 21.348-10.548h.229c8.249.053 14.474 2.452 18.503 7.129 2.932 3.405 4.893 8.111 5.864 14.05-7.314-1.243-15.224-1.626-23.68-1.14-23.82 1.371-39.134 15.264-38.105 34.568.522 9.792 5.4 18.216 13.735 23.719 7.047 4.652 16.124 6.927 25.557 6.412 12.458-.683 22.231-5.436 29.049-14.127 5.178-6.6 8.453-15.153 9.899-25.93 5.937 3.583 10.337 8.298 12.767 13.966 4.132 9.635 4.373 25.468-8.546 38.376-11.319 11.308-24.925 16.2-45.488 16.351-22.809-.169-40.06-7.484-51.275-21.742C35.236 139.966 29.808 120.682 29.605 96c.203-24.682 5.63-43.966 16.133-57.317C56.954 24.425 74.204 17.11 97.013 16.94c22.975.17 40.526 7.52 52.171 21.847 5.71 7.026 10.015 15.86 12.853 26.162l16.147-4.308c-3.44-12.68-8.853-23.606-16.219-32.668C147.036 9.607 125.202.195 97.07 0h-.113C68.882.194 47.292 9.642 32.788 28.08 19.882 44.485 13.224 67.315 13.001 95.932L13 96v.067c.224 28.617 6.882 51.447 19.788 67.854C47.292 182.358 68.882 191.806 96.957 192h.113c24.96-.173 42.554-6.708 57.048-21.189 18.963-18.945 18.392-42.692 12.142-57.27-4.484-10.454-13.033-18.945-24.723-24.553ZM98.44 129.507c-10.44.588-21.286-4.098-21.82-14.135-.397-7.442 5.296-15.746 22.461-16.735 1.966-.114 3.895-.169 5.79-.169 6.235 0 12.068.606 17.371 1.765-1.978 24.702-13.58 28.713-23.802 29.274Z"/></svg>
						</a>
						<a href="<?php echo esc_url($twitter); ?>" class="social-btn" aria-label="X" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
						</a>
						<?php if ( $pinterest && $pinterest !== '#' ) : ?>
						<a href="<?php echo esc_url($pinterest); ?>" class="social-btn" aria-label="Pinterest" target="_blank" rel="noopener">
							<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
						</a>
						<?php endif; ?>
					</div>
				</div>

				<!-- KOLOM 2: LATEST POST (BERITA TERBARU) -->
				<div class="footer-col footer-col-posts">
					<h3 class="footer-title">Latest Post</h3>
					<ul class="footer-posts-list">
						<?php
						$recent_posts = wp_get_recent_posts(array(
							'numberposts' => 5,
							'post_status' => 'publish',
						));
						if (!empty($recent_posts)):
							foreach ($recent_posts as $post_item):
								?>
								<li>
									<a href="<?php echo esc_url(get_permalink($post_item['ID'])); ?>">
										<span class="bullet-dot"></span>
										<span><?php echo esc_html($post_item['post_title']); ?></span>
									</a>
								</li>
								<?php
							endforeach;
							wp_reset_query();
						else:
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
						<?php echo esc_html(get_theme_mod('sekolahku_footer_about', 'SekolahKu SMP adalah lembaga pendidikan unggulan yang berkomitmen mencetak generasi terampil, cerdas, dan berkarakter mulia melalui pembelajaran modern serta lingkungan sekolah yang kondusif.')); ?>
					</p>
					<p class="footer-about-text">
						Dengan dukungan tenaga pengajar profesional dan fasilitas pembelajaran yang memadai, kami siap mendampingi setiap peserta didik mengenali potensi terbaiknya.
					</p>
				</div>

			</div>

			<!-- FOOTER BOTTOM BAR (COPYRIGHT & BACK TO TOP) -->
			<div class="footer-bottom-bar">
				<div class="footer-copyright">
					<p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. Terampil, Cerdas, Berkarakter.</p>
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

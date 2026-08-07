<?php
/**
 * Template Single Staf & Guru - Halaman Detail Profil Staf/Guru.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
sekolahku_breadcrumb();
?>

<div class="container page-content">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id     = get_the_ID();
		$staf_role   = get_post_meta( $post_id, '_staf_role', true );
		$staf_status = get_post_meta( $post_id, '_staf_status', true );
		$staf_nip    = get_post_meta( $post_id, '_staf_nip', true );
		$staf_nuptk  = get_post_meta( $post_id, '_staf_nuptk', true );
		$staf_aktif  = get_post_meta( $post_id, '_staf_aktif', true );
		$staf_gender = get_post_meta( $post_id, '_staf_gender', true );
		$staf_ttl    = get_post_meta( $post_id, '_staf_ttl', true );
		$staf_agama  = get_post_meta( $post_id, '_staf_agama', true );
		$staf_alamat = get_post_meta( $post_id, '_staf_alamat', true );
		$staf_kontak = get_post_meta( $post_id, '_staf_kontak', true );
		?>

		<article <?php post_class( 'single-staf-profile' ); ?>>
			<style>
				.staf-profile-grid {
					display: grid;
					grid-template-columns: 300px 1fr;
					gap: 36px;
					margin-top: 20px;
				}
				@media (max-width: 868px) {
					.staf-profile-grid {
						grid-template-columns: 1fr;
					}
				}
				.staf-card-sidebar {
					background: #ffffff;
					border: 1px solid #e2e8f0;
					border-radius: 12px;
					padding: 24px;
					box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
					text-align: center;
					height: fit-content;
				}
				.staf-avatar-box {
					width: 100%;
					max-width: 240px;
					height: 280px;
					margin: 0 auto 20px;
					border-radius: 10px;
					overflow: hidden;
					background: #f1f5f9;
					box-shadow: 0 4px 10px rgba(0,0,0,0.08);
				}
				.staf-avatar-box img {
					width: 100%;
					height: 100%;
					object-fit: cover;
				}
				.staf-header-info h1 {
					font-size: 1.6rem;
					font-weight: 700;
					color: #0f172a;
					margin-bottom: 6px;
				}
				.staf-badge-role {
					display: inline-block;
					background: #e0f2fe;
					color: #0284c7;
					font-weight: 600;
					padding: 4px 14px;
					border-radius: 20px;
					font-size: 0.9rem;
					margin-bottom: 16px;
				}
				.staf-main-bio {
					background: #ffffff;
					border: 1px solid #e2e8f0;
					border-radius: 12px;
					padding: 32px;
					box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
				}
				.staf-bio-title {
					font-size: 1.3rem;
					font-weight: 700;
					color: #0f172a;
					margin-bottom: 16px;
					padding-bottom: 10px;
					border-bottom: 2px solid #0284c7;
				}
				.staf-bio-content {
					color: #334155;
					line-height: 1.85;
					font-size: 1.05rem;
				}
				.staf-bio-content ul, .staf-bio-content ol {
					margin: 12px 0 20px 24px;
				}
				.staf-bio-content li {
					margin-bottom: 6px;
				}
			</style>

			<div class="staf-profile-grid">
				<!-- SIDEBAR: Foto & Profil -->
				<div class="staf-card-sidebar">
					<div class="staf-avatar-box">
						<img src="<?php echo esc_url( sekolahku_get_staf_avatar( $post_id ) ); ?>" alt="<?php the_title_attribute(); ?>">
					</div>

					<div class="staf-header-info">
						<h1><?php the_title(); ?></h1>
						<?php
						$raw_content = get_the_content();
						$clean_text  = wp_strip_all_tags( str_replace( array( '</li>', '</p>', '<br>', '<br/>' ), "\n", $raw_content ) );
						if ( ! $staf_role ) {
							if ( preg_match( '/Jabatan\s*[:\-]?\s*([^\n\r]+)/i', $clean_text, $m_role ) ) {
								$staf_role = trim( $m_role[1] );
							}
						}
						?>
						<?php if ( $staf_role ) : ?>
							<span class="staf-badge-role"><?php echo esc_html( $staf_role ); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<!-- KONTEN UTAMA: Biodata & Biografi dari Editor Utama -->
				<div class="staf-main-bio">
					<h2 class="staf-bio-title">Profil & Biodata Guru</h2>
					<div class="staf-bio-content">
						<?php if ( get_the_content() ) : ?>
							<?php the_content(); ?>
						<?php else : ?>
							<p>Belum ada deskripsi profil yang ditambahkan untuk guru ini.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php get_footer(); ?>

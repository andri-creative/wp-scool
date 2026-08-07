<?php
/**
 * Template Single Galeri - Halaman Detail Foto & Video Galeri Sekolah.
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
		$post_id   = get_the_ID();
		$thumb_url = sekolahku_get_galeri_thumb( $post_id );
		?>

		<article <?php post_class( 'single-galeri-detail' ); ?>>
			<style>
				.galeri-article-wrapper {
					max-width: 960px;
					margin: 0 auto;
					background: #ffffff;
					border: 1px solid #e2e8f0;
					border-radius: 16px;
					padding: 36px;
					box-shadow: 0 4px 15px rgba(0,0,0,0.04);
				}
				.galeri-header-section {
					margin-bottom: 28px;
					text-align: center;
				}
				.galeri-header-section h1 {
					font-size: 2.25rem;
					font-weight: 800;
					color: #0f172a;
					margin-bottom: 12px;
					line-height: 1.3;
				}
				.galeri-meta-date {
					font-size: 0.9rem;
					color: #64748b;
				}
				.galeri-content-body {
					font-size: 1.1rem;
					line-height: 1.95;
					color: #334155;
				}
				.galeri-content-body p {
					margin-bottom: 20px;
				}
				.galeri-content-body img {
					max-width: 100%;
					height: auto;
					border-radius: 12px;
					margin: 16px 0;
					box-shadow: 0 4px 12px rgba(0,0,0,0.08);
				}
				.galeri-content-body iframe,
				.galeri-content-body video {
					width: 100%;
					max-width: 100%;
					aspect-ratio: 16 / 9;
					height: auto;
					border-radius: 12px;
					margin: 20px 0;
					border: none;
					box-shadow: 0 4px 12px rgba(0,0,0,0.1);
				}
				.galeri-back-btn {
					display: inline-flex;
					align-items: center;
					gap: 8px;
					margin-top: 32px;
					padding: 10px 20px;
					background: #f1f5f9;
					color: #0f172a;
					font-weight: 600;
					border-radius: 8px;
					text-decoration: none;
					transition: all 0.2s ease;
				}
				.galeri-back-btn:hover {
					background: #0284c7;
					color: #ffffff;
				}
			</style>

			<div class="galeri-article-wrapper">
				<div class="galeri-header-section">
					<h1><?php the_title(); ?></h1>
					<div class="galeri-meta-date">
						📅 Dipublikasikan pada: <?php echo get_the_date( 'j F Y' ); ?>
					</div>
				</div>

				<div class="galeri-content-body">
					<?php if ( get_the_content() ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<?php if ( $thumb_url ) : ?>
							<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<a href="<?php echo esc_url( home_url( '/#galeri' ) ); ?>" class="galeri-back-btn">
					&laquo; Kembali ke Beranda
				</a>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php get_footer(); ?>

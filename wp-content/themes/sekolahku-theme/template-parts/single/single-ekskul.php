<?php
/**
 * Template Single Ekstrakurikuler - Halaman Detail Profil Kegiatan Ekskul.
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
		$thumb_url = sekolahku_get_ekskul_thumb( $post_id );
		?>

		<article <?php post_class( 'single-ekskul-detail' ); ?>>
			<style>
				.ekskul-article-wrapper {
					max-width: 900px;
					margin: 0 auto;
					background: #ffffff;
					border: 1px solid #e2e8f0;
					border-radius: 16px;
					padding: 36px;
					box-shadow: 0 4px 15px rgba(0,0,0,0.04);
				}
				.ekskul-header-section {
					margin-bottom: 24px;
				}
				.ekskul-header-section h1 {
					font-size: 2.25rem;
					font-weight: 800;
					color: #0f172a;
					margin-bottom: 12px;
					line-height: 1.3;
				}
				.ekskul-hero-img {
					width: 100%;
					max-height: 480px;
					object-fit: cover;
					border-radius: 12px;
					margin-bottom: 32px;
					box-shadow: 0 8px 20px rgba(0,0,0,0.08);
				}
				.ekskul-content-body {
					font-size: 1.1rem;
					line-height: 1.95;
					color: #334155;
				}
				.ekskul-content-body p {
					margin-bottom: 20px;
				}
				.ekskul-content-body ul, .ekskul-content-body ol {
					margin-bottom: 24px;
					padding-left: 24px;
				}
				.ekskul-content-body li {
					margin-bottom: 8px;
					line-height: 1.7;
				}
				.ekskul-back-btn {
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
				.ekskul-back-btn:hover {
					background: #0284c7;
					color: #ffffff;
				}
			</style>

			<div class="ekskul-article-wrapper">
				<div class="ekskul-header-section">
					<h1><?php the_title(); ?></h1>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="ekskul-hero-img">
				<?php endif; ?>

				<div class="ekskul-content-body">
					<?php if ( get_the_content() ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
				</div>

				<a href="<?php echo esc_url( home_url( '/#ekskul' ) ); ?>" class="ekskul-back-btn">
					&laquo; Kembali ke Beranda
				</a>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php get_footer(); ?>

<?php
/**
 * Template Archive untuk Galeri (Foto & Video) - 3 Kolom Gambar.
 * Location: template-parts/archive/archive-galeri.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container galeri-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Galeri</h1>

	<div class="galeri-archive-content">
		<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args  = array(
			'post_type'      => 'galeri',
			'posts_per_page' => 12,
			'paged'          => $paged,
			'post_status'    => 'publish',
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>
			<div class="galeri-grid-container">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					$post_id   = get_the_ID();
					$thumb_url = sekolahku_get_galeri_thumb( $post_id );
					
					// Hitung jumlah media (Default 1 jika tidak ada count)
					$count = 0;
					if ( has_post_thumbnail( $post_id ) ) {
						$count++;
					}
					$post_obj = get_post( $post_id );
					if ( $post_obj && ! empty( $post_obj->post_content ) ) {
						preg_match_all( '/<img[^>]+>/i', $post_obj->post_content, $img_matches );
						if ( ! empty( $img_matches[0] ) ) {
							$count += count( $img_matches[0] );
						}
					}
					$count_disp = ( $count > 0 ) ? $count : 1;
					?>
					<article class="galeri-card-item">
						<a href="<?php the_permalink(); ?>" class="galeri-card-link">
							<div class="galeri-card-thumb">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="galeri-img">
								<span class="galeri-badge-count">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
									<?php echo esc_html( $count_disp ); ?>
								</span>
							</div>
							<div class="galeri-card-body">
								<h3 class="galeri-card-title"><?php the_title(); ?></h3>
							</div>
						</a>
					</article>
				<?php
				endwhile;
				?>
			</div>

			<?php if ( $query->max_num_pages > 1 ) : ?>
				<div class="pagination" style="margin-top: 50px; text-align: center;">
					<?php
					echo paginate_links( array(
						'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $query->max_num_pages,
						'prev_text' => '&larr; Sebelumnya',
						'next_text' => 'Berikutnya &rarr;',
					) );
					?>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 14px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px; margin: 0;">Belum ada dokumentasi foto atau video yang dipublikasikan.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* JUDUL UTAMA HALAMAN */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 28px;
	line-height: 1.25;
}

/* GRID 3 KOLOM GALERI */
.galeri-grid-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 24px;
	width: 100%;
}

/* CARD ITEM GALERI PRESI */
.galeri-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
	transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
	display: flex;
	flex-direction: column;
}
.galeri-card-item:hover {
	transform: translateY(-3px);
	box-shadow: 0 10px 26px rgba(15, 23, 42, 0.09);
	border-color: #cbd5e1;
}

.galeri-card-link {
	display: flex;
	flex-direction: column;
	text-decoration: none;
	height: 100%;
}

/* THUMBNAIL CONTAINER & BADGE POJOK KIRI BAWAH */
.galeri-card-thumb {
	position: relative;
	width: 100%;
	aspect-ratio: 16 / 10;
	background: #f1f5f9;
	overflow: hidden;
}
.galeri-card-thumb img.galeri-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}
.galeri-card-item:hover .galeri-card-thumb img.galeri-img {
	transform: scale(1.05);
}

.galeri-badge-count {
	position: absolute;
	left: 12px;
	bottom: 12px;
	display: inline-flex;
	align-items: center;
	gap: 5px;
	background: rgba(15, 23, 42, 0.65);
	backdrop-filter: blur(4px);
	color: #ffffff;
	font-size: 12px;
	font-weight: 700;
	padding: 4px 10px;
	border-radius: 6px;
	line-height: 1;
}

/* BODY CARD & JUDUL CENTERED */
.galeri-card-body {
	padding: 20px 18px;
	flex: 1;
	display: flex;
	align-items: center;
	justify-content: center;
	background: #ffffff;
	text-align: center;
}
.galeri-card-title {
	font-size: 15.5px;
	font-weight: 700;
	color: #0f172a;
	margin: 0;
	line-height: 1.4;
	transition: color 0.2s ease;
}
.galeri-card-item:hover .galeri-card-title {
	color: var(--color-link-hover, #ff7a00);
}

/* RESPONSIVE */
@media (max-width: 992px) {
	.galeri-grid-container {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media (max-width: 576px) {
	.galeri-grid-container {
		grid-template-columns: 1fr;
	}
}
</style>

<?php get_footer(); ?>

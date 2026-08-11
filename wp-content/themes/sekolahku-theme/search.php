<?php
/**
 * Template Hasil Pencarian (`search.php`).
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container search-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Hasil Pencarian: "<?php echo esc_html( get_search_query() ); ?>"</h1>

	<div class="search-layout-row" style="display: flex; gap: 32px; align-items: flex-start;">
		<main class="search-main-col" style="flex: 1; min-width: 0;">
			<?php if ( have_posts() ) : ?>
				<div class="search-cards-list" style="display: flex; flex-direction: column; gap: 20px;">
					<?php
					while ( have_posts() ) :
						the_post();
						$post_id = get_the_ID();
						$type    = get_post_type();
						$title   = get_the_title();
						$link    = get_permalink();
						$date    = get_the_date( 'Y-m-d H:i:s' );

						// Badge label
						$badge_label = 'Konten';
						switch ( $type ) {
							case 'post':        $badge_label = 'Berita'; break;
							case 'page':        $badge_label = 'Halaman'; break;
							case 'program':     $badge_label = 'Program'; break;
							case 'staf':        $badge_label = 'Staf & Guru'; break;
							case 'fasilitas':   $badge_label = 'Fasilitas'; break;
							case 'ekskul':      $badge_label = 'Ekstrakurikuler'; break;
							case 'galeri':       $badge_label = 'Galeri'; break;
							case 'pengumuman':   $badge_label = 'Pengumuman'; break;
							case 'agenda':       $badge_label = 'Agenda'; break;
						}

						// Thumbnail
						$thumb = '';
						if ( has_post_thumbnail( $post_id ) ) {
							$thumb = get_the_post_thumbnail_url( $post_id, 'medium' );
						} elseif ( $type === 'staf' && function_exists( 'sekolahku_get_staf_avatar' ) ) {
							$thumb = sekolahku_get_staf_avatar( $post_id );
						} elseif ( $type === 'fasilitas' && function_exists( 'sekolahku_get_fasilitas_thumb' ) ) {
							$thumb = sekolahku_get_fasilitas_thumb( $post_id );
						} elseif ( $type === 'ekskul' && function_exists( 'sekolahku_get_ekskul_thumb' ) ) {
							$thumb = sekolahku_get_ekskul_thumb( $post_id );
						}
						?>
						<article class="search-card-item">
							<?php if ( $thumb ) : ?>
								<div class="search-card-img">
									<a href="<?php echo esc_url( $link ); ?>">
										<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>">
									</a>
								</div>
							<?php endif; ?>
							<div class="search-card-body">
								<div class="search-card-header">
									<span class="live-search-badge badge-<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $badge_label ); ?></span>
									<span class="search-card-date"><?php echo esc_html( sekolahku_tanggal_indonesia( $date ) ); ?></span>
								</div>
								<h3 class="search-card-title">
									<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a>
								</h3>
								<div class="search-card-excerpt">
									<?php echo esc_html( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 25 ) ); ?>
								</div>
								<a href="<?php echo esc_url( $link ); ?>" class="search-card-more">Selengkapnya &raquo;</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<div class="pagination" style="margin-top: 50px;">
					<?php the_posts_pagination( array(
						'prev_text' => '&larr; Sebelumnya',
						'next_text' => 'Berikutnya &rarr;',
					) ); ?>
				</div>
			<?php else : ?>
				<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 14px; border: 1px dashed #cbd5e1;">
					<h3 style="color: #64748b; font-size: 18px; margin: 0;">Tidak ada hasil ditemukan untuk kata kunci "<?php echo esc_html( get_search_query() ); ?>".</h3>
				</div>
			<?php endif; ?>
		</main>

		<aside class="search-sidebar-col" style="width: 320px; flex-shrink: 0;">
			<?php get_sidebar(); ?>
		</aside>
	</div>
</div>

<style>
/* CSS Search Page Presisi */
.search-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	display: flex;
	align-items: stretch;
	box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.search-card-item:hover {
	transform: translateY(-2px);
	box-shadow: 0 10px 26px rgba(15, 23, 42, 0.09);
	border-color: #cbd5e1;
}
.search-card-img {
	width: 200px;
	flex-shrink: 0;
	background: #f1f5f9;
	overflow: hidden;
}
.search-card-img a {
	display: block;
	width: 100%;
	height: 100%;
}
.search-card-img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}
.search-card-item:hover .search-card-img img {
	transform: scale(1.05);
}
.search-card-body {
	flex: 1;
	padding: 20px 24px;
	display: flex;
	flex-direction: column;
}
.search-card-header {
	display: flex;
	align-items: center;
	gap: 10px;
	margin-bottom: 8px;
}
.search-card-date {
	font-size: 12.5px;
	color: #64748b;
}
.search-card-title {
	font-size: 18px;
	font-weight: 800;
	line-height: 1.35;
	margin: 0 0 8px 0;
}
.search-card-title a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s ease;
}
.search-card-title a:hover {
	color: var(--color-link-hover, #ff7a00);
}
.search-card-excerpt {
	font-size: 13.5px;
	color: #475569;
	line-height: 1.5;
	margin-bottom: 14px;
}
.search-card-more {
	font-size: 13px;
	font-weight: 700;
	color: #475569;
	text-decoration: none;
	margin-top: auto;
	transition: color 0.2s ease;
}
.search-card-more:hover {
	color: var(--color-link-hover, #ff7a00);
}

@media (max-width: 992px) {
	.search-layout-row {
		flex-direction: column;
	}
	.search-sidebar-col {
		width: 100% !important;
	}
}
@media (max-width: 640px) {
	.search-card-item {
		flex-direction: column;
	}
	.search-card-img {
		width: 100%;
		height: 180px;
	}
}
</style>

<?php get_footer(); ?>

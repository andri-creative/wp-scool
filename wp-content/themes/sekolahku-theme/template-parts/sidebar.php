<?php
/**
 * Template Part: Sidebar Global Reusable Component.
 * Digunakan secara universal di seluruh halaman tema (Single Post, Detail Staf, Detail Fasilitas, Ekskul, dll.).
 * 
 * Penggunaan: get_template_part( 'template-parts/sidebar' );
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- SIDEBAR GLOBAL (KANAN) -->
<aside class="sekolahku-global-sidebar">
	<!-- WIDGET 1: BERITA TERBARU -->
	<div class="sidebar-news-header">
		<h3 class="widget-card-title">Berita Terbaru</h3>
	</div>

	<div class="recent-news-stack">
		<?php
		$news_query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 5,
			'post_status'    => 'publish',
		) );

		if ( $news_query->have_posts() ) :
			$news_index = 0;
			while ( $news_query->have_posts() ) :
				$news_query->the_post();
				$news_index++;
				$cats      = get_the_category();
				$cat_name  = ! empty( $cats ) ? $cats[0]->name : 'Berita';
				$has_thumb = ( $news_index === 1 && has_post_thumbnail() );
				$excerpt   = wp_trim_words( get_the_excerpt(), 14, '...' );
				?>
				<div class="recent-news-card-item <?php echo $has_thumb ? 'has-top-thumb' : ''; ?>">
					<?php if ( $has_thumb ) : ?>
						<div class="news-card-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium', array( 'class' => 'news-thumb-img' ) ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="news-card-body">
						<span class="news-cat-badge"><?php echo esc_html( $cat_name ); ?></span>
						<h4 class="news-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php if ( ! empty( $excerpt ) ) : ?>
							<p class="news-item-excerpt"><?php echo esc_html( $excerpt ); ?></p>
						<?php endif; ?>
						<span class="news-item-date"><?php echo esc_html( sekolahku_format_indo_date( get_the_date( 'Y-m-d H:i:s' ) ) ); ?></span>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<div class="no-news-box">
				<p>Belum ada berita terbaru yang dipublikasikan.</p>
			</div>
			<?php
		endif;
		?>
	</div>

	<!-- WIDGET 2: DYNAMIC SIDEBAR WP ADMIN / WIDGET AREA -->
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="sekolahku-sidebar-widget" style="margin-top: 24px;">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	<?php endif; ?>
</aside>

<style>
/* STYLING MANDIRI (SELF-CONTAINED) SIDEBAR GLOBAL */
.sekolahku-global-sidebar,
.staf-sidebar-column {
	display: flex;
	flex-direction: column;
	gap: 20px;
}
.sidebar-news-header {
	margin-bottom: 16px;
}
.sidebar-news-header .widget-card-title,
.sekolahku-sidebar-widget .widget-title,
.widgettitle {
	font-size: 18px;
	font-weight: 800;
	color: #0f172a;
	margin: 0 0 16px 0;
	position: relative;
	padding-bottom: 10px;
}
.sidebar-news-header .widget-card-title::after,
.sekolahku-sidebar-widget .widget-title::after,
.widgettitle::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 50px;
	height: 3px;
	background: #ff7a00;
	border-radius: 2px;
}
.recent-news-stack {
	display: flex;
	flex-direction: column;
	gap: 16px;
}
.recent-news-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	overflow: hidden;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.recent-news-card-item:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
}
.news-card-thumb {
	width: 100%;
	height: 160px;
	overflow: hidden;
	background: #f1f5f9;
}
.news-thumb-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform 0.3s ease;
}
.recent-news-card-item:hover .news-thumb-img {
	transform: scale(1.05);
}
.news-card-body {
	padding: 16px;
}
.news-cat-badge {
	display: inline-block;
	background: #fff7ed;
	color: #ea580c;
	border: 1px solid #ffedd5;
	font-size: 11px;
	font-weight: 700;
	padding: 3px 8px;
	border-radius: 4px;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-bottom: 6px;
}
.news-item-title {
	font-size: 14.5px;
	font-weight: 700;
	line-height: 1.4;
	margin: 0 0 8px 0;
}
.news-item-title a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s ease;
}
.news-item-title a:hover {
	color: #ff7a00;
}
.news-item-excerpt {
	font-size: 12.5px;
	color: #64748b;
	line-height: 1.45;
	margin: 4px 0 8px 0;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
.news-item-date {
	font-size: 11.5px;
	color: #94a3b8;
	display: block;
}
.no-news-box {
	background: #ffffff;
	border: 1px dashed #cbd5e1;
	border-radius: 10px;
	padding: 16px;
	text-align: center;
	color: #94a3b8;
	font-size: 13px;
}
</style>

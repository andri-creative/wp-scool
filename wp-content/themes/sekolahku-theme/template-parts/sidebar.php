<?php
/**
 * Template Part: Sidebar Global Reusable Component.
 * Digunakan secara universal di seluruh halaman tema (Single Post, Detail Staf, Detail Fasilitas, Ekskul, Galeri, dll.).
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
	<!-- HEADER TITLE "BERITA TERBARU" -->
	<div class="sidebar-news-header">
		<h3 class="widget-card-title">Berita Terbaru</h3>
	</div>

	<!-- STACK KARTU BERITA (1 KARTU PER BERITA) -->
	<div class="recent-news-stack">
		<?php
		$news_query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
		) );

		if ( $news_query->have_posts() ) :
			while ( $news_query->have_posts() ) :
				$news_query->the_post();
				$cats     = get_the_category();
				$cat_name = ! empty( $cats ) ? $cats[0]->name : 'Berita';
				?>
				<article class="recent-news-card-item">
					<div class="news-card-body">
						<span class="news-cat-badge"><?php echo esc_html( $cat_name ); ?></span>
						<h4 class="news-item-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						<span class="news-item-date">
							<?php echo esc_html( sekolahku_tanggal_indonesia( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
						</span>
					</div>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<p style="color: #64748b; font-size: 13.5px; margin: 0;">Belum ada berita terbaru.</p>
		<?php endif; ?>
	</div>
</aside>

<style>
/* STYLING MANDIRI (SELF-CONTAINED) SIDEBAR GLOBAL */
.sekolahku-global-sidebar {
	display: flex;
	flex-direction: column;
	width: 100%;
}
.sidebar-news-header {
	margin-bottom: 16px;
}
.sidebar-news-header .widget-card-title {
	font-size: 18px;
	font-weight: 800;
	color: #0f172a;
	margin: 0;
	position: relative;
	padding-bottom: 10px;
}
.sidebar-news-header .widget-card-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 45px;
	height: 3px;
	background: var(--color-accent, #ff7a00);
	border-radius: 2px;
}

/* STACK KARTU TERPISAH (1 CARD PER BERITA) */
.recent-news-stack {
	display: flex;
	flex-direction: column;
	gap: 14px;
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
.news-card-body {
	padding: 16px;
	display: flex;
	flex-direction: column;
	gap: 6px;
}
.news-cat-badge {
	font-size: 12.5px;
	font-weight: 700;
	color: var(--color-accent, #ff7a00);
	text-transform: capitalize;
}
.news-item-title {
	font-size: 14.5px;
	font-weight: 700;
	line-height: 1.35;
	margin: 0;
}
.news-item-title a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s ease;
}
.news-item-title a:hover {
	color: var(--color-link-hover, #ff7a00);
}
.news-item-date {
	font-size: 12px;
	color: #64748b;
}
</style>

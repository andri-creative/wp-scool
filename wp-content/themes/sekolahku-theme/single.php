<?php
/**
 * Template single post - halaman detail Berita lengkap dengan 11 field data & Author Box.
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container page-content">
	<div class="content-with-sidebar">
		<main class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				$post_id   = get_the_ID();
				$title     = get_the_title();
				$cats      = get_the_category();
				$cat_name  = ! empty( $cats ) ? $cats[0]->name : 'Berita';
				$tags      = get_the_tags();

				// Data Penulis (Custom Metabox dengan fallback ke WP Author)
				$author_name  = get_post_meta( $post_id, '_berita_author_name', true );
				$author_photo = get_post_meta( $post_id, '_berita_author_photo', true );
				$author_bio   = get_post_meta( $post_id, '_berita_author_bio', true );

				if ( empty( $author_name ) ) {
					$author_name = get_the_author();
				}
				if ( empty( $author_photo ) ) {
					$wp_avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 128 ) );
					if ( ! empty( $wp_avatar ) && false === strpos( $wp_avatar, 'gravatar.com/avatar/?s=' ) ) {
						$author_photo = $wp_avatar;
					} else {
						$author_photo = 'https://ui-avatars.com/api/?name=' . rawurlencode( $author_name ) . '&background=ff7a00&color=fff&size=128';
					}
				}
				if ( empty( $author_bio ) ) {
					$author_bio = get_the_author_meta( 'description' );
					if ( empty( $author_bio ) ) {
						$author_bio = 'Penulis resmi dan pengelola konten informasi di portal SekolahKu.';
					}
				}
				?>
				<article <?php post_class( 'single-news' ); ?>>
					<!-- BADGE KATEGORI ORANGE & JUDUL BERITA -->
					<div class="single-news-header">
						<span class="news-cat-badge"><?php echo esc_html( $cat_name ); ?></span>
						<h1 class="single-news-title"><?php echo esc_html( $title ); ?></h1>
						
						<!-- META: TANGGAL (HARI, TGL, BULAN, TH) & PENULIS -->
						<div class="single-news-meta">
							<span class="meta-item meta-date">
								<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								<?php echo esc_html( sekolahku_format_indo_date( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
							</span>
							<span class="meta-divider">•</span>
							<span class="meta-item meta-author">
								<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								Oleh <?php echo esc_html( $author_name ); ?>
							</span>
						</div>
					</div>

					<!-- GAMBAR UTAMA BERITA (FEATURED IMAGE) -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="single-news-thumb">
							<?php the_post_thumbnail( 'large', array( 'class' => 'featured-img' ) ); ?>
						</div>
					<?php endif; ?>

					<!-- DESKRIPSI KONTEN BERITA -->
					<div class="single-news-content">
						<?php the_content(); ?>
					</div>

					<!-- TAGS BERITA -->
					<?php if ( ! empty( $tags ) ) : ?>
						<div class="single-news-tags">
							<span class="tags-label">Tags:</span>
							<?php foreach ( $tags as $t ) : ?>
								<a href="<?php echo esc_url( get_tag_link( $t->term_id ) ); ?>" class="tag-badge">#<?php echo esc_html( $t->name ); ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<!-- CARD AUTHOR (FOTO, NAMA, KETERANGAN PENULIS) -->
					<div class="news-author-card">
						<div class="author-avatar-wrap">
							<img src="<?php echo esc_url( $author_photo ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" class="author-avatar-img">
						</div>
						<div class="author-info-wrap">
							<span class="author-label">Tentang Penulis</span>
							<h4 class="author-name"><?php echo esc_html( $author_name ); ?></h4>
							<p class="author-bio"><?php echo esc_html( $author_bio ); ?></p>
						</div>
					</div>

					<!-- SHARE BUTTONS REUSABLE COMPONENT -->
					<?php get_template_part( 'template-parts/share-buttons' ); ?>

					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">',
						'after'  => '</div>',
					) );
					?>
				</article>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>
				<?php
			endwhile;
			?>
		</main>

		<!-- REUSABLE SIDEBAR -->
		<?php get_template_part( 'template-parts/sidebar-staf' ); ?>
	</div>
</div>

<style>
.single-news-header {
	margin-bottom: 20px;
}
.single-news-header .news-cat-badge {
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
.single-news-title {
	font-size: 26px;
	font-weight: 800;
	color: #0f172a;
	margin: 10px 0 12px 0;
	line-height: 1.3;
}
.single-news-meta {
	display: flex;
	align-items: center;
	gap: 10px;
	font-size: 13px;
	color: #64748b;
}
.meta-item {
	display: flex;
	align-items: center;
	gap: 5px;
}
.single-news-thumb {
	width: 100%;
	border-radius: 12px;
	overflow: hidden;
	margin-bottom: 24px;
	box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.featured-img {
	width: 100%;
	height: auto;
	object-fit: cover;
}
.single-news-content {
	font-size: 15.5px;
	line-height: 1.7;
	color: #334155;
	margin-bottom: 28px;
}
.single-news-tags {
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	gap: 8px;
	margin-bottom: 24px;
	padding-top: 16px;
	border-top: 1px solid #e2e8f0;
}
.tags-label {
	font-weight: 700;
	color: #0f172a;
	font-size: 13px;
}
.tag-badge {
	background: #f1f5f9;
	color: #475569;
	font-size: 12px;
	padding: 4px 10px;
	border-radius: 6px;
	text-decoration: none;
	transition: all 0.2s ease;
}
.tag-badge:hover {
	background: #ff7a00;
	color: #ffffff;
}

/* AUTHOR CARD BOX */
.news-author-card {
	display: flex;
	gap: 16px;
	align-items: flex-start;
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	padding: 20px;
	margin-bottom: 28px;
}
.author-avatar-wrap {
	width: 64px;
	height: 64px;
	border-radius: 50%;
	overflow: hidden;
	flex-shrink: 0;
	background: #e2e8f0;
}
.author-avatar-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}
.author-info-wrap {
	flex: 1;
}
.author-label {
	font-size: 11px;
	font-weight: 700;
	text-transform: uppercase;
	color: #ff7a00;
	letter-spacing: 0.5px;
}
.author-name {
	font-size: 16px;
	font-weight: 800;
	color: #0f172a;
	margin: 2px 0 6px 0;
}
.author-bio {
	font-size: 13px;
	color: #64748b;
	line-height: 1.5;
	margin: 0;
}
</style>

<?php get_footer(); ?>

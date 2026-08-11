<?php
/**
 * Template Archive untuk Berita Sekolah (`archive-berita.php`).
 * Location: template-parts/archive/archive-berita.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container berita-archive-container" style="margin-bottom: 80px;">
	<!-- HEADER CONTROLS (JUDUL "BERITA", FILTER KATEGORI, SEARCH) -->
	<div class="berita-header-bar">
		<h1 class="staf-page-title" style="margin: 0;">
			<?php
			if ( is_category() ) {
				single_cat_title( 'Berita: ' );
			} elseif ( is_tag() ) {
				single_tag_title( 'Berita Tag: ' );
			} else {
				echo 'Berita';
			}
			?>
		</h1>

		<form method="GET" action="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="berita-filter-form">
			<?php
			$categories   = get_categories( array( 'hide_empty' => false ) );
			$selected_cat = is_category() ? get_queried_object()->slug : ( isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : '' );
			$search_query = isset( $_GET['s_berita'] ) ? sanitize_text_field( $_GET['s_berita'] ) : '';
			?>
			<select name="category" class="berita-select-cat" onchange="this.form.submit()">
				<option value="">Semua Kategori</option>
				<?php foreach ( $categories as $cat ) : ?>
					<option value="<?php echo esc_attr( $cat->slug ); ?>" <?php selected( $selected_cat, $cat->slug ); ?>>
						<?php echo esc_html( $cat->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>

			<div class="berita-search-wrapper">
				<input type="text" name="s_berita" value="<?php echo esc_attr( $search_query ); ?>" placeholder="Cari berita...">
				<button type="submit" class="btn-search-berita">
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					<span>Mencari</span>
				</button>
			</div>
		</form>
	</div>

	<div class="berita-archive-content">
		<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => 10,
			'paged'          => $paged,
			'post_status'    => 'publish',
		);

		if ( is_category() ) {
			$args['cat'] = get_queried_object_id();
		} elseif ( ! empty( $selected_cat ) ) {
			$args['category_name'] = $selected_cat;
		}

		if ( ! empty( $search_query ) ) {
			$args['s'] = $search_query;
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>
			<div class="berita-grid-container" id="berita-grid">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					$post_id   = get_the_ID();
					$cats      = get_the_category();
					$cat_name  = ! empty( $cats ) ? $cats[0]->name : 'Berita';
					$thumb_url = sekolahku_get_berita_thumb( $post_id );
					?>
					<article class="berita-card-item">
						<div class="berita-card-img">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
							</a>
						</div>
						<div class="berita-card-body">
							<div class="berita-card-cat"><?php echo esc_html( $cat_name ); ?></div>
							<h3 class="berita-card-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="berita-card-date">
								<?php echo esc_html( sekolahku_tanggal_indonesia( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
							</div>
							<div class="berita-card-excerpt">
								<?php echo esc_html( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 15 ) ); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="berita-card-more">Selengkapnya &raquo;</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php if ( $query->max_num_pages > 1 ) : ?>
				<div class="load-more-container" style="text-align: center; margin-top: 40px;">
					<button id="load-more-berita" class="btn-load-more" data-page="1" data-max="<?php echo esc_attr( $query->max_num_pages ); ?>" data-cat="<?php echo esc_attr( $selected_cat ); ?>" data-search="<?php echo esc_attr( $search_query ); ?>" aria-label="Muat Berita Lainnya">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
					</button>
				</div>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 14px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px; margin: 0;">Belum ada berita yang ditemukan.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* HEADER CONTROL BAR (TITLES & FILTERS) */
.berita-header-bar {
	display: flex;
	justify-content: space-between;
	align-items: center;
	flex-wrap: wrap;
	gap: 16px;
	margin-bottom: 28px;
}
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	line-height: 1.25;
}
.berita-filter-form {
	display: flex;
	align-items: center;
	gap: 10px;
	flex-wrap: wrap;
}
.berita-select-cat {
	height: 42px;
	padding: 0 16px;
	border-radius: 8px;
	border: 1px solid #cbd5e1;
	background: #ffffff;
	font-size: 14px;
	font-weight: 500;
	color: #334155;
	outline: none;
	cursor: pointer;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
	transition: all 0.2s ease;
}
.berita-select-cat:focus,
.berita-select-cat:hover {
	border-color: var(--color-primary, #0284c7);
}
.berita-search-wrapper {
	height: 42px;
	display: flex;
	align-items: center;
	background: #ffffff;
	border: 1px solid #cbd5e1;
	border-radius: 8px;
	overflow: hidden;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
	transition: all 0.2s ease;
}
.berita-search-wrapper:focus-within {
	border-color: var(--color-primary, #0284c7);
}
.berita-search-wrapper input {
	height: 100%;
	padding: 0 14px;
	border: none;
	font-size: 14px;
	color: #0f172a;
	outline: none;
	width: 160px;
	background: transparent;
}
.btn-search-berita {
	height: 100%;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 0 18px;
	background: var(--color-primary, #0284c7);
	color: #ffffff;
	border: none;
	font-size: 14px;
	font-weight: 600;
	cursor: pointer;
	transition: background 0.2s ease;
}
.btn-search-berita:hover {
	background: var(--color-primary-dark, #0369a1);
}

/* GRID LAYOUT (2 CARDS) */
.berita-grid-container {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 24px;
	width: 100%;
}

/* HORIZONTAL CARD ITEM PRESI */
.berita-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	overflow: hidden;
	display: flex;
	align-items: stretch;
	box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.berita-card-item:hover {
	transform: translateY(-3px);
	box-shadow: 0 10px 26px rgba(15, 23, 42, 0.09);
}
.berita-card-img {
	flex: 0 0 38%;
	width: 38%;
	position: relative;
	background: #f1f5f9;
	overflow: hidden;
}
.berita-card-img a {
	display: block;
	width: 100%;
	height: 100%;
}
.berita-card-img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}
.berita-card-item:hover .berita-card-img img {
	transform: scale(1.05);
}
.berita-card-body {
	flex: 1;
	padding: 18px 20px;
	display: flex;
	flex-direction: column;
	justify-content: center;
}
.berita-card-cat {
	font-size: 13px;
	font-weight: 700;
	color: var(--color-accent, #ff7a00);
	margin-bottom: 6px;
	text-transform: capitalize;
}
.berita-card-title {
	font-size: 16px;
	font-weight: 800;
	line-height: 1.35;
	margin: 0 0 6px 0;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
.berita-card-title a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s ease;
}
.berita-card-title a:hover {
	color: var(--color-link-hover, #ff7a00);
}
.berita-card-date {
	font-size: 12.5px;
	color: #64748b;
	margin-bottom: 8px;
}
.berita-card-excerpt {
	font-size: 13px;
	color: #475569;
	line-height: 1.5;
	margin-bottom: 12px;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
.berita-card-more {
	font-size: 13px;
	font-weight: 700;
	color: #475569;
	text-decoration: none;
	margin-top: auto;
	transition: color 0.2s ease;
}
.berita-card-more:hover {
	color: var(--color-link-hover, #ff7a00);
}

/* LOAD MORE BUTTON */
.btn-load-more {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 48px;
	height: 48px;
	background: #f1f5f9;
	color: #475569;
	border: 1px solid #cbd5e1;
	border-radius: 50%;
	cursor: pointer;
	transition: all 0.2s ease;
	box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.btn-load-more:hover {
	background: var(--color-primary, #0284c7);
	color: #ffffff;
	border-color: var(--color-primary, #0284c7);
}
.btn-load-more.loading {
	animation: spin 1s linear infinite;
	pointer-events: none;
}
@keyframes spin {
	100% { transform: rotate(360deg); }
}

/* RESPONSIVE */
@media (max-width: 992px) {
	.berita-grid-container {
		grid-template-columns: 1fr;
	}
}
@media (max-width: 640px) {
	.berita-card-item {
		flex-direction: column;
	}
	.berita-card-img {
		width: 100%;
		aspect-ratio: 16 / 9;
	}
	.berita-header-bar {
		flex-direction: column;
		align-items: flex-start;
	}
}
</style>

<!-- SCRIPT AJAX LOAD MORE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	var loadMoreBtn = document.getElementById('load-more-berita');
	if (loadMoreBtn) {
		loadMoreBtn.addEventListener('click', function() {
			var button  = this;
			var page    = parseInt(button.getAttribute('data-page'));
			var maxPage = parseInt(button.getAttribute('data-max'));
			var category= button.getAttribute('data-cat') || '';
			var search  = button.getAttribute('data-search') || '';
			var grid    = document.getElementById('berita-grid');
			
			if (page >= maxPage) return;
			
			button.classList.add('loading');
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '<?php echo admin_url( 'admin-ajax.php' ); ?>', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			
			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					var response = xhr.responseText;
					grid.insertAdjacentHTML('beforeend', response);
					
					page++;
					button.setAttribute('data-page', page);
					
					if (page >= maxPage) {
						button.style.display = 'none';
					}
				}
				button.classList.remove('loading');
			};
			
			xhr.send('action=load_more_berita&paged=' + (page + 1) + '&category=' + encodeURIComponent(category) + '&search=' + encodeURIComponent(search));
		});
	}
});
</script>

<?php get_footer(); ?>

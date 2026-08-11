<?php
/**
 * Template Archive untuk Pengumuman
 * Location: template-parts/archive/archive-pengumuman.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part('template-parts/breadcrumb');
?>

<div class="container pengumuman-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Pengumuman</h1>
	
	<div class="pengumuman-archive-content">
		<?php
		// Initial query: 12 posts
		$args = array(
			'post_type'      => 'pengumuman',
			'posts_per_page' => 12,
			'post_status'    => 'publish'
		);
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) : ?>
			<div class="pengumuman-grid-container" id="pengumuman-grid">
				<?php
				while ( $query->have_posts() ) : $query->the_post();
					?>
					<article class="pengumuman-card-item">
						<a href="<?php the_permalink(); ?>" class="pengumuman-card-link">
							<h3 class="pengumuman-card-title"><?php the_title(); ?></h3>
							<div class="pengumuman-card-meta">
								<?php echo esc_html( sekolahku_tanggal_indonesia( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
							</div>
						</a>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<?php 
			// Check if there are more pages
			if ( $query->max_num_pages > 1 ) : ?>
				<div class="load-more-container" style="text-align: center; margin-top: 40px;">
					<button id="load-more-pengumuman" class="btn-load-more" data-page="1" data-max="<?php echo esc_attr( $query->max_num_pages ); ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19" 12 12 19 5 12"></polyline></svg>
					</button>
				</div>
			<?php endif; ?>
			
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px;">Belum ada pengumuman.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* CSS Pengumuman */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}

/* Grid 3 Kolom */
.pengumuman-grid-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 20px;
	width: 100%;
}

/* Kotak Pengumuman */
.pengumuman-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	transition: all 0.2s ease;
}
.pengumuman-card-item:hover {
	box-shadow: 0 10px 25px rgba(0,0,0,0.05);
	transform: translateY(-2px);
}
.pengumuman-card-link {
	display: block;
	padding: 24px;
	text-decoration: none;
	height: 100%;
}
.pengumuman-card-title {
	font-size: 16px;
	font-weight: 700;
	color: #1e293b;
	margin: 0 0 12px 0;
	line-height: 1.5;
}
.pengumuman-card-link:hover .pengumuman-card-title {
	color: #3858e9;
}
.pengumuman-card-meta {
	font-size: 13px;
	color: #64748b;
}

/* Load More Button */
.btn-load-more {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 50px;
	height: 50px;
	background: #f1f5f9;
	color: #475569;
	border: none;
	border-radius: 50%;
	cursor: pointer;
	transition: all 0.2s ease;
}
.btn-load-more:hover {
	background: #e2e8f0;
	color: #0f172a;
}
.btn-load-more.loading {
	animation: spin 1s linear infinite;
	pointer-events: none;
}
@keyframes spin {
	100% { transform: rotate(360deg); }
}

/* Responsivitas */
@media (max-width: 992px) {
	.pengumuman-grid-container {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media (max-width: 576px) {
	.pengumuman-grid-container {
		grid-template-columns: 1fr;
	}
}
</style>

<!-- Script AJAX Load More -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	var loadMoreBtn = document.getElementById('load-more-pengumuman');
	if (loadMoreBtn) {
		loadMoreBtn.addEventListener('click', function() {
			var button = this;
			var page = parseInt(button.getAttribute('data-page'));
			var maxPage = parseInt(button.getAttribute('data-max'));
			var grid = document.getElementById('pengumuman-grid');
			
			if (page >= maxPage) return;
			
			// Tambahkan animasi loading (putar icon)
			button.classList.add('loading');
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			
			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					// Berhasil ambil data
					var response = xhr.responseText;
					grid.insertAdjacentHTML('beforeend', response);
					
					page++;
					button.setAttribute('data-page', page);
					
					// Jika sudah halaman terakhir, sembunyikan tombol
					if (page >= maxPage) {
						button.style.display = 'none';
					}
				}
				// Hapus animasi loading
				button.classList.remove('loading');
			};
			
			xhr.send('action=load_more_pengumuman&paged=' + (page + 1));
		});
	}
});
</script>

<?php get_footer(); ?>

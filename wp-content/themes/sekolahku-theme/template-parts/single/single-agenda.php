<?php
/**
 * Template single post - halaman detail khusus untuk Agenda.
 * Location: template-parts/single/single-agenda.php
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
				
				$tanggal = get_post_meta( $post_id, '_agenda_tanggal', true );
				$waktu   = get_post_meta( $post_id, '_agenda_waktu', true );
				$lokasi  = get_post_meta( $post_id, '_agenda_lokasi', true );
				$tgl_disp = $tanggal ? $tanggal : sekolahku_tanggal_indonesia( get_the_date() );
				$is_passed = sekolahku_is_agenda_passed( $tgl_disp );
				?>
				<article <?php post_class( 'single-agenda' ); ?>>
					
					<!-- JUDUL AGENDA -->
					<div class="single-news-header" style="margin-bottom: 24px;">
						<h1 class="single-news-title" style="margin-top:0; font-size: 32px;"><?php echo esc_html( $title ); ?></h1>
					</div>

					<!-- INFO BOX AGENDA -->
					<div class="agenda-info-box">
						<ul class="agenda-info-list">
							<li>
								<span class="info-icon">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								</span>
								<strong>Jadwal:</strong> <?php echo esc_html( $tgl_disp ); ?>
							</li>
							<?php if ( $is_passed ) : ?>
							<li>
								<span class="info-icon" style="color: #ef4444;">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 16 14"></polyline></svg>
								</span>
								<strong style="color: #ef4444;">Status:</strong> <span style="color: #ef4444; font-weight: 600;">Agenda terlewat</span>
							</li>
							<?php elseif ( $waktu ) : ?>
							<li>
								<span class="info-icon">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 16 14"></polyline></svg>
								</span>
								<strong>Waktu:</strong> <?php echo esc_html( $waktu ); ?>
							</li>
							<?php endif; ?>
							<?php if ( $lokasi ) : ?>
							<li>
								<span class="info-icon">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
								</span>
								<strong>Lokasi:</strong> <?php echo esc_html( $lokasi ); ?>
							</li>
							<?php endif; ?>
						</ul>
					</div>

					<!-- GAMBAR UTAMA BERITA (FEATURED IMAGE) -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="single-news-thumb" style="margin-top: 24px;">
							<?php the_post_thumbnail( 'large', array( 'class' => 'featured-img' ) ); ?>
						</div>
					<?php endif; ?>

					<!-- DESKRIPSI KONTEN BERITA -->
					<div class="single-news-content sekolahku-editor-content" style="margin-top: 24px;">
						<?php the_content(); ?>
					</div>

					<!-- SHARE BUTTONS REUSABLE COMPONENT -->
					<div style="margin-top: 40px;">
						<?php get_template_part( 'template-parts/share-buttons' ); ?>
					</div>

				</article>

				<?php
			endwhile;
			?>
			
			<!-- AGENDA LAINNYA -->
			<div class="related-agendas-section">
				<h3 class="related-agendas-title">Agenda Lainnya</h3>
				<div class="agenda-grid-container-related">
					<?php
					$all_agendas = sekolahku_get_sorted_agendas( 4 );
					$count = 0;
					if ( ! empty( $all_agendas ) ) :
						global $post;
						$current_id = get_the_ID();
						foreach ( $all_agendas as $post ) :
							if ( $post->ID == $current_id ) continue;
							if ( $count >= 2 ) break;
							
							setup_postdata( $post );
							$tanggal = get_post_meta( get_the_ID(), '_agenda_tanggal', true );
							$waktu   = get_post_meta( get_the_ID(), '_agenda_waktu', true );
							$lokasi  = get_post_meta( get_the_ID(), '_agenda_lokasi', true );
							$tgl_disp = $tanggal ? $tanggal : sekolahku_tanggal_indonesia( get_the_date() );
							$is_passed = sekolahku_is_agenda_passed( $tgl_disp );
							$passed_class = $is_passed ? ' agenda-passed' : '';
							?>
							<article class="agenda-card-item<?php echo $passed_class; ?>">
								<div class="agenda-date-badge">
									<?php echo sekolahku_tanggal_spans( $tgl_disp ); ?>
								</div>
								<div class="agenda-card-content">
									<h3 class="agenda-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="agenda-card-meta">
										<?php if ( $is_passed ) : ?>
											<span class="meta-pill meta-time">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 16 14"></polyline></svg>
												Agenda terlewat
											</span>
										<?php elseif ( $waktu ) : ?>
											<span class="meta-pill meta-time">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 16 14"></polyline></svg>
												<?php echo esc_html( $waktu ); ?>
											</span>
										<?php endif; ?>
										<?php if ( $lokasi ) : ?>
											<span class="meta-pill meta-location">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
												<?php echo esc_html( $lokasi ); ?>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</article>
							<?php
							$count++;
						endforeach; wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</main>

		<!-- REUSABLE SIDEBAR -->
		<?php get_template_part( 'template-parts/sidebar-staf' ); ?>
	</div>
</div>

<style>
/* Info Box Agenda */
.agenda-info-box {
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	border-radius: 12px;
	padding: 24px;
	margin-top: 10px;
}
.agenda-info-list {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
	flex-direction: column;
	gap: 12px;
}
.agenda-info-list li {
	display: flex;
	align-items: center;
	font-size: 15px;
	color: #334155;
	line-height: 1.5;
}
.info-icon {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	color: #64748b;
	margin-right: 12px;
}
.agenda-info-list strong {
	color: #0f172a;
	margin-right: 6px;
}

/* Related Agendas Section */
.related-agendas-section {
	margin-top: 60px;
	padding-top: 30px;
	border-top: 2px solid #f1f5f9;
}
.related-agendas-title {
	font-size: 22px;
	font-weight: 800;
	color: #3858e9;
	margin-bottom: 24px;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.agenda-grid-container-related {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 16px;
	width: 100%;
}
@media (max-width: 768px) {
	.agenda-grid-container-related {
		grid-template-columns: 1fr;
	}
}

/* Base styles for news re-used in single-agenda */
.single-news-title {
	font-size: 26px;
	font-weight: 800;
	color: #0f172a;
	line-height: 1.3;
}
.single-news-thumb {
	width: 100%;
	border-radius: 12px;
	overflow: hidden;
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
}
</style>

<?php get_footer(); ?>

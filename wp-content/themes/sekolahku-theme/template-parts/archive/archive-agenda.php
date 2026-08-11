<?php
/**
 * Template Archive untuk Agenda
 * Location: template-parts/archive/archive-agenda.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part('template-parts/breadcrumb');
?>

<div class="container agenda-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Agenda</h1>
	
	<div class="agenda-archive-content">
		<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$posts_per_page = get_option( 'posts_per_page' );
		$all_agendas = sekolahku_get_sorted_agendas( -1 );
		
		$total_agendas = count( $all_agendas );
		$total_pages = ceil( $total_agendas / $posts_per_page );
		
		$offset = ( $paged - 1 ) * $posts_per_page;
		$current_agendas = array_slice( $all_agendas, $offset, $posts_per_page );
		
		if ( ! empty( $current_agendas ) ) : 
		?>
			<div class="agenda-grid-container">
				<?php
				global $post;
				foreach ( $current_agendas as $post ) :
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
				endforeach; wp_reset_postdata();
				?>
			</div>

			<div class="pagination" style="margin-top: 50px;">
				<?php
				echo paginate_links( array(
					'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'  => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total'   => $total_pages,
					'prev_text' => '&larr; Sebelumnya',
					'next_text' => 'Berikutnya &rarr;',
				) );
				?>
			</div>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px;">Belum ada agenda.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* Menggunakan style judul yang presisi dengan halaman Staf */
.staf-page-title {
	font-size: 28px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 24px;
	line-height: 1.25;
}
@media (max-width: 768px) {
	.staf-page-title {
		font-size: 24px;
		margin-bottom: 20px;
	}
}

/* Grid 3 Kolom untuk Card Agenda */
.agenda-grid-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 16px;
	width: 100%;
}

/* Responsivitas Grid: HP (Mobile) jadi 2 Kolom */
@media (max-width: 768px) {
	.agenda-grid-container {
		grid-template-columns: repeat(2, 1fr);
		gap: 12px; /* Jarak lebih dirapatkan lagi di HP */
	}
}
@media (max-width: 480px) {
	.agenda-grid-container {
		grid-template-columns: 1fr; /* Khusus layar sangat kecil, 1 kolom agar tidak terlalu berdesakan */
	}
}
</style>

<?php get_footer(); ?>

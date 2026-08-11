<?php
/**
 * Template Archive untuk Ekstrakurikuler (Presisi 100% Sesuai Referensi Zekolla).
 * Location: template-parts/archive/archive-ekskul.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container ekskul-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title">Ekstrakurikuler</h1>

	<div class="ekskul-archive-content">
		<?php if ( have_posts() ) : ?>
			<div class="ekskul-grid-container">
				<?php
				while ( have_posts() ) :
					the_post();
					$post_id   = get_the_ID();
					$thumb_url = sekolahku_get_ekskul_thumb( $post_id );

					$raw_content        = get_the_content();
					$clean_content_text = wp_strip_all_tags( str_replace( array( '</li>', '</p>', '<br>', '<br/>' ), "\n", $raw_content ) );

					// 1. Extract Jumlah Anggota
					$anggota = get_post_meta( $post_id, '_ekskul_anggota', true );
					if ( ! $anggota && preg_match( '/Jumlah\s*Anggota\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
						$anggota = trim( $m[1] );
					}

					// 2. Extract Pembina / Pengajar / Pelatih / Coach
					$pembina       = get_post_meta( $post_id, '_ekskul_pembina', true );
					$pembina_label = 'Pembina';

					if ( preg_match( '/(Pengajar|Pembina|Pelatih|Coach)\s*[:\-]?\s*([^\n\r]+)/i', $clean_content_text, $m ) ) {
						$pembina_label = ucfirst( strtolower( trim( $m[1] ) ) );
						if ( ! $pembina ) {
							$pembina = trim( $m[2] );
						}
					}
					?>
					<div class="card ekskul-archive-card">
						<div class="ekskul-card-inner">
							<div class="ekskul-thumb-col">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="ekskul-card-img">
							</div>
							<div class="ekskul-info-col">
								<h3><?php the_title(); ?></h3>

								<div class="ekskul-meta-list">
									<div class="ekskul-meta-item">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
										<span>Jumlah Anggota: <strong><?php echo esc_html( $anggota ? $anggota : '-' ); ?></strong></span>
									</div>
									<div class="ekskul-meta-item">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
										<span><?php echo esc_html( $pembina_label ); ?>: <strong><?php echo esc_html( $pembina ? $pembina : '-' ); ?></strong></span>
									</div>
								</div>

								<a href="<?php the_permalink(); ?>" class="facility-link">Selengkapnya &raquo;</a>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>

			<div class="pagination" style="margin-top: 50px;">
				<?php the_posts_pagination( array(
					'prev_text' => '&larr; Sebelumnya',
					'next_text' => 'Berikutnya &rarr;',
				) ); ?>
			</div>
		<?php else : ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px;">Belum ada data ekstrakurikuler yang dipublikasikan.</h3>
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
	margin-bottom: 24px;
	line-height: 1.25;
}

/* GRID 2 KOLOM (SEPERTI DI ZEKOLLA) */
.ekskul-grid-container {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 24px;
	width: 100%;
}

/* CARD EKSKUL HORIZONAL (FOTO KIRI, DETAIL KANAN) */
.ekskul-archive-card {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
	transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.ekskul-archive-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
	border-color: #cbd5e1;
}

.ekskul-card-inner {
	display: flex;
	align-items: center;
	height: 100%;
}

.ekskul-thumb-col {
	width: 45%;
	min-height: 215px;
	align-self: stretch;
	flex-shrink: 0;
	background: #f1f5f9;
	overflow: hidden;
}

.ekskul-card-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}

.ekskul-archive-card:hover .ekskul-card-img {
	transform: scale(1.06);
}

.ekskul-info-col {
	padding: 24px 28px;
	flex: 1;
	display: flex;
	flex-direction: column;
	justify-content: center;
}

.ekskul-info-col h3 {
	font-size: 20.5px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 14px;
	line-height: 1.3;
}

.ekskul-meta-list {
	display: flex;
	flex-direction: column;
	gap: 9px;
	font-size: 14px;
	color: #64748b;
	margin-bottom: 18px;
}

.ekskul-meta-item {
	display: flex;
	align-items: center;
	gap: 8px;
}

.ekskul-meta-item svg {
	color: #64748b;
	flex-shrink: 0;
}

.ekskul-meta-item strong {
	color: #1e293b;
	font-weight: 700;
}

/* RESPONSIVITAS MOBILE & TABLET */
@media (max-width: 992px) {
	.ekskul-grid-container {
		grid-template-columns: 1fr;
	}
}

@media (max-width: 576px) {
	.ekskul-card-inner {
		flex-direction: column;
		align-items: stretch;
	}
	.ekskul-thumb-col {
		width: 100%;
		height: 200px;
	}
}
</style>

<?php get_footer(); ?>

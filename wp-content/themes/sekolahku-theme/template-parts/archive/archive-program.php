<?php
/**
 * Template Name: Archive Program Keahlian
 * Description: Halaman daftar Program Keahlian sekolah dengan grid 3 kolom dan Smart Fallback data.
 * Location: template-parts/archive/archive-program.php
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container program-archive-container" style="margin-bottom: 80px;">
	<div class="program-archive-content">
		<h1 class="page-title" style="font-size: 32px; font-weight: 800; margin-bottom: 32px;">
			Program
		</h1>

		<div class="program-grid-container">
			<?php
			$program_query = new WP_Query( array(
				'post_type'      => 'program',
				'posts_per_page' => 12,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );

			if ( $program_query->have_posts() ) :
				while ( $program_query->have_posts() ) :
					$program_query->the_post();
					$p_id    = get_the_ID();
					$p_title = get_the_title();
					$p_link  = get_permalink();
					$p_thumb = has_post_thumbnail( $p_id ) ? get_the_post_thumbnail_url( $p_id, 'large' ) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80';
					?>
					<article class="program-card-item">
						<a href="<?php echo esc_url( $p_link ); ?>" class="program-card-link">
							<div class="program-card-thumb">
								<img src="<?php echo esc_url( $p_thumb ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="program-img">
							</div>
							<div class="program-card-body">
								<h3 class="program-card-title"><?php echo esc_html( $p_title ); ?></h3>
							</div>
						</a>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #64748b;">
					<p style="font-size: 16px; margin: 0;">Belum ada data program yang ditambahkan. Silakan tambahkan lewat menu "Program Sekolah" di dashboard admin.</p>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</div>

<style>
/* GRID PROGRAM KEAHLIAN 3 KOLOM PRESISI ZEKOLLA */
.program-grid-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 28px;
}

.program-card-item {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
	transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.program-card-item:hover {
	transform: translateY(-4px);
	box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
}

.program-card-link {
	display: flex;
	flex-direction: column;
	text-decoration: none;
	height: 100%;
}

.program-card-thumb {
	width: 100%;
	aspect-ratio: 16 / 10;
	overflow: hidden;
	background: #f1f5f9;
}

.program-card-thumb img.program-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}

.program-card-item:hover .program-card-thumb img.program-img {
	transform: scale(1.05);
}

.program-card-body {
	padding: 20px 18px;
	text-align: center;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-grow: 1;
}

.program-card-title {
	font-size: 16px;
	font-weight: 700;
	color: #0f172a;
	margin: 0;
	line-height: 1.4;
	transition: color 0.2s ease;
}

.program-card-item:hover .program-card-title {
	color: var(--color-accent, #ff7a00);
}

/* RESPONSIVE LAYOUT */
@media (max-width: 992px) {
	.program-grid-container {
		grid-template-columns: repeat(2, 1fr);
	}
}

@media (max-width: 640px) {
	.program-grid-container {
		grid-template-columns: 1fr;
	}
}
</style>

<?php
get_footer();

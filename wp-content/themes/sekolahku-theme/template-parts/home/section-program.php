<?php
/**
 * Section Program Sekolah (Homepage).
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- SECTION PROGRAM SEKOLAH -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Program Unggulan</span>
			<h2>Program Sekolah</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$program_query = new WP_Query( array(
				'post_type'      => 'program',
				'posts_per_page' => 6,
				'post_status'    => 'publish',
			) );

			if ( $program_query->have_posts() ) :
				while ( $program_query->have_posts() ) :
					$program_query->the_post();
					?>
					<a href="<?php the_permalink(); ?>" class="card program-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'medium' ); ?>
						<?php else : ?>
							<div class="news-thumb-placeholder"></div>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p style="grid-column: 1 / -1; text-align: center; color: #64748b;">Belum ada data program. Tambahkan lewat menu "Program Sekolah" di dashboard admin.</p>';
			endif;
			?>
		</div>
	</div>
</section>

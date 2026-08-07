<?php
/**
 * Section Program Keahlian.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- PROGRAM KEAHLIAN -->
<section class="section">
	<div class="container">
		<div class="section-title">
			<span class="eyebrow">Pilihan Jurusan</span>
			<h2>Program Keahlian</h2>
		</div>

		<div class="grid grid-3">
			<?php
			$program_query = new WP_Query( array( 'post_type' => 'program', 'posts_per_page' => 6 ) );
			if ( $program_query->have_posts() ) :
				while ( $program_query->have_posts() ) : $program_query->the_post();
					?>
					<a href="<?php the_permalink(); ?>" class="card program-card">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?>
							<div class="news-thumb-placeholder"></div>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
					</a>
					<?php
				endwhile; wp_reset_postdata();
			else :
				echo '<p>Belum ada data program. Tambahkan lewat menu "Program Keahlian" di dashboard.</p>';
			endif;
			?>
		</div>
	</div>
</section>

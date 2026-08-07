<?php
/**
 * Section Info: Pengumuman, Agenda, Berita.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- INFO: PENGUMUMAN | AGENDA | BERITA -->
<section class="section section-alt">
	<div class="container">
		<div class="info-grid">
			<!-- Kolom Pengumuman -->
			<div class="info-col">
				<h2 class="info-col-title">Pengumuman</h2>
				<?php
				$pengumuman_query = new WP_Query( array( 'post_type' => 'pengumuman', 'posts_per_page' => 3 ) );
				if ( $pengumuman_query->have_posts() ) :
					while ( $pengumuman_query->have_posts() ) : $pengumuman_query->the_post();
						?>
						<article class="info-item">
							<h3 class="info-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<ul class="info-detail">
								<li class="info-date"><?php echo sekolahku_tanggal_spans( sekolahku_tanggal_indonesia( get_the_date() ) ); ?></li>
							</ul>
							<p class="info-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="read-more">Selengkapnya &raquo;</a>
						</article>
						<?php
					endwhile; wp_reset_postdata();
				else :
					echo '<p class="info-empty">Belum ada pengumuman.</p>';
				endif;
				?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'pengumuman' ) ); ?>" class="info-more">&raquo; Lihat Semua Pengumuman</a>
			</div>

			<!-- Kolom Agenda -->
			<div class="info-col">
				<h2 class="info-col-title">Agenda</h2>
				<?php
				$agenda_query = new WP_Query( array( 'post_type' => 'agenda', 'posts_per_page' => 3 ) );
				if ( $agenda_query->have_posts() ) :
					while ( $agenda_query->have_posts() ) : $agenda_query->the_post();
						$tanggal = get_post_meta( get_the_ID(), '_agenda_tanggal', true );
						$waktu   = get_post_meta( get_the_ID(), '_agenda_waktu', true );
						$lokasi  = get_post_meta( get_the_ID(), '_agenda_lokasi', true );
						?>
						<article class="agenda-item info-item">
							<div class="agenda-date-box"><?php echo sekolahku_tanggal_spans( $tanggal ? $tanggal : sekolahku_tanggal_indonesia( get_the_date() ) ); ?></div>
							<div class="agenda-info">
								<h3 class="info-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="info-detail-text">
									<?php if ( $waktu ) : ?><span>&bull; <?php echo esc_html( $waktu ); ?></span><?php endif; ?>
									<?php if ( $lokasi ) : ?><span> | <?php echo esc_html( $lokasi ); ?></span><?php endif; ?>
								</p>
							</div>
						</article>
						<?php
					endwhile; wp_reset_postdata();
				else :
					echo '<p class="info-empty">Belum ada agenda.</p>';
				endif;
				?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'agenda' ) ); ?>" class="info-more">&raquo; Lihat Semua Agenda</a>
			</div>

			<!-- Kolom Berita -->
			<div class="info-col">
				<h2 class="info-col-title">Berita</h2>
				<?php
				$berita_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 2 ) );
				$berita_i = 0;
				if ( $berita_query->have_posts() ) :
					while ( $berita_query->have_posts() ) : $berita_query->the_post();
						$berita_i++;
						$categories = get_the_category();
						$cat_name   = ! empty( $categories ) ? $categories[0]->name : '';
						?>
						<article class="info-item info-news <?php echo $berita_i === 1 ? 'info-news-first' : ''; ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="info-thumb-link">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'info-thumb' ) ); ?>
								</a>
							<?php else : ?>
								<div class="info-thumb-placeholder info-thumb"></div>
							<?php endif; ?>
							<?php if ( $cat_name ) : ?>
								<span class="info-cat"><?php echo esc_html( $cat_name ); ?></span>
							<?php endif; ?>
							<h3 class="info-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<ul class="info-detail">
								<li class="info-date"><?php echo sekolahku_tanggal_spans( sekolahku_tanggal_indonesia( get_the_date() ) ); ?></li>
							</ul>
							<p class="info-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="read-more">Selengkapnya &raquo;</a>
						</article>
						<?php
					endwhile; wp_reset_postdata();
				else :
					echo '<p class="info-empty">Belum ada berita.</p>';
				endif;
				?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="info-more">&raquo; Lihat Semua Berita</a>
			</div>
		</div>
	</div>
</section>

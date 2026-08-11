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
								<li class="info-date">
									<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-1px; margin-right:4px; opacity:0.7;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
									<?php echo esc_html( sekolahku_format_indo_date( get_the_date( 'Y-m-d H:i:s' ) ) ); ?>
								</li>
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
				$agendas = sekolahku_get_sorted_agendas( 3 );
				if ( ! empty( $agendas ) ) :
					global $post;
					foreach ( $agendas as $post ) :
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
											<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
											Agenda terlewat
										</span>
									<?php elseif ( $waktu ) : ?>
										<span class="meta-pill meta-time">
											<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
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
						<?php
						$img_src = '';
						if ( has_post_thumbnail() ) {
							$img_src = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
						}
						if ( empty( $img_src ) ) {
							$content = get_the_content();
							if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches ) ) {
								$img_src = sekolahku_make_url_dynamic( $matches[1] );
							}
						}
						if ( empty( $img_src ) ) {
							$img_src = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=600&q=80';
						}
						?>
						<article class="info-item info-news <?php echo $berita_i === 1 ? 'info-news-first' : ''; ?>">
							<a href="<?php the_permalink(); ?>" class="info-thumb-link" style="display:block; width:100%; height:160px; border-radius:10px; overflow:hidden; margin-bottom:12px; background:#f1f5f9;">
								<img src="<?php echo esc_url( $img_src ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; height:100%; object-fit:cover;">
							</a>
							<?php if ( $cat_name ) : ?>
								<span class="news-cat-badge"><?php echo esc_html( $cat_name ); ?></span>
							<?php endif; ?>
							<h3 class="info-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<ul class="info-detail">
								<li class="info-date"><?php echo esc_html( sekolahku_format_indo_date( get_the_date( 'Y-m-d H:i:s' ) ) ); ?></li>
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
				<?php $berita_link = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/berita/' ); ?>
				<a href="<?php echo esc_url( $berita_link ); ?>" class="info-more">&raquo; Lihat Semua Berita</a>
			</div>
		</div>
	</div>
</section>

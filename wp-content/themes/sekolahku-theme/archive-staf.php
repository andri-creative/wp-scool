<?php

/**
 * Template Archive untuk Staf & Guru
 *
 * @package SekolahKu
 */
if (!defined('ABSPATH')) {
	exit;
}

get_header();
get_template_part('template-parts/breadcrumb');

$title = get_theme_mod('sekolahku_staf_title', 'Staf & Guru');
$subtitle = get_theme_mod('sekolahku_staf_subtitle', 'Guru dan Staf sekolah kami terdiri dari tenaga profesional yang berpengalaman dan berkomitmen dalam mendukung pendidikan yang berkualitas.');
?>


<div class="container staf-archive-container" style="margin-bottom: 80px;">
	<h1 class="staf-page-title"><?php echo esc_html( $title ); ?></h1>
	<div class="staff-archive-grid">
		<?php if (have_posts()): ?>
			<div class="staf-grid-container">
				<?php
				while (have_posts()):
					the_post();
					?>
					<div class="card staff-card">
						<a href="<?php the_permalink(); ?>" class="staff-card-link">
							<div class="staff-thumb">
								<img src="<?php echo esc_url(sekolahku_get_staf_avatar(get_the_ID())); ?>" alt="<?php the_title_attribute(); ?>" class="staff-img">
							</div>
							<div class="staff-body">
								<h3><?php the_title(); ?></h3>
								<?php
								$raw_content = get_the_content();
								$clean_text = wp_strip_all_tags(str_replace(array('</li>', '</p>', '<br>', '<br/>'), "\n", $raw_content));
								$staf_role = get_post_meta(get_the_ID(), '_staf_role', true);
								if (!$staf_role) {
									if (preg_match('/Jabatan\s*[:\-]?\s*([^\n\r]+)/i', $clean_text, $m_role)) {
										$staf_role = trim($m_role[1]);
									} else {
										$staf_role = wp_trim_words($clean_text, 5);
									}
								}
								?>
								<p><?php echo esc_html($staf_role ? $staf_role : 'Tenaga Pendidik'); ?></p>
							</div>
						</a>
					</div>
					<?php
				endwhile;
				?>
			</div>

			<div class="pagination" style="margin-top: 50px;">
				<?php the_posts_pagination(array(
					'prev_text' => '&larr; Sebelumnya',
					'next_text' => 'Berikutnya &rarr;',
				)); ?>
			</div>
		<?php else: ?>
			<div class="no-data-box" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
				<h3 style="color: #64748b; font-size: 18px;">Belum ada data staf dan guru yang dipublikasikan.</h3>
			</div>
		<?php endif; ?>
	</div>
</div>

<style>
/* Styling Judul Halaman Staf */
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

/* Grid responsif dinamis untuk Halaman Archive Staf */
.staf-grid-container {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
	gap: 24px;
}
.staff-card {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
	transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
	display: flex;
	flex-direction: column;
	text-align: center;
	height: 100%;
}
.staff-card:hover {
	transform: translateY(-6px);
	box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
	border-color: #e2e8f0;
}
.staff-card-link {
	text-decoration: none;
	color: inherit;
	display: flex;
	flex-direction: column;
	height: 100%;
}
.staff-thumb {
	width: 100%;
	aspect-ratio: 4 / 5;
	background: #f1f5f9;
	overflow: hidden;
}
.staff-img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
	transition: transform 0.5s ease;
}
.staff-card:hover .staff-img {
	transform: scale(1.05);
}
.staff-body {
	padding: 20px;
	flex: 1;
	display: flex;
	flex-direction: column;
	justify-content: center;
}
.staff-body h3 {
	font-size: 17px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 6px;
}
.staff-body p {
	font-size: 14px;
	color: #64748b;
	margin: 0;
	font-weight: 500;
}

/* Responsivitas Grid */
@media (max-width: 1024px) {
	.staf-grid-container {
		grid-template-columns: repeat(3, 1fr);
		gap: 20px;
	}
}
@media (max-width: 768px) {
	.staf-grid-container {
		grid-template-columns: repeat(2, 1fr);
		gap: 16px;
	}
}
@media (max-width: 480px) {
	.staf-grid-container {
		grid-template-columns: 1fr;
		gap: 20px;
	}
	.staff-thumb {
		aspect-ratio: 1 / 1;
	}
}
</style>

<?php get_footer(); ?>

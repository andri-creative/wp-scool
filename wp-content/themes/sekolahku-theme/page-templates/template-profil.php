<?php
/**
 * Template Name: Profil Sekolah
 * Description: Halaman profil sekolah dengan desain premium. Semua isi diedit dari editor WP Admin.
 *
 * Cara Edit: WP Admin → Halaman → Edit halaman "Profil Sekolah" → Ketik/edit teks → Simpan.
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<div class="container profil-page-container">

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- JUDUL HALAMAN -->
		<h1 class="profil-page-h1"><?php the_title(); ?></h1>

		<!-- KONTEN DARI EDITOR WP ADMIN -->
		<div class="profil-page-content">
			<?php the_content(); ?>
		</div>

		<!-- TOMBOL BAGIKAN -->
		<?php get_template_part( 'template-parts/share-buttons' ); ?>

	<?php endwhile; ?>

</div>

<style>
/* =========================================================
   PROFIL SEKOLAH — CLEAN & ELEGANT
   ========================================================= */

.profil-page-container {
	padding-bottom: 80px;
	max-width: 860px;
}

/* JUDUL UTAMA H1 */
.profil-page-h1 {
	font-size: 30px;
	font-weight: 800;
	color: #0f172a;
	margin: 0 0 36px 0;
	line-height: 1.25;
}

/* BODY KONTEN */
.profil-page-content {
	font-size: 15.5px;
	line-height: 1.95;
	color: #475569;
}

/* PARAGRAF PERTAMA — sedikit lebih menonjol */
.profil-page-content > p:first-of-type {
	font-size: 16.5px;
	color: #1e293b;
	font-weight: 500;
	line-height: 1.85;
	margin-bottom: 24px;
}

/* PARAGRAF BIASA */
.profil-page-content p {
	margin: 0 0 18px;
}

/* HEADING H2 — Judul section (Visi, Misi, dll.) */
.profil-page-content h2 {
	font-size: 19px;
	font-weight: 800;
	color: #0f172a;
	margin: 44px 0 16px;
	line-height: 1.3;
	padding-bottom: 10px;
	border-bottom: 2px solid #e2e8f0;
	position: relative;
}
.profil-page-content h2::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: -2px;
	width: 48px;
	height: 2px;
	background: #ff7a00;
}

/* HEADING H3 */
.profil-page-content h3 {
	font-size: 16.5px;
	font-weight: 700;
	color: #0f172a;
	margin: 28px 0 10px;
	line-height: 1.35;
}

/* LIST UL — Poin-poin bersih */
.profil-page-content ul {
	margin: 0 0 22px 0;
	padding: 0;
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: 8px;
}
.profil-page-content ul li {
	display: flex;
	align-items: flex-start;
	gap: 12px;
	font-size: 15px;
	color: #334155;
	line-height: 1.65;
	padding: 4px 0;
}
.profil-page-content ul li::before {
	content: "";
	display: inline-block;
	min-width: 8px;
	height: 8px;
	background: #ff7a00;
	border-radius: 50%;
	flex-shrink: 0;
	margin-top: 9px;
}

/* LIST OL */
.profil-page-content ol {
	margin: 0 0 22px 0;
	padding: 0 0 0 22px;
	color: #334155;
}
.profil-page-content ol li {
	font-size: 15px;
	line-height: 1.65;
	margin-bottom: 8px;
}

/* STRONG */
.profil-page-content strong {
	color: #0f172a;
	font-weight: 700;
}

/* GAMBAR INLINE */
.profil-page-content img {
	max-width: 100%;
	height: auto;
	border-radius: 14px;
	margin: 18px 0;
	box-shadow: 0 6px 20px rgba(15, 23, 42, 0.07);
}

/* HR DIVIDER */
.profil-page-content hr {
	border: none;
	height: 1px;
	background: #e2e8f0;
	margin: 40px 0;
}

/* BLOCKQUOTE */
.profil-page-content blockquote {
	margin: 24px 0;
	padding: 18px 22px;
	background: #f8fafc;
	border-left: 4px solid #1d4ed8;
	border-radius: 0 10px 10px 0;
	color: #1e293b;
	font-size: 15px;
	line-height: 1.7;
}

@media (max-width: 768px) {
	.profil-page-h1 { font-size: 24px; }
	.profil-page-content h2 { font-size: 17px; }
	.profil-page-content > p:first-of-type { font-size: 15.5px; }
}
</style>

<?php get_footer(); ?>


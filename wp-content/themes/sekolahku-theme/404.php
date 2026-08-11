<?php
/**
 * Template Halaman 404 Not Found - Standalone (TANPA Header & Footer).
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title    = get_theme_mod( 'sekolahku_404_title', '404 - Halaman Tidak Ditemukan' );
$subtitle = get_theme_mod( 'sekolahku_404_subtitle', 'Maaf, halaman yang Anda cari tidak ditemukan, telah dipindahkan, atau dihapus.' );
$btn_text = get_theme_mod( 'sekolahku_404_button_text', 'Kembali ke Beranda' );

$saved_theme = '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 - Halaman Tidak Ditemukan | <?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.page-404-fullscreen {
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 40px 20px;
	background: #f8fafc;
	transition: background 0.3s ease;
	font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
}

body.dark-mode .page-404-fullscreen {
	background: #0f172a;
}

/* Theme Toggle Button */
.btn-404-toggle {
	position: fixed;
	top: 20px;
	right: 20px;
	z-index: 9999;
	width: 42px;
	height: 42px;
	border-radius: 50%;
	border: 1.5px solid #e2e8f0;
	background: #ffffff;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	box-shadow: 0 2px 8px rgba(0,0,0,0.06);
	transition: all 0.25s ease;
}
.btn-404-toggle:hover {
	transform: scale(1.08);
	box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}
body.dark-mode .btn-404-toggle {
	background: #1e293b;
	border-color: #334155;
}
.icon-sun, .icon-moon {
	display: none;
}
body.dark-mode .icon-sun {
	display: block;
}
body:not(.dark-mode) .icon-moon {
	display: block;
}

/* Main Card */
.card-404-standalone {
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 24px;
	padding: 64px 48px;
	max-width: 640px;
	width: 100%;
	text-align: center;
	box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
}
body.dark-mode .card-404-standalone {
	background: #1e293b;
	border-color: #334155;
	box-shadow: 0 20px 60px rgba(0,0,0,0.35);
}

/* 404 Number */
.badge-404-wrap {
	position: relative;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	margin-bottom: 24px;
}
.num-404 {
	font-size: 110px;
	font-weight: 900;
	line-height: 1;
	letter-spacing: -4px;
	background: linear-gradient(135deg, #2563eb, #0284c7, #ff7a00);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
	background-clip: text;
}
.icon-404-float {
	position: absolute;
	top: -14px;
	right: -16px;
	font-size: 40px;
	animation: float404 3.5s ease-in-out infinite;
}
@keyframes float404 {
	0%, 100% { transform: translateY(0) rotate(0deg); }
	50% { transform: translateY(-10px) rotate(8deg); }
}

/* Decorative dots */
.dots-404 {
	display: flex;
	justify-content: center;
	gap: 8px;
	margin-bottom: 20px;
}
.dot-404 {
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: #cbd5e1;
}
.dot-404:nth-child(2) { background: #0284c7; }
body.dark-mode .dot-404 { background: #334155; }
body.dark-mode .dot-404:nth-child(2) { background: #0284c7; }

.title-404 {
	font-size: 24px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 12px;
	line-height: 1.35;
}
body.dark-mode .title-404 { color: #f1f5f9; }

.subtitle-404 {
	font-size: 15px;
	color: #64748b;
	line-height: 1.65;
	margin-bottom: 32px;
	max-width: 460px;
	margin-left: auto;
	margin-right: auto;
}
body.dark-mode .subtitle-404 { color: #94a3b8; }

/* Search bar */
.search-404-box {
	display: flex;
	align-items: center;
	background: #f8fafc;
	border: 1.5px solid #e2e8f0;
	border-radius: 50px;
	padding: 5px 6px 5px 18px;
	margin: 0 auto 24px;
	max-width: 420px;
	transition: border-color 0.2s ease;
}
.search-404-box:focus-within {
	border-color: #0284c7;
	background: #fff;
}
body.dark-mode .search-404-box {
	background: #0f172a;
	border-color: #334155;
}
.search-404-box:focus-within {
	border-color: #0284c7;
}
.search-404-input {
	flex: 1;
	border: none;
	outline: none;
	background: transparent;
	font-size: 14px;
	color: #0f172a;
}
body.dark-mode .search-404-input { color: #f1f5f9; }
.search-404-input::placeholder { color: #94a3b8; }
.btn-404-search {
	padding: 9px 22px;
	background: #0284c7;
	color: #fff;
	border: none;
	border-radius: 50px;
	font-size: 13px;
	font-weight: 700;
	cursor: pointer;
	transition: background 0.2s ease;
	white-space: nowrap;
}
.btn-404-search:hover { background: #0369a1; }

/* Action Buttons */
.actions-404 {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 12px;
	flex-wrap: wrap;
}
.btn-404-home {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	padding: 12px 28px;
	background: linear-gradient(135deg, #ff7a00, #e06c00);
	color: #ffffff;
	font-size: 14.5px;
	font-weight: 700;
	border-radius: 50px;
	text-decoration: none;
	box-shadow: 0 4px 16px rgba(255, 122, 0, 0.3);
	transition: all 0.25s ease;
}
.btn-404-home:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 24px rgba(255, 122, 0, 0.4);
	color: #fff;
}
.btn-404-back {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 12px 22px;
	background: transparent;
	color: #64748b;
	font-size: 14px;
	font-weight: 600;
	border-radius: 50px;
	border: 1.5px solid #e2e8f0;
	text-decoration: none;
	cursor: pointer;
	transition: all 0.2s ease;
}
.btn-404-back:hover {
	background: #f1f5f9;
	color: #0f172a;
	border-color: #cbd5e1;
}
body.dark-mode .btn-404-back {
	border-color: #334155;
	color: #94a3b8;
}
body.dark-mode .btn-404-back:hover {
	background: #0f172a;
	color: #f1f5f9;
}

@media (max-width: 580px) {
	.card-404-standalone { padding: 48px 28px; }
	.num-404 { font-size: 80px; }
	.title-404 { font-size: 20px; }
}
</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Theme Toggle -->
<button class="btn-404-toggle" id="toggle404Theme" aria-label="Ubah tema">
	<svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#334155" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
	<svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
</button>

<div class="page-404-fullscreen">
	<div class="card-404-standalone">

		<!-- 404 Badge -->
		<div class="badge-404-wrap">
			<span class="num-404">404</span>
			<span class="icon-404-float">🎓</span>
		</div>

		<!-- Decorative Dots -->
		<div class="dots-404">
			<div class="dot-404"></div>
			<div class="dot-404"></div>
			<div class="dot-404"></div>
		</div>

		<h1 class="title-404"><?php echo esc_html( $title ); ?></h1>
		<p class="subtitle-404"><?php echo esc_html( $subtitle ); ?></p>

		<!-- Search Bar -->
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="search-404-box">
				<input type="search" class="search-404-input" name="s" placeholder="Cari informasi lain di website..." value="<?php echo get_search_query(); ?>" autocomplete="off" />
				<button type="submit" class="btn-404-search">Cari</button>
			</div>
		</form>

		<!-- Action Buttons -->
		<div class="actions-404">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-404-home">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
				<?php echo esc_html( $btn_text ); ?>
			</a>
			<a href="javascript:history.back()" class="btn-404-back">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
				Kembali
			</a>
		</div>

	</div>
</div>

<script>
(function() {
	var btn = document.getElementById('toggle404Theme');
	var saved = localStorage.getItem('sekolahku_theme');
	if (saved === 'dark') {
		document.body.classList.add('dark-mode');
	}
	if (btn) {
		btn.addEventListener('click', function() {
			var isDark = document.body.classList.toggle('dark-mode');
			localStorage.setItem('sekolahku_theme', isDark ? 'dark' : 'light');
		});
	}
})();
</script>

<?php wp_footer(); ?>
</body>
</html>

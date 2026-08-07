<?php
/**
 * Modul Redesain UI Login Modern (wp-login.php) - SekolahKu Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue CSS kustom untuk halaman Login WordPress.
 */
function sekolahku_custom_login_style() {
	$bg_image  = get_theme_mod( 'sekolahku_login_bg_image' );
	$logo_image = get_theme_mod( 'sekolahku_login_logo' );
	$title      = get_theme_mod( 'sekolahku_login_title', 'Portal Admin Sekolah' );
	$subtitle   = get_theme_mod( 'sekolahku_login_subtitle', 'Silakan masuk untuk mengelola sistem informasi sekolah' );

	if ( ! $bg_image ) {
		// Default background foto sekolah siswa berkualitas tinggi
		$bg_image = 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80';
	}

	if ( ! $logo_image && has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo_data      = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $logo_data ) {
			$logo_image = $logo_data[0];
		}
	}
	?>
	<style type="text/css">
		/* Base Overlay Background */
		body.login {
			background: linear-gradient(135deg, rgba(15, 23, 42, 0.78) 0%, rgba(30, 41, 59, 0.85) 100%),
						url('<?php echo esc_url( $bg_image ); ?>') no-repeat center center fixed !important;
			background-size: cover !important;
			font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			margin: 0;
			padding: 20px;
			box-sizing: border-box;
		}

		/* Login Container Wrapper */
		#login {
			width: 100% !important;
			max-width: 440px !important;
			padding: 0 !important;
			margin: auto !important;
		}

		/* Header Logo & Title */
		#login h1 {
			margin-bottom: 24px;
		}
		#login h1 a {
			background-image: <?php echo $logo_image ? "url('" . esc_url( $logo_image ) . "')" : 'none'; ?> !important;
			background-size: contain !important;
			background-position: center center !important;
			width: 100% !important;
			height: 80px !important;
			margin: 0 auto 10px !important;
			text-indent: <?php echo $logo_image ? '-9999px' : '0'; ?> !important;
			font-size: 1.8rem !important;
			font-weight: 800 !important;
			color: #ffffff !important;
			text-shadow: 0 2px 10px rgba(0,0,0,0.3);
			display: block !important;
		}

		/* Subheading text under logo */
		.login-custom-subhead {
			text-align: center;
			color: #e2e8f0;
			margin-bottom: 24px;
		}
		.login-custom-subhead h2 {
			font-size: 1.5rem;
			font-weight: 700;
			color: #ffffff;
			margin: 0 0 6px 0;
		}
		.login-custom-subhead p {
			font-size: 0.9rem;
			color: #94a3b8;
			margin: 0;
		}

		/* Glassmorphism Login Card Form */
		#loginform, #nav, #backtoblog {
			box-sizing: border-box;
		}

		body.login #loginform {
			background: rgba(255, 255, 255, 0.94) !important;
			backdrop-filter: blur(16px);
			-webkit-backdrop-filter: blur(16px);
			border: 1px solid rgba(255, 255, 255, 0.4) !important;
			border-radius: 20px !important;
			padding: 36px 32px !important;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
		}

		/* Input Labels */
		body.login label {
			font-size: 0.875rem !important;
			font-weight: 600 !important;
			color: #334155 !important;
			margin-bottom: 8px !important;
			display: block !important;
		}

		/* Text Input Fields */
		body.login input[type="text"],
		body.login input[type="password"] {
			width: 100% !important;
			height: 48px !important;
			padding: 0 16px !important;
			background: #f8fafc !important;
			border: 1.5px solid #cbd5e1 !important;
			border-radius: 10px !important;
			font-size: 0.95rem !important;
			color: #0f172a !important;
			box-shadow: none !important;
			transition: all 0.2s ease !important;
			box-sizing: border-box !important;
		}

		body.login input[type="text"]:focus,
		body.login input[type="password"]:focus {
			border-color: #0284c7 !important;
			background: #ffffff !important;
			box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15) !important;
			outline: none !important;
		}

		/* Remember Me Checkbox Row */
		body.login .forgetmenot {
			margin-top: 12px;
			margin-bottom: 20px;
		}
		body.login .forgetmenot label {
			display: inline-flex !important;
			align-items: center;
			gap: 8px;
			font-weight: 500 !important;
			color: #475569 !important;
		}

		/* Primary Submit Button */
		body.login input[type="submit"] {
			width: 100% !important;
			height: 48px !important;
			background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
			border: none !important;
			border-radius: 10px !important;
			color: #ffffff !important;
			font-size: 1rem !important;
			font-weight: 700 !important;
			cursor: pointer !important;
			box-shadow: 0 4px 14px rgba(2, 132, 199, 0.4) !important;
			transition: all 0.25s ease !important;
			float: none !important;
			margin-top: 10px !important;
		}

		body.login input[type="submit"]:hover {
			background: linear-gradient(135deg, #0369a1 0%, #075985 100%) !important;
			transform: translateY(-1px);
			box-shadow: 0 6px 20px rgba(2, 132, 199, 0.5) !important;
		}

		/* Bottom Navigation Links (Lost password & Back to home) */
		body.login #nav, body.login #backtoblog {
			text-align: center !important;
			padding: 0 !important;
			margin-top: 16px !important;
		}

		body.login #nav a, body.login #backtoblog a {
			color: #cbd5e1 !important;
			font-size: 0.9rem !important;
			font-weight: 500 !important;
			text-decoration: none !important;
			transition: color 0.2s ease !important;
		}

		body.login #nav a:hover, body.login #backtoblog a:hover {
			color: #38bdf8 !important;
			text-decoration: underline !important;
		}

		/* Messages & Errors */
		body.login .message, body.login #login_error {
			border-radius: 10px !important;
			border-left-width: 4px !important;
			background: rgba(255, 255, 255, 0.95) !important;
			box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
		}
	</style>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const loginH1 = document.querySelector('#login h1');
			if (loginH1) {
				const subhead = document.createElement('div');
				subhead.className = 'login-custom-subhead';
				subhead.innerHTML = '<h2><?php echo esc_js( $title ); ?></h2><p><?php echo esc_js( $subtitle ); ?></p>';
				loginH1.insertAdjacentElement('afterend', subhead);
			}
		});
	</script>
	<?php
}
add_action( 'login_enqueue_scripts', 'sekolahku_custom_login_style' );

/**
 * Ubah URL Link Header Logo Login agar mengarah ke Beranda Website Sekolah.
 */
function sekolahku_login_logo_url() {
	return home_url( '/' );
}
add_filter( 'login_headerurl', 'sekolahku_login_logo_url' );

/**
 * Ubah Judul Hover Header Logo Login.
 */
function sekolahku_login_logo_url_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'sekolahku_login_logo_url_title' );

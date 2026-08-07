<?php
/**
 * Template Beranda (Homepage) - Versi Modular.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/home/section', 'hero' );
get_template_part( 'template-parts/home/section', 'welcome' );
get_template_part( 'template-parts/home/section', 'info' );
get_template_part( 'template-parts/home/section', 'benefit' );
get_template_part( 'template-parts/home/section', 'staf' );
get_template_part( 'template-parts/home/section', 'fasilitas' );
get_template_part( 'template-parts/home/section', 'ekskul' );
get_template_part( 'template-parts/home/section', 'galeri' );
get_template_part( 'template-parts/home/section', 'testimoni' );
get_template_part( 'template-parts/home/section', 'news' );
get_template_part( 'template-parts/home/section', 'cta' );

get_footer();

<?php
/**
 * Template Part: Reusable Social Share Buttons (Tombol Bagikan).
 * Dapat digunakan di single post, single staf, single ekskul, single fasilitas, dll.
 *
 * @package SekolahKu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id   = get_the_ID();
$title     = get_the_title( $post_id );
$permalink = get_permalink( $post_id );

// Thumbnail / Avatar fallback
if ( has_post_thumbnail( $post_id ) ) {
	$thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
} elseif ( function_exists( 'sekolahku_get_staf_avatar' ) ) {
	$thumb_url = sekolahku_get_staf_avatar( $post_id );
} else {
	$thumb_url = '';
}
?>

<!-- TOMBOL BAGIKAN (SHARE) -->
<div class="staf-share-bar">
	<span class="share-title">Bagikan</span>
	<div class="share-buttons">
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $permalink ); ?>" target="_blank" rel="noopener" class="share-btn share-fb" title="Bagikan ke Facebook">
			<svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
		</a>
		<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $title ); ?>&url=<?php echo urlencode( $permalink ); ?>" target="_blank" rel="noopener" class="share-btn share-x" title="Bagikan ke X">
			<svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
		</a>
		<a href="https://api.whatsapp.com/send?text=<?php echo urlencode( $title . ' - ' . $permalink ); ?>" target="_blank" rel="noopener" class="share-btn share-wa" title="Bagikan ke WhatsApp">
			<svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.461c-1.99 0-3.951-.535-5.67-1.551l-.407-.242-4.218 1.106 1.125-4.111-.266-.423c-1.117-1.776-1.706-3.837-1.706-5.952 0-6.191 5.037-11.229 11.233-11.229 3.001 0 5.82 1.168 7.94 3.29 2.12 2.121 3.287 4.94 3.287 7.94 0 6.192-5.037 11.23-11.226 11.23"/></svg>
		</a>
		<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( $permalink ); ?>&media=<?php echo urlencode( $thumb_url ); ?>&description=<?php echo urlencode( $title ); ?>" target="_blank" rel="noopener" class="share-btn share-pin" title="Bagikan ke Pinterest">
			<svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
		</a>
		<a href="https://threads.net/intent/post?text=<?php echo urlencode( $title . ' - ' . $permalink ); ?>" target="_blank" rel="noopener" class="share-btn share-th" title="Bagikan ke Threads">
			<svg width="14" height="14" fill="currentColor" viewBox="0 0 192 192"><path d="M141.537 88.988a66.667 66.667 0 0 0-2.518-1.143c-1.482-27.307-16.403-42.94-41.457-43.1h-.34c-14.986 0-27.449 6.396-35.12 18.036l13.779 9.452c5.73-8.695 14.724-10.548 21.348-10.548h.229c8.249.053 14.474 2.452 18.503 7.129 2.932 3.405 4.893 8.111 5.864 14.05-7.314-1.243-15.224-1.626-23.68-1.14-23.82 1.371-39.134 15.264-38.105 34.568.522 9.792 5.4 18.216 13.735 23.719 7.047 4.652 16.124 6.927 25.557 6.412 12.458-.683 22.231-5.436 29.049-14.127 5.178-6.6 8.453-15.153 9.899-25.93 5.937 3.583 10.337 8.298 12.767 13.966 4.132 9.635 4.373 25.468-8.546 38.376-11.319 11.308-24.925 16.2-45.488 16.351-22.809-.169-40.06-7.484-51.275-21.742C35.236 139.966 29.808 120.682 29.605 96c.203-24.682 5.63-43.966 16.133-57.317C56.954 24.425 74.204 17.11 97.013 16.94c22.975.17 40.526 7.52 52.171 21.847 5.71 7.026 10.015 15.86 12.853 26.162l16.147-4.308c-3.44-12.68-8.853-23.606-16.219-32.668C147.036 9.607 125.202.195 97.07 0h-.113C68.882.194 47.292 9.642 32.788 28.08 19.882 44.485 13.224 67.315 13.001 95.932L13 96v.067c.224 28.617 6.882 51.447 19.788 67.854C47.292 182.358 68.882 191.806 96.957 192h.113c24.96-.173 42.554-6.708 57.048-21.189 18.963-18.945 18.392-42.692 12.142-57.27-4.484-10.454-13.033-18.945-24.723-24.553ZM98.44 129.507c-10.44.588-21.286-4.098-21.82-14.135-.397-7.442 5.296-15.746 22.461-16.735 1.966-.114 3.895-.169 5.79-.169 6.235 0 12.068.606 17.371 1.765-1.978 24.702-13.58 28.713-23.802 29.274Z"/></svg>
		</a>
	</div>
</div>
<style>
.staf-share-bar {
	display: flex;
	align-items: center;
	gap: 14px;
	padding: 16px 0;
	border-top: 1px solid #f1f5f9;
	border-bottom: 1px solid #f1f5f9;
	margin-bottom: 36px;
}
.share-title {
	font-weight: 700;
	font-size: 14px;
	color: #0f172a;
}
.share-buttons {
	display: flex;
	align-items: center;
	gap: 8px;
}
.share-btn {
	width: 32px;
	height: 32px;
	border-radius: 6px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	color: #ffffff;
	transition: transform 0.2s, opacity 0.2s;
	text-decoration: none;
}
.share-btn:hover {
	transform: translateY(-2px);
	opacity: 0.9;
}
.share-fb { background: #1877f2; }
.share-x  { background: #14171a; }
.share-wa { background: #25d366; }
.share-pin{ background: #e60023; }
.share-th { background: #000000; }
</style>

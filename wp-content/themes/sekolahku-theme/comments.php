<?php
/**
 * Template Komentar & Form Pengiriman Komentar (`comments.php`).
 *
 * @package SekolahKu
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area-wrapper" style="margin-top: 50px;">

	<?php if ( have_comments() ) : ?>
		<div class="comments-header-title">
			<h3 class="decorated-title">
				Komentar (<?php echo esc_html( get_comments_number() ); ?>)
			</h3>
		</div>

		<ol class="comment-list-container">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 64,
				'callback'    => 'sekolahku_comment_callback',
			) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( '&larr; Komentar Sebelumnya' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Komentar Selanjutnya &rarr;' ); ?></div>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments-text">Kolom komentar telah ditutup.</p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true' required" : '' );

	$fields = array(
		'author' => '<div class="comment-form-field">
						<label for="author">' . __( 'Nama Lengkap', 'sekolahku' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
						<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Masukkan nama Anda"' . $aria_req . ' />
					 </div>',

		'email'  => '<div class="comment-form-field">
						<label for="email">' . __( 'Alamat Email', 'sekolahku' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>
						<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="nama@email.com"' . $aria_req . ' />
					 </div>',

		'url'    => '<div class="comment-form-field">
						<label for="url">' . __( 'Situs Web (Opsional)', 'sekolahku' ) . '</label>
						<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="https://website-anda.com" />
					 </div>',
	);

	$comment_field = '<div class="comment-form-field comment-textarea-field">
						<label for="comment">' . __( 'Komentar', 'sekolahku' ) . ' <span class="required">*</span></label>
						<textarea id="comment" name="comment" cols="45" rows="5" placeholder="Tuliskan komentar atau tanggapan Anda di sini..." required></textarea>
					  </div>';

	comment_form( array(
		'title_reply'          => __( 'Tinggalkan Komentar', 'sekolahku' ),
		'title_reply_to'       => __( 'Tinggalkan Balasan untuk %s', 'sekolahku' ),
		'cancel_reply_link'    => __( 'Batal Balas', 'sekolahku' ),
		'label_submit'         => __( 'Kirim Komentar', 'sekolahku' ),
		'class_submit'         => 'btn-submit-comment',
		'comment_field'        => $comment_field,
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Alamat email Anda tidak akan dipublikasikan. Bidang wajib ditandai *', 'sekolahku' ) . '</p>',
	) );
	?>
</div>

<style>
/* WRAPPER KOMENTAR */
.comments-area-wrapper {
	border-top: 1px solid #e2e8f0;
	padding-top: 36px;
}

/* DEKORASI JUDUL "KOMENTAR" */
.comments-header-title {
	margin-bottom: 24px;
}
.comments-header-title h3.decorated-title {
	font-size: 20px;
	font-weight: 800;
	color: #0f172a;
	margin: 0;
	position: relative;
	padding-bottom: 8px;
}
.comments-header-title h3.decorated-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 45px;
	height: 3px;
	background: var(--color-accent, #ff7a00);
	border-radius: 2px;
}

/* LIST KOMENTAR */
.comment-list-container {
	list-style: none;
	padding: 0;
	margin: 0 0 40px 0;
	display: flex;
	flex-direction: column;
	gap: 20px;
}
.comment-list-container .children {
	list-style: none;
	padding-left: 32px;
	margin-top: 16px;
	display: flex;
	flex-direction: column;
	gap: 16px;
}
.comment-item-wrapper {
	margin: 0;
}
.comment-card-box {
	display: flex;
	gap: 16px;
	background: #f8fafc;
	border: 1px solid #e2e8f0;
	border-radius: 14px;
	padding: 20px;
	transition: all 0.2s ease;
}
.comment-card-box:hover {
	box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
	background: #ffffff;
}
.comment-avatar {
	flex-shrink: 0;
	width: 50px;
	height: 50px;
	border-radius: 50%;
	overflow: hidden;
	background: #cbd5e1;
}
.comment-avatar img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}
.comment-content-wrap {
	flex: 1;
}
.comment-header-info {
	display: flex;
	justify-content: space-between;
	align-items: center;
	flex-wrap: wrap;
	gap: 8px;
	margin-bottom: 8px;
}
.comment-author-name {
	font-size: 15px;
	font-weight: 700;
	color: #0f172a;
	margin: 0;
}
.comment-author-name a {
	color: #0f172a;
	text-decoration: none;
	transition: color 0.2s;
}
.comment-author-name a:hover {
	color: var(--color-link-hover, #ff7a00);
}
.comment-date-time {
	font-size: 12.5px;
	color: #64748b;
}
.comment-text-body {
	font-size: 14.5px;
	line-height: 1.65;
	color: #334155;
	margin-bottom: 10px;
}
.comment-text-body p {
	margin: 0 0 8px 0;
}
.comment-text-body p:last-child {
	margin-bottom: 0;
}
.comment-reply-action a {
	display: inline-flex;
	align-items: center;
	font-size: 13px;
	font-weight: 700;
	color: var(--color-primary, #0284c7);
	text-decoration: none;
	transition: color 0.2s ease;
}
.comment-reply-action a:hover {
	color: var(--color-accent, #ff7a00);
}
.comment-awaiting-moderation {
	color: #d97706;
	font-size: 13px;
	font-style: italic;
	margin-bottom: 8px;
}

/* FORM KOMENTAR */
#reply-title {
	font-size: 20px;
	font-weight: 800;
	color: #0f172a;
	margin-bottom: 8px;
}
#cancel-comment-reply-link {
	font-size: 13px;
	color: #ef4444;
	margin-left: 10px;
	font-weight: 600;
}
.comment-notes {
	font-size: 13px;
	color: #64748b;
	margin-bottom: 20px;
}
.comment-form {
	display: flex;
	flex-direction: column;
	gap: 16px;
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 16px;
	padding: 24px;
	box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
}
.comment-form-field {
	display: flex;
	flex-direction: column;
	gap: 6px;
}
.comment-form-field label {
	font-size: 13.5px;
	font-weight: 700;
	color: #334155;
}
.comment-form-field label .required {
	color: #ef4444;
}
.comment-form-field input[type="text"],
.comment-form-field input[type="email"],
.comment-form-field input[type="url"],
.comment-form-field textarea {
	width: 100%;
	padding: 10px 14px;
	border: 1px solid #cbd5e1;
	border-radius: 8px;
	font-size: 14px;
	color: #0f172a;
	outline: none;
	background: #f8fafc;
	transition: all 0.2s ease;
}
.comment-form-field input:focus,
.comment-form-field textarea:focus {
	background: #ffffff;
	border-color: var(--color-primary, #0284c7);
	box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
}
.comment-form-cookies-consent {
	display: flex;
	align-items: center;
	gap: 8px;
	font-size: 13px;
	color: #64748b;
}
.btn-submit-comment {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 12px 28px;
	background: var(--color-primary, #0284c7);
	color: #ffffff;
	border: none;
	border-radius: 8px;
	font-size: 14px;
	font-weight: 700;
	cursor: pointer;
	align-self: flex-start;
	transition: background 0.2s ease, transform 0.2s ease;
	box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
}
.btn-submit-comment:hover {
	background: var(--color-primary-dark, #0369a1);
	transform: translateY(-1px);
}

@media (max-width: 640px) {
	.comment-card-box {
		flex-direction: column;
		gap: 10px;
	}
	.comment-list-container .children {
		padding-left: 16px;
	}
}
</style>

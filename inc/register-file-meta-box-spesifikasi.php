<?php

function meta_box_spesifikasi() {
	add_meta_box( 'spesifikasi', __( 'Spesifikasi', 'jejakcyber' ), 'meta_box_spesifikasi_callback', 'file' );
}

add_action( 'add_meta_boxes', 'meta_box_spesifikasi' );

function meta_box_spesifikasi_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'additional_information_nonce', 'additional_information_nonce' ); ?>

	<div class="meta_box">
		<style scoped>
			.meta_box {
				display: flex;
				align-items: stretch;
				gap: 0rem;
				flex-flow: column;
			}
			.meta_field {
				/* flex-grow: 8 */
			}
			.meta_field > label {
				font-weight: bold;
			}
			.meta_field > input {
				width: 100%;
				margin-top: .5rem;
				border-radius: 1px;
			}
		</style>
		<p class="meta-options meta_field">
			<label for="name">Nama :</label>
			<input id="name" type="text" name="name" value="<?php echo esc_attr( get_post_meta( $post->ID, 'name', true ) ); ?>" placeholder="nama-file.apk">
		</p>
		<p class="meta-options meta_field">
			<label for="publisher">Publisher :</label>
			<input id="publisher" type="text" name="publisher" value="<?php echo esc_attr( get_post_meta( $post->ID, 'publisher', true ) ); ?>" placeholder="Netmarble">
		</p>
		<p class="meta-options meta_field">
			<label for="version">Versi :</label>
			<input id="version" type="text" name="version" value="<?php echo esc_attr( get_post_meta( $post->ID, 'version', true ) ); ?>" placeholder="2.3.1">
		</p>
		<p class="meta-options meta_field">
			<label for="googledrive">Google Drive :</label>
			<input id="googledrive" type="text" name="googledrive" value="<?php echo esc_attr( get_post_meta( $post->ID, 'googledrive', true ) ); ?>" placeholder="https://drive.google.com/file/d/1_WOCfxiShCoj3zJ9JFS2f4wY2KNdYUyD/view?usp=sharing">
		</p>
		<p class="meta-options meta_field">
			<label for="dropbox">Dropbox :</label>
			<input id="dropbox" type="text" name="dropbox" value="<?php echo esc_attr( get_post_meta( $post->ID, 'dropbox', true ) ); ?>" placeholder="https://www.dropbox.com/scl/fo/pnhwhqq4g6ui299u4ps9c/h?dl=0&rlkey=gzz0clp3zjdns93uh9qpbwupt">
		</p>
		<p class="meta-options meta_field">
			<label for="size">Ukuran File :</label>
			<input id="size" type="text" name="size" value="<?php echo esc_attr( get_post_meta( $post->ID, 'size', true ) ); ?>" placeholder="33.2 MB">
		</p>
		<p class="meta-options meta_field">
			<label for="android-version">Min. Versi Android :</label>
			<input id="android-version" type="text" name="android-version" value="<?php echo esc_attr( get_post_meta( $post->ID, 'android-version', true ) ); ?>" placeholder="5">
		</p>
	</div>

<?php }

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_meta_box_spesifikasi_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['additional_information_nonce'] ) ) {
			return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['additional_information_nonce'], 'additional_information_nonce' ) ) {
			return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
		}
	}
	else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
		}
	}

	$fields = [
		'name',
		'publisher',
		'version',
		'size',
		'android-version',
		'googledrive',
		'dropbox',
	];
	foreach ( $fields as $field ) {
			if ( array_key_exists( $field, $_POST ) ) {
					update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
			}
	}
}

add_action( 'save_post', 'save_meta_box_spesifikasi_data' );
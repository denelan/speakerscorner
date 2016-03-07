<?php

function ZEB_add_custom_metabox() {

	add_meta_box(
		'ZEB_meta',
		'Speaker',
		'ZEB_meta_callback',
		'speaker',
		'normal',
		'high'
	);
}

add_action( 'add_meta_boxes', 'ZEB_add_custom_metabox');

function ZEB_meta_callback( $post ) {
	wp_nonce_field(basename(__FILE__), 'ZEB_speakers_nonce');
	$ZEB_stored_meta = get_post_meta( $post->ID );
	?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="speaker-id" class="ZEB-row-title">Speaker ID</label>
			</div>
			<div class="meta-th">
				<input type="text" name="speaker-id" id="speaker-id" value="<?php if ( ! empty ( $ZEB_stored_meta['speaker-id'] ) ) echo esc_attr( $ZEB_stored_meta['speaker-id'] [0] ); ?>"/>
			</div>
		</div>
	</div>
	<div class="meta-row">
		<div class="meta-th">
			<span>Expertise</span>
		</div>
	</div>
	<div class="meta-editor">

	<?php

	$content = get_post_meta( $post->ID, 'Expertise', true );
	$editor  = 'expertise';
	$settings = array(
		'textarea_rows' => 8,
		);

	wp_editor( $content, $editor, $settings);

	?>
	</div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="minimum-requirements" class="wpdt-row-title"><?php _e( 'Minimum Requirements', 'hrm-textdomain' )?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="minimum-requirements" class ="hrm-textarea" id="minimum-requirements"><?php if ( isset ( $hrm_stored_meta['minimum-requirements'] ) ) echo esc_attr( $hrm_stored_meta['minimum-requirements'][0] ); ?></textarea>
	        </div>
	    </div>
	    <div class="meta-row">
        	<div class="meta-th">
	          <label for="preferred-requirements" class="wpdt-row-title"><?php _e( 'Preferred Requirements', 'hrm-textdomain' )?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="preferred-requirements" class ="hrm-textarea" id="preferred-requirements"><?php if ( isset ( $hrm_stored_meta['preferred-requirements'] ) ) echo esc_attr( $hrm_stored_meta['preferred-requirements'][0] ); ?></textarea>
	        </div>
	    </div>
	    <div class="meta-row">
	        <div class="meta-th">
	          <label for="relocation-assistance" class="prfx-row-title"><?php _e( 'Relocation Assistance', 'hrm-textdomain' )?></label>
	        </div>
	        <div class="meta-td">
	          <select name="relocation-assistance" id="relocation-assistance">
	              <option value="select-yes">Yes</option>';
	              <option value="select-no">No</option>';
	          </select>
	    </div> 
	</div>	
	<?php
}

function ZEB_meta_save( $post_id ) {
	//check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'ZEB_speakers_nonce'] ) && wp_verify_nonce( $_POST[ 'ZEB_speakers_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	//Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	if ( isset( $_POST[ 'speaker-id' ] ) ) {
		update_post_meta( $post_id, 'speaker-id', sanitize_text_field( $_POST[ 'speaker-id' ] ) );
	}
}
add_action( 'save_post', 'ZEB_meta_save' );
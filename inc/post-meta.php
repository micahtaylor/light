<?php
/**
 * Adds a meta box for single posts
 * http://wp.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress
 *
 * @package Light
 * @since Light 1.0
 */
 
/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'light_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'light_post_meta_boxes_setup' );

/* Create one or more meta boxes to be displayed on the post editor screen. */
function light_add_post_meta_boxes() {
	add_meta_box(
		'light-featured-image-meta',			// Unique ID
		esc_html__( 'Thumbnail Meta', 'light' ),// Title
		'light_featured_meta_meta_box',			// Callback function
		'post',									// Admin page (or post type)
		'side',									// Context
		'low'									// Priority
	);
	add_meta_box(
		'light-featured-image-meta',			// Unique ID
		esc_html__( 'Thumbnail Meta', 'light' ),// Title
		'light_featured_meta_meta_box',			// Callback function
		'page',									// Admin page (or post type)
		'side',									// Context
		'low'									// Priority
	);
}

/* Display the post meta box. */
function light_featured_meta_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'light_featured_meta_nonce' ); ?>
	<p>
		<?php $light_featured_meta = esc_attr( get_post_meta( $object->ID, 'light_featured_meta', true ) ); ?>
		<label for="light-featured-image-meta" ><input name="light-featured-image-meta" type="checkbox" id="light-featured-image-meta"<?php if ($light_featured_meta) { echo ' checked="checked"'; } ?>> <?php _e( "Use full-width thumbnail banner", 'light' ); ?></label>
	</p>
<?php }

/* Meta box setup function. */
function light_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'light_add_post_meta_boxes' );
	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'light_save_post_class_meta', 10, 2 );
}

/* Save the meta box's post metadata. */
function light_save_post_class_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['light_featured_meta_nonce'] ) || !wp_verify_nonce( $_POST['light_featured_meta_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['light-featured-image-meta'] ) ? sanitize_html_class( $_POST['light-featured-image-meta'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'light_featured_meta';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}
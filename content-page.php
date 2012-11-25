<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Light
 * @since Light 1.0
 */
?>

<?php
	$custom_post_class = null;
	$thumbnail_class = false;
	$light_featured_meta = esc_attr( get_post_meta( $post->ID, 'light_featured_meta', true ) );
	if ( has_post_thumbnail() ) {
		if ( $light_featured_meta ) {
			$thumbnail_class = "header-thumbnail";
		} else {
			$thumbnail_class = "sidecar-thumbnail";
		}
		$custom_post_class = "thumbnail " . $thumbnail_class;
	}	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($custom_post_class); ?>>
	
	<header class="entry-header clearfix">
		<?php if ( !$light_featured_meta ) { ?>
			<div class="header-padding">
		<?php } ?>
		<?php if ( $thumbnail_class ) { ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $thumbnail_class ); ?>
			</div>
		<?php } ?>
		<?php if ( $light_featured_meta ) { ?>
			<div class="header-padding">
		<?php } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'light' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php if ( current_user_can('edit_posts') ) { ?>
	<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'light' ), '<span class="icon edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

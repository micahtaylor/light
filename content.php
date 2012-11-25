<?php
/**
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
			<a class="header-padding" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'light' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
		<?php } ?>
		<?php if ( $thumbnail_class ) { ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $thumbnail_class ); ?>
			</div>
		<?php } ?>
		<?php if ( $light_featured_meta ) { ?>
			<a class="header-padding" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'light' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
		<?php } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<span><?php light_posted_on(); ?></span>
		</a>
	</header><!-- .entry-header -->
	
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'light' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'light' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	<footer class="entry-meta">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="icon comments-link"><?php comments_popup_link( __( '<span>Comment</span>', 'light' ), __( '1 <span>Comment</span>', 'light' ), __( ' % <span>Comments</span>', 'light' ) ); ?></span>
		<?php endif; ?>
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'light' ) );
				if ( $categories_list && light_categorized_blog() ) :
			?>
			<span class="sep"> | </span>
			<span class="icon cat-links">
				<?php printf( __( '<span>Posted in</span> %1$s', 'light' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'light' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="icon tag-links">
				<?php printf( __( '<span>Tagged</span> %1$s', 'light' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'light' ), '<span class="sep"> | </span><span class="icon edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

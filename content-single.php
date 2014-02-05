<?php
/**
 * @package GovFreshWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php govfreshwp_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'govfreshwp' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries ?>
		<div class="author-meta clear">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'govfreshwp_author_bio_avatar_size', 75 ) ); ?>
			</div><!-- #author-avatar -->
			<div class="author-description">
				<h3><?php printf( esc_attr__( 'About %s', 'govfreshwp' ), get_the_author() ); ?></h3>
				<?php the_author_meta( 'description' ); ?>
			</div><!-- #author-description -->
		</div><!-- #author-meta-->
	<?php endif; ?>

	<footer class="entry-meta">
		<ul class="entry-meta-taxonomy">
			<?php echo get_the_category_list('<li>','</li><li>','</li>'); ?>
			<?php echo get_the_tag_list('<li>','</li><li>','</li>'); ?>
			<?php edit_post_link( __( 'Edit', 'govfreshwp' ), '<li class="edit-link">', '</li>' ); ?>
		</ul>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

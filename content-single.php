<?php
/**
 * @package GovPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php govpress_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'govpress' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries ?>
		<div class="author-meta clear">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'govpress_author_bio_avatar_size', 75 ) ); ?>
			</div><!-- #author-avatar -->
			<div class="author-description">
				<h3><?php printf( esc_attr__( 'About %s', 'govpress' ), get_the_author() ); ?></h3>
				<?php the_author_meta( 'description' ); ?>
			</div><!-- #author-description -->
		</div><!-- #author-meta-->
	<?php endif; ?>

	<footer class="entry-meta">
		<ul class="entry-meta-taxonomy">
			<?php
				$categories =  wp_get_post_categories( get_the_ID() );
				foreach ( $categories as $category ) {
					$cat = get_category( $category );
					echo '<li class="category-link"><a href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->name . '</a></li>';
				}
			?>
			<?php echo get_the_tag_list('<li class="tag-link">','</li><li>','</li>'); ?>
			<?php edit_post_link( __( 'Edit', 'govpress' ), '<li class="edit-link">', '</li>' ); ?>
		</ul>
	</footer><!-- .entry-meta -->
</article><!-- #post-# -->

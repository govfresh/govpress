<?php
/**
 * @package GovPress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php govpress_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'govpress' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'govpress' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<ul class="entry-meta-taxonomy">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php echo get_the_category_list('<li>','</li><li>','</li>'); ?>
			<?php echo get_the_tag_list('<li>','</li><li>','</li>'); ?>
		<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<li class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'govpress' ), __( '1 Comment', 'govpress' ), __( '% Comments', 'govpress' ) ); ?></li>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'govpress' ), '<li class="edit-link">', '</li>' ); ?>
		</ul>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->

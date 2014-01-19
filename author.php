<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<?php
				if( isset($_GET['author_name']) ) :
					$curauth = get_userdatabylogin( $author_name );
				else :
					$curauth = get_userdata( intval($author) );
				endif;
			?>

			<div class="col-md-12">
				<h1><?php echo $curauth->display_name; ?></h1>

			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<div class="row authorpage-bio">

					<div class="col-md-3">

						<div class="authorpage-avatar">
							<?php echo get_avatar( $curauth->user_email, '150' ); ?>
						</div>

					</div>

					<div class="col-md-9">

						<p><?php echo $curauth->user_description; ?></p>

					</div>

				</div>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="row post">

					<div class="col-md-12">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p class="byline"><?php echo govfresh_publish_link(); ?> &middot; <?php the_time('g:i a') ?></p>

					</div>

				</div>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<?php if(function_exists('wp_pagenavi')) { ?>
				<?php wp_pagenavi(); ?>
				<?php } else { ?>
				<div class="navigation"><p><?php posts_nav_link('&#8734;','&laquo;&laquo; Newer','Older &raquo;&raquo;'); ?></p></div>
				<?php } ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>

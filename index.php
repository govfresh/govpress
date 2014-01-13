
<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-8">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="row post">

					<div class="col-xs-4 col-md-3">

						<?php if ( has_post_thumbnail()) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'thumbnail' , array('alt' => '' , 'title' => '')); ?>
							</a>
						</div>
						<?php endif; ?>

					</div>

					<div class="col-xs-8 col-md-9">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p class="byline"><?php echo my_entry_published_link(); ?> &middot; <?php the_time('g:i a') ?></p>
						<?php the_excerpt(); ?> 

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
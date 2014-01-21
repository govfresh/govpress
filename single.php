<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<div class="row">

					<div class="col-md-12">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<p class="byline">By <?php the_author_posts_link(); ?> &middot; <?php the_time('l') ?>, <?php echo govfresh_publish_link(); ?> &middot; <?php the_time('g:i a') ?></p>

						<?php the_content(); ?>

						<p><?php wp_link_pages('parameters'); ?></p>

					</div>

				</div>

				<div class="row">

					<div class="col-md-12">

						<div class="author-bio">

							<div class="row">

								<div class="col-md-2">
									<?php echo get_avatar( get_the_author_id() , 75 ); ?>
								</div>

								<div class="col-md-10">
									<p><?php echo $twtr; ?>
									<?php if ( get_the_author_meta('facebook') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('facebook'); ?>" ><i class="fa fa-facebook fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('twitter') ): ?>
									<div class="icons-author">
									<a href="https://twitter.com/<?php the_author_meta('twitter'); ?>" ><i class="fa fa-twitter fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('googleplus') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('googleplus'); ?>" ><i class="fa fa-google-plus fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('linkedin') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('linkedin'); ?>" ><i class="fa fa-linkedin fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('instagram') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('instagram'); ?>" ><i class="fa fa-instagram fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('flickr') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('flickr'); ?>" ><i class="fa fa-flickr fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('tumblr') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('tumblr'); ?>" ><i class="fa fa-tumblr fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<?php echo $twtr; ?>
									<?php if ( get_the_author_meta('github') ): ?>
									<div class="icons-author">
									<a href="<?php the_author_meta('github'); ?>" ><i class="fa fa-github fa-2x"></i></a>
									</div>
									<?php else: endif; ?>
									<div class="icons-author">
									<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>feed" ><i class="fa fa-rss fa-2x"></i></a>
									</div>
									</p>
									<p><?php the_author_description(); ?></p>
								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="post-meta">
					<ul>
						<li><?php the_category(' '); ?> <?php the_tags(' ',' '); ?></li>
					</ul>
				</div>

				<?php comments_template('', true); ?>

				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'govfreshwp' ); ?></p>
				<?php endif; ?>

			</div>

				<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>

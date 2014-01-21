
<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-3">

				<div class="">
					<?php
					$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
					if ($children) { ?>
					<div class="widget">
						<h3><?php _e( 'Related', 'govfreshwp' ); ?></h3>
						<ul>
						<?php echo $children; ?>
						</ul>
					</div>
					<?php } ?>
				</div>

			</div>

			<div class="col-md-9">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

				<?php comments_template('', true); ?>

				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'govfreshwp' ); ?></p>
				<?php endif; ?>

				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div class="breadcrumb">','</div>');
					} ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>

<?php
/*
Template Name: Search
*/
?>

<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">

				<div class="search-result">
					<?php 
						$message="";

						if(get_search_query()!='')
							$query = get_search_query();
						else $query = $message;

					?>
					<form role="search" method="get" class="navbar-form searchform" action="<?php echo home_url( '/' ); ?>">
						<div class="form-group">
						<input type="text" class="form-control input-lg" value="<?php echo $query; ?>" name="s" id="s" onblur='javascript:if (this.value == "") {this.value = "<?php echo $query; ?>";}' onfocus='javascript:if (this.value == "<?php echo $query; ?>") {this.value = "";}' />
						</div>
						<input type="submit" class="btn btn-default btn-lg" id="searchsubmit" value="&#xf002;" />
					</form>
				</div>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

				<?php comments_template('', true); ?>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</div>

			<div class="col-md-3">

				<div class="">
					<?php
					$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
					if ($children) { ?>
					<div class="widget">
						<h3>Related</h3>
						<ul>
						<?php echo $children; ?>
						</ul>
					</div>
					<?php } ?>
				</div>

			</div>

		</div>

	</div>

		<div class="copyright">
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<p><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &middot; <a href="/sitemap">Sitemap</a> &middot; <a href="http://wp.govfresh.com">GovFresh WP Theme</a></p>
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer text') ) ?>
					</div>
				</div>

			</div>

		</div>

	<?php wp_footer(); ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/dist/js/bootstrap.min.js"></script>

</body>

</html>
<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package GovPress
 */
?>
	<div id="secondary" class="widget-area" role="complementary">

		<aside class="widget widget_pages">
			<h3 class="widget-title"><?php _e( 'Pages', 'govpress' ); ?></h1>
			<ul>
				<?php wp_list_pages( array(
					'title_li' => '',
					'child_of' => get_the_ID(),
				) ); ?>
			</ul>
		</aside>

	</div><!-- #secondary -->
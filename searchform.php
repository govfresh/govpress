<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'govfresh' ); ?></span>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="<?php _e( 'Search for:', 'govfresh' ); ?>" />
	</label>
	<input type="submit" class="fa search-submit" value="&#xf002;" />
</form>
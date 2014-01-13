
<?php 
	$message="";

	if(get_search_query()!='')
		$query = get_search_query();
	else $query = $message;

?>

<form role="search" method="get" class="navbar-form searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
	<input type="text" class="form-control" value="<?php echo $query; ?>" name="s" id="s" onblur='javascript:if (this.value == "") {this.value = "<?php echo $query; ?>";}' onfocus='javascript:if (this.value == "<?php echo $query; ?>") {this.value = "";}' />
	</div>
	<input type="submit" class="btn btn-default" id="searchsubmit" value="&#xf002;" />
</form>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

	<title><?php bloginfo('name'); ?> - <?php bloginfo('description');?></title>

    <!-- Bootstrap core CSS -->

	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link href="<?php bloginfo('url'); ?>/wp-content/themes/govfreshwp/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/govfreshwp/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<nav class="navbar navbar-default navbar-static-top" role="navigation">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	        </div>

			<?php
			    wp_nav_menu( array(
			        'menu'              => 'primary',
			        'theme_location'    => 'primary',
			        'depth'             => 2,
			        'container'         => 'div',
			        'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
			        'menu_class'        => 'nav navbar-nav',
			        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			        'walker'            => new wp_bootstrap_navwalker())
			    );
			?>

	    </div>
	</nav>
	
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a>
				</div>
			</div>
		</div>
	</div>

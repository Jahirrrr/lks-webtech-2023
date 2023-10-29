<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php bloginfo( 'description' ) ?>" />

		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		<?php wp_head(); ?>

		<meta name="viewport" content="width=device-width">
			
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/css/reset.css" media="screen"  />  <!-- css para eliminar os estilos pré-definidos -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/css/960.css" /> <!-- 960 grid system -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/css/typography.css" /> <!-- tipografia -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/css/blog.css" /> <!-- estilos -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

		<script src="js/login.js"></script>


	</head>



	<body <?php body_class(); ?>>

		<div id="wrapper" class="hfeed">

			<header>
				<div class="navtop">
					<div class="container_12 col_12 full">
						<div class="grid_12">
							<nav>
								<h1>
									<span class="grid_5 tagline">Portal COVID 19 di Indonesia</span>
								</h1>	
							</nav>
						</div>
					</div>
				</div>				
				<div class="clear"></div>

				<div class="header_blog">
					<div class="container_12 col_12 full">	

						<div class="grid_3 suffix_5 blogtitle"> 
							<h2><a href="<?php bloginfo('url'); ?>">Covids</a> </h2>
						</div>
						<div class="grid_4 omega"> 
							<div id="search">
							<?php get_search_form(); ?>
							</div> 
						</div>	

					</div>
				</div>							
				<div class="clear"></div>

			</header>

		<div id="container">



<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php bloginfo( 'description' ) ?>" />

		<title><?php wp_title(' | ', true, 'right'); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		<?php wp_head(); ?>

		<meta name="viewport" content="width=device-width">
			
		<link rel="stylesheet" type="text/css" href="css/reset.css" />  <!-- css para eliminar os estilos pré-definidos -->
		<link rel="stylesheet" type="text/css" href="css/960.css" /> <!-- 960 grid system -->
		<link rel="stylesheet" type="text/css" href="css/styles.css" /> <!-- estilos -->
		<link rel="stylesheet" type="text/css" href="css/typography.css" /> <!-- tipografia -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

		<script src="js/login.js"></script>

			<!--[if IE 8]>
				
				<link rel="stylesheet" type="text/css" href="css/ie8.css" />
			<![endif]-->
			
			<!-- excepção para renderização de elementos com gradientes no IE -->
			
			<!--[if gte IE 9]>
			<style type="text/css">
					.gradient {
					   filter: none;
					}
			</style>
			<![endif]-->


	</head>



	<body <?php body_class(); ?>>

		<div id="wrapper" class="hfeed">

			<header>
			
				<nav>
					<div id="search">
					<?php get_search_form(); ?>
					
				</nav>

			</header>

		<div id="container">
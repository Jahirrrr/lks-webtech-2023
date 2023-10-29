<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon">
	<title><?php wp_title(' | ', true, 'right'); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
		<hgroup id="branding">
			<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ) ?></h2>
		</hgroup>
		<nav id="meta-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ) ?>
		</nav>
		<nav id="main-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ) ?>
		</nav>
	</header>
	<div id="container" class="hfeed">

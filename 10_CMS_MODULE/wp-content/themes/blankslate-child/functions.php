<?php
function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/css/style.css' );
wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri(). '/bootstrap/css/bootstrap.min.css');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/scripts/jquery.js');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/bootstrap/js/bootstrap.min.js');
wp_enqueue_script('perso-js', get_stylesheet_directory_uri(). '/scripts/scripts.js');
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles');
?>

<?php
add_filter( 'query_vars', 'willy_add_query_vars' );
function willy_add_query_vars( $vars ){
	$vars[] = "ville";
	$vars[] = "chambres";
	$vars[] = "quartiers";
	$vars[] = "prix-maxi";
	$vars[] = "equipements";
	return $vars;
}

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<a class="btn btn-warning btn-lg" href="#myModal1" data-toggle="modal">Connexion</a>

<!-- Modal -->
<div id="myModal1" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                    <h4 class="modal-title">My Title in a Modal Window</h4>
            </div>
            <div class="modal-body">
              <?php wp_login_form( $args );
                  $args = array(
                  		'echo'           => true,
                  		'remember'       => true,
                  		'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                  		'form_id'        => 'loginform',
                  		'id_username'    => 'user_login',
                  		'id_password'    => 'user_pass',
                  		'id_remember'    => 'rememberme',
                  		'id_submit'      => 'wp-submit',
                  		'label_username' => __( 'Username' ),
                  		'label_password' => __( 'Password' ),
                  		'label_remember' => __( 'Remember Me' ),
                  		'label_log_in'   => __( 'Log In' ),
                  		'value_username' => '',
                  		'value_remember' => false
                  		);
                  ?>
                </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<section id="branding">
<div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
</section>

</header>
<div id="container">

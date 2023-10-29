<?php
/* ==========================
 * Theme actions and filters
 * =========================*/

/**
 * Register theme and set up basic theme functionality
 */
function forme_setup() {
	load_theme_textdomain( 'forme', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_editor_style();
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 977;

	register_nav_menus( array(
		'main-menu' => __( 'Main Menu', 'forme' ),
		'header-menu' => __( 'Header Menu', 'forme' ),
		'footer-menu' => __( 'Footer Menu', 'forme' )
	) );
	
	if ( ! is_admin() ) {
		// Get theme for access to theme version number
		$theme = wp_get_theme( get_stylesheet() );
		
		// Theme CSS
		wp_enqueue_style(
			'forme',
			get_stylesheet_uri(),
			false,
			$theme->get( 'Version' )
		);
		
		// Theme JS (final 'true' parameter makes it be loaded in the footer)
		wp_enqueue_script(
			'global',
			get_template_directory_uri() . '/js/global.js',
			array( 'jquery' ),
			$theme->get( 'Version' ),
			true
		);
	
		// HTML5 JS for adding HTML5 support to IE < 9 (has to be added to wp_head action because conditional comments are not supported with WP_Scripts class)
		add_action( 'wp_head', function() {
			echo '<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
		} );
	}
}
add_action('after_setup_theme', 'forme_setup');

function forme_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'comment_form_before', 'forme_enqueue_comment_reply_script' );

function forme_title($title) {
	if ( $title == '' ) {
		return 'Untitled';
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'forme_title' );

function forme_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'wp_title', 'forme_filter_wp_title' );

function forme_comment_form_defaults( $args ) {
	$req = get_option( 'require_name_email' );
	$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'forme' ), '<span class="required">*</span>' );
	$args['comment_notes_before'] = '<p class="comment-notes">' . __( 'Your email is kept private.', 'forme' ) . ( $req ? $required_text : '' ) . '</p>';
	$args['title_reply'] = __( 'Post a Comment', 'forme' );
	$args['title_reply_to'] = __( 'Post a Reply to %s', 'forme' );
	return $args;
}
add_filter( 'comment_form_defaults', 'forme_comment_form_defaults' );

function forme_add_shortcodes() {
	add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
	add_shortcode('caption', 'fixed_img_caption_shortcode');
	add_filter('img_caption_shortcode', 'forme_img_caption_shortcode_filter',10,3);
	add_filter('widget_text', 'do_shortcode');
}
add_action( 'init', 'forme_add_shortcodes' );

function forme_img_caption_shortcode_filter( $val, $attr, $content = null ) {
	extract( shortcode_atts( array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr ) );
	if ( 1 > (int) $width || empty( $caption ) )
		return $val;
	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}
	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
	     . (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
	     . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

function forme_widgets_init() {
	register_sidebar( array (
		'name' => __('Sidebar Widget Area', 'forme'),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'forme_widgets_init' );
/*
$preset_widgets = array (
	'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
*/

/* ==========================
 * Template tags
 * =========================*/

/**
 * Prints (or returns) a link to the post with its title as the default link text (overwritable)
 *
 * @param int $post_id (optional) The post id (or post object) to check
 * @param string $link_text (optional) The text to use for the link
 * @param bool $echo (optional) Whether to echo or return the generated HTML
 * @return void
 * @since Forme 0.57
 */
function forme_the_post_link( $post_id = false, $link_text = '', $echo = true ) {
	if ( is_object( $post_id ) && is_int( $post_id->ID ) )
		$post_id = $post_id->ID;
	elseif ( ! $post_id )
		$post_id = get_the_ID();
	
	if ( is_null( $post_id ) )
		return false;
	
	$the_title = get_the_title( $post_id );
	$the_title_attribute = esc_attr( strip_tags( $the_title ) );
	if ( ! $link_text )
		$link_text = $the_title;
	
	$link_element = '<a href="' . get_permalink( $post_id ) . '" title="' . sprintf( __( 'Read %s', 'forme' ), $the_title_attribute ) . '" rel="bookmark">' . $link_text . '</a>';

	if ( ! $echo )
		return $link_element;

	echo $link_element;
}

function forme_get_page_number() {
	if ( get_query_var( 'paged' ) ) {
		print ' | ' . __( 'Page ' , 'forme' ) . get_query_var( 'paged' );
	}
}

function forme_catz( $glue ) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list( $separator ) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset( $cats[$i] );
			break;
		}
	}
	if ( empty( $cats ) )
		return false;
	
	return trim( join( $glue, $cats ) );
}

function forme_tag_it( $glue ) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( '', "$separator", '' ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset( $tags[$i] );
			break;
		}
	}
	if ( empty( $tags ) )
		return false;

	return trim( join( $glue, $tags ) );
}

function forme_commenter_link() {
	$commenter = get_comment_author_link();
	if ( preg_match( '/<a[^>]* class=[^>]+>/', $commenter ) ) {
		$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
	} else {
		$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}

function forme_custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
		<div class="comment-author vcard"><?php forme_commenter_link() ?></div>
		<div class="comment-meta">
			<?php printf( __( 'Posted %1$s at %2$s', 'forme' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e( 'Permalink to this comment', 'forme' ); ?>"><?php _e( 'Permalink', 'forme' ); ?></a>
			<?php edit_comment_link(__( 'Edit', 'forme' ), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
		<span class="unapproved">
			<?php _e( 'Your comment is awaiting moderation.', 'forme' ) ?>
		</span>
		<?php endif; ?>
		<div class="comment-content">
			<?php comment_text() ?>
		</div>
		<?php
		if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
			comment_reply_link( array_merge( $args, array(
				'reply_text' => __( 'Reply','forme' ),
				'login_text' => __( 'Login to reply.', 'forme' ),
				'depth' => $depth,
				'before' => '<div class="comment-reply-link">',
				'after' => '</div>'
			) ) );
		endif;
		?>
<?php
}

function forme_custom_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
		<div class="comment-author">
		<?php
		printf( __( 'By %1$s on %2$s at %3$s', 'forme' ),
			get_comment_author_link(),
			get_comment_date(),
			get_comment_time()
		);
		edit_comment_link( __( 'Edit', 'forme' ), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>' );
		?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span class="unapproved"><?php _e( 'Your trackback is awaiting moderation.', 'forme' ) ?></span>
		<?php endif; ?>
		<div class="comment-content">
			<?php comment_text() ?>
		</div>
<?php
}

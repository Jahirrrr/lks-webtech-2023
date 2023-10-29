<?php
/**
 * Plugin Name: BM Custom Login
 * Plugin URI: http://wordpress.org/plugins/bm-custom-login/
 * Description: Display custom images on the WordPress login screen. Useful for branding.
 * Author: Ben Gillbanks
 * Version: 2.3.2
 * Author URI: http://prothemedesign.com/
 * License: GPLv2 or later
 * Text Domain: bm-custom-login
 *
 * @package bm-custom-login
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

define( 'CL_GROUP', 'custom_login' );
define( 'CL_PAGE', 'custom_login_admin' );
define( 'CL_SECTION', 'custom_login_section' );
define( 'CL_OPTIONS', 'custom_login_options' );


if ( ! class_exists( 'BMCustomLogin' ) ) {

	/**
	 * Allow a user to customize their WordPress login page
	 */
	class BMCustomLogin {

		/**
		 * Stores the database options to reduce calls to get_options
		 *
		 * @var array
		 */
		private $options = array();

		/**
		 * Setup the object
		 */
		public function __construct() {

			load_plugin_textdomain( 'bm-custom-login', false, basename( dirname( __FILE__ ) ) . '/languages/' );

			add_action( 'admin_init', array( $this, 'custom_login_init' ) );
			add_action( 'admin_menu', array( $this, 'custom_login_admin_add_page' ) );
			add_action( 'login_head', array( $this, 'custom_login' ) );
			add_filter( 'login_headerurl', array( $this, 'custom_login_url' ) );
			add_action( 'login_footer', array( $this, 'custom_login_title_display' ) );
			add_filter( 'login_headertext', array( $this, 'custom_login_title' ) );
			add_filter( 'admin_footer_text', array( $this, 'custom_login_admin_footer_text' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_color_picker' ) );
			add_action( 'admin_footer', array( $this, 'admin_foot_script' ) );

		}


		/**
		 * Get the login options
		 *
		 * @return array
		 */
		public function custom_login_get_options() {

			if ( empty( $this->options ) ) {

				$this->options = get_option( CL_OPTIONS );

				if ( empty( $this->options ) ) {
					$saved_options = get_option( CL_OPTIONS );
					// Ensure that the options array is populated with default values.
					$this->options = wp_parse_args(
						$saved_options,
						array(
							'cl_background'       => '',
							'cl_color'            => '',
							'cl_backgroundColor'  => '',
							'cl_backgroundImage'  => '',
							'cl_backgroundPX'     => '',
							'cl_backgroundPY'     => '',
							'cl_backgroundRepeat' => '',
							'cl_linkColor'        => '',
							'cl_colorShadow'      => '',
							'cl_customCSS'        => '',
							'cl_powerby'          => '',
							'cl_footertext'       => '',
						)
					);
				}
			}

			return $this->options;

		}


		/**
		 * Display the custom login info
		 */
		public function custom_login() {

			$options = $this->custom_login_get_options();

			$plugin_url = plugin_dir_url( __FILE__ ) . 'bm-custom-login.css';

			// Output styles.
			echo '<link rel="stylesheet" type="text/css" href="' . esc_url( $plugin_url ) . '" />';
			echo '<style>';

			$background = $options['cl_background'];

			if ( ! empty( $background ) ) {
?>
			#login {
				background:url(<?php echo esc_url( $background ); ?>) top center no-repeat;
			}
<?php
			}

			// Text colour.
			if ( ! empty( $options['cl_color'] ) ) {
?>
			#login,
			#login label {
				color:<?php echo $this->sanitize_hex_color( $options['cl_color'] ); ?>;
			}
<?php
			}

			$body_styles = array();

			// Background colour.
			if ( ! empty( $options['cl_backgroundColor'] ) ) {
				$body_styles[] = $this->sanitize_hex_color( $options['cl_backgroundColor'] );
			}

			if ( ! empty( $options['cl_backgroundImage'] ) ) {
				$body_styles[] = 'url(' . esc_url( $options['cl_backgroundImage'] ) . ')';

				if ( ! empty( $options['cl_backgroundPX'] ) ) {
					$body_styles[] = esc_attr( $options['cl_backgroundPX'] );
				}

				if ( ! empty( $options['cl_backgroundPY'] ) ) {
					$body_styles[] = esc_attr( $options['cl_backgroundPY'] );
				}

				if ( ! empty( $options['cl_backgroundRepeat'] ) ) {
					$body_styles[] = esc_attr( $options['cl_backgroundRepeat'] );
				}
			}

			if ( count( $body_styles ) ) {
?>
			html {
				background:<?php echo implode( ' ', $body_styles ); ?> !important;
			}
			body.login {
				background:transparent !important;
			}
<?php
			}

			// Text colour.
			if ( ! empty( $options['cl_linkColor'] ) ) {
?>
			.login #login a {
				color:<?php echo $this->sanitize_hex_color( $options['cl_linkColor'] ); ?> !important;
			}
			.login #login a:hover {
				color:<?php echo $this->adjust_brightness( $options['cl_linkColor'], -30 ); ?> !important;
			}
			.submit #wp-submit {
				background:<?php echo $this->sanitize_hex_color( $options['cl_linkColor'] ); ?>;
				border-color:<?php echo $this->adjust_brightness( $options['cl_linkColor'], -60 ); ?>;
				color:<?php echo $this->readable_colour( $options['cl_linkColor'] ); ?>
			}
			.submit #wp-submit:hover {
				background:<?php echo $this->adjust_brightness( $options['cl_linkColor'], -30 ); ?>;
			}
<?php
			}

			if ( ! empty( $options['cl_colorShadow'] ) ) {
?>
			#login #nav,
			#login #backtoblog {
				text-shadow:0 1px 6px <?php echo $this->sanitize_hex_color( $options['cl_colorShadow'] ); ?>;
			}
<?php
			}

			// Custom CSS.
			if ( ! empty( $options['cl_customCSS'] ) ) {
				$css = $this->sanitize_css( $options['cl_customCSS'] );
				echo str_replace( array( "\n", "\r", "\t" ), '', $css );
			}

			echo '</style>';

		}


		/**
		 * Sanitize user entered CSS
		 * as seen here: http://wordpress.stackexchange.com/questions/53970/sanitize-user-entered-css
		 *
		 * @param string $css A block of CSS to tidy up.
		 */
		public function sanitize_css( $css ) {

			if ( ! class_exists( 'csstidy' ) ) {
				include_once 'csstidy/class.csstidy.php';
			}

			$csstidy = new csstidy();
			$csstidy->set_cfg( 'remove_bslash', false );
			$csstidy->set_cfg( 'compress_colors', false );
			$csstidy->set_cfg( 'compress_font-weight', false );
			$csstidy->set_cfg( 'discard_invalid_properties', true );
			$csstidy->set_cfg( 'merge_selectors', false );
			$csstidy->set_cfg( 'remove_last_;', false );
			$csstidy->set_cfg( 'css_level', 'CSS3.0' );

			$css = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $css );
			$css = wp_kses_split( $css, array(), array() );

			$csstidy->parse( $css );

			return $csstidy->print->plain();

		}


		/**
		 * Replace the login url with the website homepage.
		 *
		 * @param string $url The current login url.
		 * @return string The new login url.
		 */
		public function custom_login_url( $url ) {

			return get_home_url();

		}


		/**
		 * Replace the header link text message with one of the users choosing.
		 *
		 * @param string $title Powered by message in the site footer.
		 * @return string The new powered by message.
		 */
		public function custom_login_title( $title = '' ) {

			$options = $this->custom_login_get_options();

			if ( ! empty( $options['cl_powerby'] ) ) {
				$title = $options['cl_powerby'];
			}

			return esc_html( $title );

		}


		/**
		 * Display the powered by title.
		 *
		 * @return void
		 */
		public function custom_login_title_display() {

			$title = $this->custom_login_title();

			if ( empty( $title ) ) {
				return;
			}

			echo '<p class="cl-powered-by" aria-hidden="true">' . esc_html( $title ) . '</p>';

		}


		/**
		 * Change admin footer text.
		 *
		 * @param string $old_text Old footer text.
		 * @return string New footer text to replace old text with.
		 */
		public function custom_login_admin_footer_text( $old_text ) {

			$options = $this->custom_login_get_options();

			if ( ! empty( $options['cl_footertext'] ) ) {
				return esc_html( $options['cl_footertext'] );
			}

			return wp_kses_post( $old_text );

		}


		/**
		 * Add custom login form page.
		 */
		public function custom_login_admin_add_page() {

			add_options_page( 'BM Custom Login', 'Custom Login', 'manage_options', CL_PAGE, array( $this, 'custom_login_options' ) );

		}


		/**
		 * Display Custom Login form.
		 */
		public function custom_login_options() {
?>
		<style>
			.wrap {
				position:relative;
			}

			.cl_notice {
				padding:10px 20px;
				-moz-border-radius:3px;
				-webkit-border-radius:3px;
				border-radius:3px;
				background:lightyellow;
				border:1px solid #e6db55;
				margin:10px 5px 10px 0;
			}

			.cl_notice h3 {
				margin-top:5px;
				padding-top:0;
			}

			.cl_notice li {
				list-style-type:disc;
				margin-left:20px;
			}
		</style>

		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br /></div>
			<h2><?php esc_html_e( 'Custom Login Options', 'bm-custom-login' ); ?></h2>

			<form action="options.php" method="post">
<?php
			settings_fields( CL_GROUP );
			do_settings_sections( CL_PAGE );
			submit_button( esc_html__( 'Save Changes', 'bm-custom-login' ) );
?>
			</form>

			<div class="cl_notice">
				<h3>More WordPress Goodies &rsaquo;</h3>
				<p>If you like this plugin then you may also like my themes on <a href="http://prothemedesign.com" target="_blank">Pro Theme Design</a></p>
				<ul>
					<li><a href="http://twitter.com/prothemedesign">Pro Theme Design on Twitter</a></li>
					<li><a href="http://facebook.com/ProThemeDesign">Pro Theme Design on Facebook</a></li>
				</ul>
			</div>

		</div>

<?php
		}


		/**
		 * Initialise login options.
		 */
		public function custom_login_init() {

			$vars = $this->custom_login_get_options();

			register_setting(
				CL_GROUP,
				CL_OPTIONS,
				array( $this, 'custom_login_validate' )
			);

			add_settings_section(
				CL_SECTION,
				__( 'Login Screen Settings', 'bm-custom-login' ),
				array( $this, 'custom_login_section_validate' ),
				CL_PAGE
			);

			add_settings_field(
				'cl_background',
				__( 'Background Image Url:', 'bm-custom-login' ),
				array( $this, 'form_image' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_background',
					'value' => $vars,
					'default' => '',
					'description' => __( 'Ideal size is 312 by 600', 'bm-custom-login' ),
				)
			);

			add_settings_field(
				'cl_powerby',
				__( 'Custom Login Powered by:', 'bm-custom-login' ),
				array( $this, 'form_text' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_powerby',
					'value' => $vars,
					'default' => '',
					'description' => '',
				)
			);

			add_settings_field(
				'cl_footertext',
				__( 'WordPress footer text:', 'bm-custom-login' ),
				array( $this, 'form_text' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_footertext',
					'value' => $vars,
					'default' => '',
					'description' => __( 'Appears at the bottom of the admin pages when logged in.', 'bm-custom-login' ),
				)
			);

			add_settings_field(
				'cl_backgroundColor',
				__( 'Page Background Color:', 'bm-custom-login' ),
				array( $this, 'form_color' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_backgroundColor',
					'value' => $vars,
					'default' => 'eeeeee',
				)
			);

			add_settings_field(
				'cl_backgroundImage',
				__( 'Page Background Image:', 'bm-custom-login' ),
				array( $this, 'form_image' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_backgroundImage',
					'value' => $vars,
					'default' => '',
					'description' => '',
				)
			);

			add_settings_field(
				'cl_backgroundPY',
				__( 'Page Background Vertical Position:', 'bm-custom-login' ),
				array( $this, 'form_select' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_backgroundPY',
					'value' => $vars,
					'default' => 'top',
					'options' => array( 'top', 'center', 'bottom' ),
					'description' => __( 'Vertical  position of background element', 'bm-custom-login' ),
				)
			);

			add_settings_field(
				'cl_backgroundPX',
				__( 'Page Background Horizontal Position:', 'bm-custom-login' ),
				array( $this, 'form_select' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_backgroundPX',
					'value' => $vars,
					'default' => 'center',
					'options' => array( 'left', 'center', 'right' ),
					'description' => __( 'Horizontal position of background element', 'bm-custom-login' ),
				)
			);

			add_settings_field(
				'cl_backgroundPRepeat',
				__( 'Page Background Repeat:', 'bm-custom-login' ),
				array( $this, 'form_select' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_backgroundRepeat',
					'value' => $vars,
					'default' => 'no-repeat',
					'options' => array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ),
					'description' => __( 'Background image repeat', 'bm-custom-login' ),
				)
			);

			add_settings_field(
				'cl_color',
				__( 'Text Color:', 'bm-custom-login' ),
				array( $this, 'form_color' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_color',
					'value' => $vars,
					'default' => '333333',
				)
			);

			add_settings_field(
				'cl_colorShadow',
				__( 'Text Shadow Color:', 'bm-custom-login' ),
				array( $this, 'form_color' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_colorShadow',
					'value' => $vars,
					'default' => '000000',
				)
			);

			add_settings_field(
				'cl_linkColor',
				__( 'Text Link and Button Background Color:', 'bm-custom-login' ),
				array( $this, 'form_color' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_linkColor',
					'value' => $vars,
					'default' => '21759B',
				)
			);

			add_settings_field(
				'cl_customCSS',
				__( 'Additional CSS:', 'bm-custom-login' ),
				array( $this, 'form_textarea' ),
				CL_PAGE,
				CL_SECTION,
				array(
					'id' => 'cl_customCSS',
					'value' => $vars,
					'default' => '',
					'description' => '',
				)
			);

		}


		/**
		 * Validate login form elements.
		 *
		 * @param array $fields Fields to validate.
		 * @return array
		 */
		public function custom_login_validate( $fields ) {

			// Colour validation.
			$fields['cl_color'] = $this->sanitize_hex_color( $fields['cl_color'] );
			$fields['cl_colorShadow'] = $this->sanitize_hex_color( $fields['cl_colorShadow'] );
			$fields['cl_linkColor'] = $this->sanitize_hex_color( $fields['cl_linkColor'] );
			$fields['cl_background'] = esc_url_raw( $fields['cl_background'] );
			$fields['cl_backgroundColor'] = $this->sanitize_hex_color( $fields['cl_backgroundColor'] );
			$fields['cl_backgroundPY'] = $fields['cl_backgroundPY'];
			$fields['cl_backgroundPX'] = $fields['cl_backgroundPX'];
			$fields['cl_backgroundRepeat'] = $fields['cl_backgroundRepeat'];
			$fields['cl_backgroundImage'] = esc_url_raw( $fields['cl_backgroundImage'] );
			$fields['cl_powerby'] = wp_strip_all_tags( esc_html( $fields['cl_powerby'] ) );
			$fields['cl_customCSS'] = $this->sanitize_css( $fields['cl_customCSS'] );

			return $fields;

		}


		/**
		 * Validate login section properties
		 *
		 * @param array $fields Fields to validate. Needs some validation code.
		 * @return array
		 */
		public function custom_login_section_validate( $fields ) {

			return $fields;

		}


		/**
		 * Display a text input form element.
		 *
		 * @param array $args Text input settings.
		 */
		public function form_text( $args ) {

			$id = '';
			$value = '';

			// Set values.
			if ( ! empty( $args['value'][ $args['id'] ] ) ) {
				$value = $args['value'][ $args['id'] ];
			} else {
				if ( ! empty( $args['default'] ) ) {
					$value = $args['default'];
				}
			}

			$id = $args['id'];
?>
		<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( CL_OPTIONS ); ?>[<?php echo esc_html( $id ); ?>]" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
<?php
			if ( ! empty( $args['description'] ) ) {
				echo '<br /><span class="description">' . esc_html( $args['description'] ) . '</span>';
			}

		}


		/**
		 * Display a textarea form control.
		 *
		 * @param array $args Control arguments.
		 */
		public function form_textarea( $args ) {

			$id = '';
			$value = '';

			// Set values.
			if ( ! empty( $args['value'][ $args['id'] ] ) ) {
				$value = $args['value'][ $args['id'] ];
			} else {
				if ( ! empty( $args['default'] ) ) {
					$value = $args['default'];
				}
			}

			$id = $args['id'];

			if ( ! empty( $args['description'] ) ) {
				echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
			}
?>
		<textarea type="text" rows="10" cols="50" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( CL_OPTIONS ); ?>[<?php echo esc_html( $id ); ?>]" class="large-text code"><?php echo esc_textarea( $value ); ?></textarea>
<?php

		}


		/**
		 * Add a select box element to form.
		 *
		 * @param array $args Select box settings.
		 */
		public function form_select( $args ) {

			$id = '';
			$value = '';
			$options = array();

			if ( ! empty( $args['options'] ) ) {
				$options = $args['options'];
			}

			if ( ! empty( $args['value'][ $args['id'] ] ) ) {
				$value = $args['value'][ $args['id'] ];
			} else {
				if ( ! empty( $args['default'] ) ) {
					$value = $args['default'];
				}
			}

			$id = $args['id'];

			// Display select box options list.
			if ( $options ) {
				echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( CL_OPTIONS ) . '[' . esc_attr( $id ) . ']">';
				foreach ( $options as $o ) {
					$selected = '';
					if ( $o === $value ) {
						$selected = ' selected="selected" ';
					}
					echo '<option value="' . esc_attr( $o ) . '" ' . $selected . '>' . esc_html( $o ) . '</option>';
				}
				echo '</select>';
			}

			if ( ! empty( $args['description'] ) ) {
				echo '<br /><span class="description">' . esc_html( $args['description'] ) . '</span>';
			}

		}


		/**
		 * Display a color picker in place of a text input
		 *
		 * @param array $args Colour picker settings.
		 */
		public function form_color( $args ) {

			$id = '';
			$value = '';
			$description = '';

			// Set values.
			if ( ! empty( $args['value'][ $args['id'] ] ) ) {
				$value = $args['value'][ $args['id'] ];
			} else {
				if ( ! empty( $args['default'] ) ) {
					$value = $args['default'];
				}
			}

			if ( ! empty( $args['description'] ) ) {
				$description = $args['description'];
			}

			$id = $args['id'];

?>
		<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( CL_OPTIONS ); ?>[<?php echo esc_attr( $id ); ?>]" value="<?php echo $this->sanitize_hex_color( $value ); ?>" data-default-color="<?php echo $this->sanitize_hex_color( $args['default'] ); ?>" class="color-picker"/>
<?php
			if ( ! empty( $description ) ) {
				echo '<br /><span class="description">' . esc_html( $description ) . '</span>';
			}

		}


		/**
		 * Display an image selecter form element.
		 *
		 * @param array $args Form image properties.
		 */
		public function form_image( $args ) {

			$id = '';
			$value = '';
			$description = '';

			// Set values.
			if ( ! empty( $args['value'][ $args['id'] ] ) ) {
				$value = $args['value'][ $args['id'] ];
			} else {
				if ( ! empty( $args['default'] ) ) {
					$value = $args['default'];
				}
			}

			if ( ! empty( $args['description'] ) ) {
				$description = $args['description'];
			}

			$id = $args['id'];
?>
			<input class="image-picker" type="text" size="36" name="<?php echo esc_attr( CL_OPTIONS ); ?>[<?php echo esc_attr( $id ); ?>]" value="<?php echo esc_url( $value ); ?>" />
			<button class="image-picker-button button-secondary"><?php esc_html_e( 'Upload Image', 'bm-custom-login' ); ?></button>
<?php
			if ( ! empty( $description ) ) {
				echo '<br /><span class="description">' . esc_html( $description ) . '</span>';
			}
		}


		/**
		 * Enqueue colour picker CSS and JS
		 */
		public function enqueue_color_picker() {

			$screen = get_current_screen();

			if ( 'settings_page_custom_login_admin' !== $screen->id ) {
				return;
			}

			// Add the color picker css file.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			// Add media library.
			wp_enqueue_media();

		}


		/**
		 * Add required JS to site footer.
		 */
		public function admin_foot_script() {

			$screen = get_current_screen();

			if ( 'settings_page_custom_login_admin' !== $screen->id ) {
				return;
			}

?>
		<script>
			(function( $ ) {
				$(function() {

					$( 'input.color-picker' ).wpColorPicker();

					var media_init = function(selector, button_selector)  {
						var clicked_button = false;

						$(selector).each(function (i, input) {
							var button = jQuery(input).next(button_selector);
							button.click(function (event) {
								event.preventDefault();
								var selected_img;
								clicked_button = jQuery(this);

								// check for media manager instance
								if(wp.media.frames.frame) {
									wp.media.frames.frame.open();
									return;
								}
								// configuration of the media manager new instance
								wp.media.frames.frame = wp.media({
									title: 'Select image',
									multiple: false,
									library: {
										type: 'image'
									},
									button: {
										text: 'Use selected image'
									}
								});

								// Function used for the image selection and media manager closing
								var media_set_image = function() {
									var selection = wp.media.frames.frame.state().get('selection');

									// no selection
									if (!selection) {
										return;
									}

									// iterate through selected elements
									selection.each(function(attachment) {
										var url = attachment.attributes.url;
										clicked_button.prev(selector).val(url);
									});
								};

								wp.media.frames.frame.on('close', media_set_image);
								wp.media.frames.frame.on('select', media_set_image);
								wp.media.frames.frame.open();
							});
						});
					};

					media_init( '.image-picker', '.image-picker-button' );

				});
			})( jQuery );
		</script>
<?php
		}


		/**
		 * Sanitize hexedecimal numbers used for colors
		 *
		 * @param string $color Hex number to sanitize.
		 * @return string
		 */
		public function sanitize_hex_color( $color ) {

			if ( '' === $color ) {
				return '';
			}

			// Make sure the color starts with a hash.
			$color = '#' . ltrim( $color, '#' );

			// 3 or 6 hex digits, or the empty string.
			if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
				return $color;
			}

			return null;

		}

		/**
		 * Adjust brightness of a colour
		 * not the best way to do it but works well enough here
		 *
		 * @param string $hex Hex colour to adjust.
		 * @param int    $steps Amount to adjust colour brightness.
		 * @return string Hex colour.
		 */
		public function adjust_brightness( $hex, $steps ) {

			$steps = max( -255, min( 255, $steps ) );

			$hex = str_replace( '#', '', $hex );
			if ( 3 === strlen( $hex ) ) {
				$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
			}

			$color_parts = str_split( $hex, 2 );
			$return = '#';

			foreach ( $color_parts as $color ) {
				$color = hexdec( $color );
				$color = max( 0, min( 255, $color + $steps ) );
				$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT );
			}

			return $this->sanitize_hex_color( $return );

		}


		/**
		 * Calculate whether black or white is best for readability based upon the brightness of specified colour
		 *
		 * @param string $hex Hex colour to look at.
		 */
		public function readable_colour( $hex ) {

			$hex = str_replace( '#', '', $hex );
			if ( 3 === strlen( $hex ) ) {
				$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
			}

			$color_parts = str_split( $hex, 2 );

			$brightness = ( hexdec( $color_parts[0] ) * 0.299 ) + ( hexdec( $color_parts[1] ) * 0.587 ) + ( hexdec( $color_parts[2] ) * 0.114 );

			if ( $brightness > 128 ) {
				return '#000';
			} else {
				return '#fff';
			}

		}
	}

	new BMCustomLogin();

}

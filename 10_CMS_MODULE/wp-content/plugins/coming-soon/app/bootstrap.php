<?php


/**
 * Enqueue Styles and Scripts
 */
function seedprod_lite_admin_enqueue_scripts( $hook_suffix ) {
	// global admin style
	wp_enqueue_style(
		'seedprod-global-admin',
		SEEDPROD_PLUGIN_URL . 'public/css/global-admin.css',
		false,
		SEEDPROD_VERSION
	);

	$is_localhost = seedprod_lite_is_localhost();

	// Load our admin styles and scripts only on our pages
	if ( strpos( $hook_suffix, 'seedprod_lite' ) !== false ) {
		// remove conflicting scripts
		wp_dequeue_script( 'googlesitekit_admin' );
		wp_dequeue_script( 'tds_js_vue_files_last' );
		wp_dequeue_script( 'js_files_for_wp_admin' );

		$vue_app_folder = 'lite';
		if ( strpos( $hook_suffix, 'seedprod_lite_builder' ) !== false || strpos( $hook_suffix, 'seedprod_lite_template' ) !== false ) {
			if ( $is_localhost ) {
			} else {
				wp_register_script(
					'seedprod_vue_builder_app_1',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/index.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_builder_app_2',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-vendors.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_builder_app_3',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-common.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);

				wp_set_script_translations( 'seedprod_vue_builder_app_1', 'coming-soon' );
				wp_set_script_translations( 'seedprod_vue_builder_app_2', 'coming-soon' );
				wp_set_script_translations( 'seedprod_vue_builder_app_3', 'coming-soon' );

				wp_localize_script(
					'seedprod_vue_builder_app_1',
					'seedprodProTranslations',
					array(
						'translations_pro' => seedprod_lite_get_jed_locale_data( 'coming-soon' ),
					)
				);

				wp_enqueue_script( 'seedprod_vue_builder_app_1' );
				wp_enqueue_script( 'seedprod_vue_builder_app_2' );
				wp_enqueue_script( 'seedprod_vue_builder_app_3' );
				wp_enqueue_style( 'seedprod_vue_builder_app_css_1', SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/css/chunk-vendors.css', false, SEEDPROD_VERSION );
			}
		} else {
			if ( $is_localhost ) {
			} else {
				wp_register_script(
					'seedprod_vue_admin_app_1',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/admin.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_admin_app_2',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-vendors.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_admin_app_3',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-common.js',
					array( 'wp-i18n' ),
					SEEDPROD_VERSION,
					true
				);

				wp_set_script_translations( 'seedprod_vue_admin_app_1', 'coming-soon' );
				wp_set_script_translations( 'seedprod_vue_admin_app_2', 'coming-soon' );
				wp_set_script_translations( 'seedprod_vue_admin_app_3', 'coming-soon' );

				wp_localize_script(
					'seedprod_vue_admin_app_1',
					'seedprodProTranslations',
					array(
						'translations_pro' => seedprod_lite_get_jed_locale_data( 'coming-soon' ),
					)
				);

				wp_enqueue_script( 'seedprod_vue_admin_app_1' );
				wp_enqueue_script( 'seedprod_vue_admin_app_2' );
				wp_enqueue_script( 'seedprod_vue_admin_app_3' );
				wp_enqueue_style(
					'seedprod_vue_admin_app_css_1',
					SEEDPROD_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/css/chunk-vendors.css',
					false,
					SEEDPROD_VERSION
				);
				// wp_enqueue_style(
				// 'seedprod_vue_admin_app_css_2',
				// SEEDPROD_PLUGIN_URL . 'public/'.$vue_app_folder.'/vue-backend/css/admin.css',
				// false,
				// SEEDPROD_VERSION
				// );
			}
		}

		if ( strpos( $hook_suffix, 'seedprod_lite_builder' ) !== false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PLUGIN_URL . 'public/css/admin-style.min.css',
				false,
				SEEDPROD_VERSION
			);
			wp_enqueue_style(
				'seedprod-builder-css',
				SEEDPROD_PLUGIN_URL . 'public/css/tailwind-builder.min.css',
				false,
				SEEDPROD_VERSION
			);

			wp_enqueue_style(
				'seedprod-hotspot-tooltipster-css',
				SEEDPROD_PLUGIN_URL . 'public/css/tooltipster.bundle.min.css',
				false,
				SEEDPROD_VERSION
			);

			wp_enqueue_style(
				'seedprod-builder-lightbox-index',
				SEEDPROD_PLUGIN_URL . 'public/css/seedprod-gallery-block.min.css',
				false,
				SEEDPROD_VERSION
			);

			// animate css
			wp_enqueue_style(
				'seedprod-animate-css',
				SEEDPROD_PLUGIN_URL . 'public/css/animate.css',
				false,
				SEEDPROD_VERSION
			);

			// photoswipe css
			wp_enqueue_style(
				'seedprod-photoswipe-css',
				SEEDPROD_PLUGIN_URL . 'public/css/photoswipe/photoswipe.css',
				false,
				SEEDPROD_VERSION
			);

			wp_enqueue_style(
				'seedprod-photoswipe-default-css',
				SEEDPROD_PLUGIN_URL . 'public/css/photoswipe/default-skin/photoswipe-default-skin.css',
				false,
				SEEDPROD_VERSION
			);

			wp_register_script(
				'seedprod-animate-dynamic-css',
				SEEDPROD_PLUGIN_URL . 'public/js/animate-dynamic.js',
				array( 'jquery-core' ),
				SEEDPROD_VERSION,
				true
			);
			// wp_enqueue_script( 'seedprod-animate-dynamic-css' );

			// Load WPForms CSS assets.
			if ( function_exists( 'wpforms' ) ) {
				add_filter( 'wpforms_global_assets', '__return_true' );
				wpforms()->frontend->assets_css();
			}

			// Load WooCommerce default styles if WooCommerce is active
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				wp_enqueue_style(
					'seedprod-woocommerce-layout',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-layout.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'all'
				);
				wp_enqueue_style(
					'seedprod-woocommerce-smallscreen',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-smallscreen.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'only screen and (max-width: 1088px)' // 768px default break + 320px for sidebar
				);
				wp_enqueue_style(
					'seedprod-woocommerce-general',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'all'
				);
			}

			// Load EDD default styles if EDD is active
			if ( in_array( 'easy-digital-downloads/easy-digital-downloads.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'easy-digital-downloads-pro/easy-digital-downloads.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				$css_suffix = is_rtl() ? '-rtl.min.css' : '.min.css';
				$url        = trailingslashit( EDD_PLUGIN_URL ) . 'assets/css/edd' . $css_suffix;

				wp_enqueue_style(
					'seedprod-edd-general',
					str_replace( array( 'http:', 'https:' ), '', $url ),
					'',
					defined( 'EDD_VERSION' ) ? EDD_VERSION : null,
					'all'
				);

				global $post;
				wp_enqueue_script( 'edd-ajax' );

				// Load AJAX scripts, if enabled
				if ( ! edd_is_ajax_disabled() ) {
					// Get position in cart of current download
					$position = isset( $post->ID )
						? edd_get_item_position_in_cart( $post->ID )
						: -1;

					if ( ( ! empty( $post->post_content ) && ( has_shortcode( $post->post_content, 'purchase_link' ) || has_shortcode( $post->post_content, 'downloads' ) ) ) || is_post_type_archive( 'download' ) ) {
						$has_purchase_links = true;
					} else {
						$has_purchase_links = false;
					}

					wp_localize_script(
						'edd-ajax',
						'edd_scripts',
						apply_filters(
							'edd_ajax_script_vars',
							array(
								'ajaxurl'                 => esc_url_raw( edd_get_ajax_url() ),
								'position_in_cart'        => $position,
								'has_purchase_links'      => $has_purchase_links,
								'already_in_cart_message' => __( 'You have already added this item to your cart', 'easy-digital-downloads' ), // Item already in the cart message
								'empty_cart_message'      => __( 'Your cart is empty', 'easy-digital-downloads' ), // Item already in the cart message
								'loading'                 => __( 'Loading', 'easy-digital-downloads' ), // General loading message
								'select_option'           => __( 'Please select an option', 'easy-digital-downloads' ), // Variable pricing error with multi-purchase option enabled
								'is_checkout'             => '1',
								'default_gateway'         => edd_get_default_gateway(),
								'redirect_to_checkout'    => ( edd_straight_to_checkout() || edd_is_checkout() ) ? '1' : '0',
								'checkout_page'           => esc_url_raw( edd_get_checkout_uri() ),
								'permalinks'              => get_option( 'permalink_structure' ) ? '1' : '0',
								'quantities_enabled'      => edd_item_quantities_enabled(),
								'taxes_enabled'           => edd_use_taxes() ? '1' : '0', // Adding here for widget, but leaving in checkout vars for backcompat
								'current_page'            => get_the_ID(),
							)
						)
					);
				}
			}
		}

		if ( strpos( $hook_suffix, 'seedprod_lite_template' ) !== false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PLUGIN_URL . 'public/css/admin-style.min.css',
				false,
				SEEDPROD_VERSION
			);
			wp_enqueue_style(
				'seedprod-builder-css',
				SEEDPROD_PLUGIN_URL . 'public/css/tailwind-builder.min.css',
				false,
				SEEDPROD_VERSION
			);
		}

		if ( strpos( $hook_suffix, 'seedprod_lite_builder' ) === false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PLUGIN_URL . 'public/css/tailwind-admin.min.css',
				false,
				SEEDPROD_VERSION
			);
		}

		$allow_google_fonts = apply_filters( 'seedprod_allow_google_fonts', true );
		if ( $allow_google_fonts ) {
			wp_enqueue_style( 'seedprod-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700&display=swap', false ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		}

		wp_enqueue_style(
			'seedprod-fontawesome',
			SEEDPROD_PLUGIN_URL . 'public/fontawesome/css/all.min.css',
			false,
			SEEDPROD_VERSION
		);

		wp_register_script(
			'seedprod-iframeresizer',
			SEEDPROD_PLUGIN_URL . 'public/js/iframeResizer.min.js',
			array(),
			SEEDPROD_VERSION,
			false
		);
		wp_enqueue_script( 'seedprod-iframeresizer' );

		wp_enqueue_media();
		wp_enqueue_script( 'wp-tinymce' );
		wp_enqueue_editor();
	}

	wp_register_script(
		'seedprod-tsparticles-js',
		SEEDPROD_PLUGIN_URL . 'public/js/tsparticles.min.js',
		array( 'jquery' ),
		SEEDPROD_VERSION,
		false
	);
	wp_enqueue_script( 'seedprod-tsparticles-js' );

	wp_register_script(
		'seedprod-xd-localstorage',
		SEEDPROD_PLUGIN_URL . 'public/js/xdLocalStorage.js',
		array(),
		SEEDPROD_VERSION,
		false
	);

	wp_enqueue_script( 'seedprod-xd-localstorage' );
}
add_action( 'admin_enqueue_scripts', 'seedprod_lite_admin_enqueue_scripts', 99999 );


/**
 * SeedProd Enqueue Styles.
 *
 * @return void
 */
function seedprod_lite_wp_enqueue_styles() {
	// wp_register_style(
	// 'seedprod-style',
	// SEEDPROD_PLUGIN_URL . 'public/css/seedprod-style.min.css',
	// false,
	// SEEDPROD_VERSION
	// );
	// wp_enqueue_style('seedprod-style');

	$is_user_logged_in = is_user_logged_in();
	if ( $is_user_logged_in ) {
		wp_enqueue_style(
			'seedprod-global-admin',
			SEEDPROD_PLUGIN_URL . 'public/css/global-admin.css',
			false,
			SEEDPROD_VERSION
		);
	}

	wp_register_style(
		'seedprod-fontawesome',
		SEEDPROD_PLUGIN_URL . 'public/fontawesome/css/all.min.css',
		false,
		SEEDPROD_VERSION
	);

	// wp_enqueue_style('seedprod-fontawesome');
}
add_action( 'init', 'seedprod_lite_wp_enqueue_styles' );


/**
 * Display settings link on plugin page
 */
add_filter( 'plugin_action_links', 'seedprod_lite_plugin_action_links', 10, 2 );

/**
 * Plugin action links.
 *
 * @param array  $links Action links.
 * @param string $file  Plugin file.
 * @return array $links Processed action links.
 */
function seedprod_lite_plugin_action_links( $links, $file ) {
	$plugin_file = SEEDPROD_SLUG;

	if ( $file == $plugin_file || 'seedprod-pro/seedprod-pro.php' == $file ) {
		$settings_link = '<a href="admin.php?page=seedprod_lite">Settings</a>';
		array_unshift( $links, $settings_link );
		if ( 'lite' === SEEDPROD_BUILD ) {
			$upgrade_link = '<a href="https://www.seedprod.com/lite-upgrade/?utm_source=WordPress&utm_campaign=liteplugin&utm_medium=plugin-actions-upgrade-link" target="_blank" style="color: #1da867;
font-weight: 600;">Upgrade to Pro</a>';
			array_unshift( $links, $upgrade_link );
		}
	}
	return $links;
}

/**
 * Remove other plugin's style from our page so they don't conflict
 */

add_action( 'admin_enqueue_scripts', 'seedprod_lite_deregister_backend_styles', PHP_INT_MAX );

/**
 * Deregister backend styles & scripts registered by the theme.
 *
 * @return void
 */
function seedprod_lite_deregister_backend_styles() {
	// remove scripts registered by the theme so they don't screw up our page's style
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( null !== $page && strpos( $page, 'seedprod_lite_builder' ) !== false ) {
		wp_dequeue_style( 'dashicons', 9999 );
		$seedprod_builder_debug = get_option( 'seedprod_builder_debug' );
		if ( empty( $seedprod_builder_debug ) ) {
			global $wp_styles;
			// list of styles to keep else remove
			$keep_styles = 'media-views|editor-buttons|imgareaselect|buttons|wp-auth-check|wpforms-full|thickbox|wp-mediaelement|wp-util';
			$s           = explode( '|', $keep_styles );

			$wpforms_url = plugins_url( 'wpforms' );

			foreach ( $wp_styles->queue as $handle ) {
				// echo '<br> '.$handle;
				if ( ! in_array( $handle, $s ) ) {
					if ( strpos( $handle, 'seedprod' ) === false ) {
						wp_dequeue_style( $handle );
						wp_deregister_style( $handle );
						// echo '<br>removed '.$handle;
					}
				}
			}

			// foreach ($wp_styles->registered as $handle => $asset) {
			// echo '<br> '.$handle;
			// if (!in_array($handle, $s)) {
			// if (strpos($handle, 'seedprod') === false && strpos($asset->src, $wpforms_url) === false) {
			// wp_dequeue_style($handle);
			// wp_deregister_style($handle);
			// echo '<br>removed '.$handle;
			// }
			// }
			// }

			// remove scripts

			$s = 'admin-bar|common|utils|wp-auth-check|media-upload|jquery|media-editor|media-audiovideo|mce-view|image-edit|wp-tinymce|editor|quicktags|wplink|jquery-ui-autocomplete|thickbox|svg-painter|jquery-ui-core|jquery-ui-mouse|jquery-ui-accordion|jquery-ui-datepicker|jquery-ui-dialog|jquery-ui-slider|jquery-ui-sortable|jquery-ui-droppable|jquery-ui-tabs|jquery-ui-widget|wp-mediaelement|wp-util|underscore|wp-dom-ready|wp-components|wp-element|wp-i18n|wp-polyfill';
			$d = explode( '|', urldecode( $s ) );

			global $wp_scripts;
			foreach ( $wp_scripts->queue as $handle ) :
				// echo '<br>removed '.$handle;

				if ( ! empty( $d ) ) {
					if ( ! in_array( $handle, $d ) ) {
						if ( strpos( $handle, 'seedprod' ) === false ) {
							wp_dequeue_script( $handle );
							wp_deregister_script( $handle );
							// echo '<br>removed '.$handle;
						}
					}
				}
			endforeach;

			$suffix = '.min';
			$wp_scripts->add( 'media-widgets', "/wp-admin/js/widgets/media-widgets$suffix.js", array( 'jquery', 'media-models', 'media-views' ) );
			$wp_scripts->add_inline_script( 'media-widgets', 'wp.mediaWidgets.init();', 'after' );

			$wp_scripts->add( 'media-audio-widget', "/wp-admin/js/widgets/media-audio-widget$suffix.js", array( 'media-widgets', 'media-audiovideo' ) );
			$wp_scripts->add( 'media-image-widget', "/wp-admin/js/widgets/media-image-widget$suffix.js", array( 'media-widgets' ) );
			$wp_scripts->add( 'media-video-widget', "/wp-admin/js/widgets/media-video-widget$suffix.js", array( 'media-widgets', 'media-audiovideo' ) );
			$wp_scripts->add( 'text-widgets', "/wp-admin/js/widgets/text-widgets$suffix.js", array( 'jquery', 'editor', 'wp-util' ) );
			$wp_scripts->add_inline_script( 'text-widgets', 'wp.textWidgets.init();', 'after' );

			wp_enqueue_style( 'widgets' );
			wp_enqueue_style( 'media-views' );

			wp_get_current_user()->syntax_highlighting = 'false';

			/** This action is documented in wp-admin/admin-header.php */
			do_action( 'admin_print_scripts-widgets.php' ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

			/** This action is documented in wp-admin/admin-footer.php */
			do_action( 'admin_footer-widgets.php' ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

		}
	}
}

add_filter( 'admin_body_class', 'seedprod_lite_add_admin_body_classes' );

/**
 * Filters the CSS classes for the body tag in the admin.
 *
 * @param string $classes Space-separated string of class names.
 * @return string $classes Space-separated string of class names.
 */
function seedprod_lite_add_admin_body_classes( $classes ) {
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( null !== $page && strpos( $page, 'seedprod_lite' ) !== false ) {
		$classes .= ' seedprod-body seedprod-lite';
	}
	if ( null !== $page && ( strpos( $page, 'seedprod_lite_builder' ) !== false ) ) {
		$classes .= ' seedprod-builder seedprod-lite';
	}
	return $classes;
}


// Review Request
add_action( 'admin_footer_text', 'seedprod_lite_admin_footer' );

/**
 * Filters the “Thank you” text displayed in the admin footer.
 *
 * @param string $text Footer text.
 * @return string $text Footer text.
 */
function seedprod_lite_admin_footer( $text ) {
	global $current_screen;

	if ( ! empty( $current_screen->id ) && strpos( $current_screen->id, 'seedprod' ) !== false && SEEDPROD_BUILD == 'lite' ) {
		$url = 'https://wordpress.org/support/plugin/coming-soon/reviews/?filter=5#new-post';
		/* translators: 1: wordpress.org coming-soon plugin review, 2: wordpress.org coming-soon plugin review */
		$text = sprintf( __( 'Please rate <strong>SeedProd</strong> <a href="%1$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%2$s" target="_blank">WordPress.org</a> to help us spread the word. Thank you from the SeedProd team!', 'coming-soon' ), $url, $url );
	}
	return $text;
}



/**
 * Filters the version/update text displayed in the admin footer.
 *
 * @param string $str Version/Update text.
 * @return string $str Version/Update text.
 */
function seedprod_lite_change_footer_version( $str ) {
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( null !== $page && strpos( $page, 'seedprod_lite' ) !== false ) {
		return $str . ' - SeedProd ' . SEEDPROD_VERSION;
	}

	return $str;
}
add_filter( 'update_footer', 'seedprod_lite_change_footer_version', 9999 );



/**
 * Returns Jed-formatted localization data. Added for backwards-compatibility.
 *
 * @param  string $domain Translation domain.
 * @return array          The information of the locale.
 */
function seedprod_lite_get_jed_locale_data( $domain ) {
	$translations = get_translations_for_domain( $domain );

	$locale = array(
		'' => array(
			'domain' => $domain,
			'lang'   => is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale(),
		),
	);

	if ( ! empty( $translations->headers['Plural-Forms'] ) ) {
		$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
	}

	foreach ( $translations->entries as $msgid => $entry ) {
		$locale[ $msgid ] = $entry->translations;
	}

	// If any of the translated strings incorrectly contains HTML line breaks i.e. <br>, we need to return or else the admin is no longer accessible.
	// https://github.com/awesomemotive/aioseo/issues/2074
	// Commented out incase we need to use this in the future.
	// $json = wp_json_encode( $locale );
	// if ( preg_match( '/<br[\s\/\\\\]*>/', $json ) ) {
	// 	return array();
	// }

	return $locale;
}

// nonce covered by menu capability check.

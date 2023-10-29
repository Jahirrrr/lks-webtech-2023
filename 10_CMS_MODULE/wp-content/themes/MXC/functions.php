<?php
define('DIR', get_stylesheet_directory_uri());

add_action('init', function () {
    register_post_type('biodata', [
        'label' => 'Biodata',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);

    flush_rewrite_rules();
});

add_action('init', function () {
    // Register a custom rewrite rule for the login page
    add_rewrite_rule('^login/?$', 'wp-login.php', 'top');
    flush_rewrite_rules(false);
});

add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'side');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
});

add_action('login_head', function () { ?>
    <style>
        #login p {
            background: white;
        }
    </style>
<?php });

add_filter('excerpt_length', function ($length) {
    return 15;
});

add_filter('post_type_link', function ($link, $post = 0) {
    if (is_object($post)) {
        $term = wp_get_post_terms($post->ID, 'category');
        if (!empty($term) && is_array($term)) {
            return str_replace('%cat%', $term[0]->slug, $link);
        }
    }
    return $link;
});

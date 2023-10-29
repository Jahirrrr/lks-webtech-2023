<?php
/**
 * Contains any extensions of the WP REST API, currently
 * has a 'template' extension
 */

 /**
 * Get Page Modal Content
 * -----------------------
 * Fetches content for a modal based on the slug provided 
 * Returns just the HTML from the modal_content field
 * A Page MUST use the AJAX Modal template to utilise this feature
 * Data can be fetched from /wp-json/cls/v1/modal?slug=
 */

// Extend the API and register the route
add_action('rest_api_init', 'register_api_page_modal_response');

function register_api_page_modal_response()
{
    register_rest_route(
        'cls/v1',
        '/modal',
        array(
            'methods' => 'GET',
            'callback' => 'get_page_modal_content'
        )
    );
}

/**
 * Returns data from the modal_content field from a page
 * using the AJAX Modal template
 *
 * @param WP_REST_Request $data
 * @return array|JSON $response
 */
function get_page_modal_content($data)
{

    $response = array();

    $slug = $_GET['slug'];

    $args = array(
        'name'           => $slug,
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );

    // Only needs the first item from the returned array
    $modal = get_posts($args)[0];

    if ($modal) {
        $fields = get_fields($modal->ID);
        $response['title'] = $modal->post_title;
        $response['content'] = $fields['modal_content'];
    } else {
        $response = false;
    }

    return json_encode($response);
}
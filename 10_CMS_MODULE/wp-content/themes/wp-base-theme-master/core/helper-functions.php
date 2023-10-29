<?php

/**
 * Contains a group of useful function used throughout
 * the theme.
 */

/**
 * Fetches all menu items for a given menu, only works for 
 * single tier menus.
 *
 * @param string $menu
 * 
 * @return array $menu_items
 */
function get_menu_items($menu)
{

    $locations = get_nav_menu_locations();
    $menu_items = array();

    if (isset($locations[$menu])) {
        $menu_object = wp_get_nav_menu_object($locations[$menu]);
        $menu_items = wp_get_nav_menu_items($menu_object->term_id);
    }

    return $menu_items;
}

/**
 * Generates and returns a simple list of menu links
 * Ideal for footer 'Quick Links' etc.
 *
 * @param string $menu
 * @param string $wrap
 * 
 * @return string $html
 */
function simple_footer_menu($menu)
{

    $html = "";

    $locations = get_nav_menu_locations();

    if (isset($locations[$menu])) {

        $menu_object = wp_get_nav_menu_object($locations[$menu]);
        $menu_items = wp_get_nav_menu_items($menu_object->term_id);

        foreach ($menu_items as $item) {
            $html .= "<a href='" . $item->url . "' title='" . $item->attr_title . "' class='footer-link'><span>" . $item->title . "</span></a>";
        }

        return $html;
    }
}


/**
 * Removes any spaces from a phone number to make
 * it W3 compliant
 * 
 * @return String $number
 */
function format_phone_number($number)
{
    return str_replace(' ', '', $number);
}

/**
 * Check if an image has an alt tag, returns a backup string 
 * if it doesnt
 *
 * @param array $image
 * @param string $backup_text
 * @return string $alt_text
 */
function get_image_alt(array $image, $backup_text)
{

    $alt_text = "";

    if (empty($image['alt'])) {
        $alt_text = $backup_text;
    } else {
        $alt_text = $image['alt'];
    }

    return $alt_text;
}

/**
 * Checks if an acf link array has a title, returns a backup
 * string if it doesnt 
 *
 * @param array $link
 * @param string $backup_text
 * @return string $alt_text
 */
function get_link_title($link, $backup_text)
{

    $alt_text = "";

    if (empty($link['title']) && !is_array($link)) {
        $alt_text = $backup_text;
    } else {
        $alt_text = $link['title'];
    }

    return $alt_text;
}

/**
 * Returns the first 175 character of a given string, used
 * for shortening descriptions.
 * 
 * @param String $description
 * @return String $return
 */
function format_excerpt($description)
{

    return wp_trim_words($description, 25, '...');
}

/**
 * Takes the $wp->request and uses it to return the
 * current URL.
 * 
 * @return string
 */
function get_current_url()
{
    global $wp;
    return add_query_arg(array(), $wp->request);
}

/**
 * Gets the alt attribute for the thumbnail
 * attached to a post.
 * 
 * @param WP_Post $post
 * @return string $alt_text
 */
function get_post_thumbnail_alt($post)
{

    $alt_text = "";

    $id = get_post_thumbnail_id($post);
    $alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);

    return $alt_text;
}

/**
 * Gets the title of any page
 *
 * @return string 
 */
function nbz_get_title()
{

    global $options;

    if (is_home() && !is_front_page()) {
        $title = "Latest News";
    } elseif (is_front_page()) {
        $title = get_bloginfo('description');
    } elseif (is_page() || is_single()) {
        $title = get_the_title();
    } elseif (is_archive()) {
        if (is_category()) {
            /* translators: Category archive title. 1: Category name */
            $title = sprintf(__('%s'), single_cat_title('', false));
        } elseif (is_tag()) {
            /* translators: Tag archive title. 1: Tag name */
            $title = sprintf(__('Tag: %s'), single_tag_title('', false));
        } elseif (is_author()) {
            /* translators: Author archive title. 1: Author name */
            $title = sprintf(__('Author: %s'), '<span class="vcard">' . get_the_author() . '</span>');
        } elseif (is_year()) {
            /* translators: Yearly archive title. 1: Year */
            $title = sprintf(__('Year: %s'), get_the_date(_x('Y', 'yearly archives date format')));
        } elseif (is_month()) {
            /* translators: Monthly archive title. 1: Month name and year */
            $title = sprintf(__('Month: %s'), get_the_date(_x('F Y', 'monthly archives date format')));
        } elseif (is_day()) {
            /* translators: Daily archive title. 1: Date */
            $title = sprintf(__('Day: %s'), get_the_date(_x('F j, Y', 'daily archives date format')));
        } elseif (is_tax('post_format')) {
            if (is_tax('post_format', 'post-format-aside')) {
                $title = _x('Asides', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                $title = _x('Galleries', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-image')) {
                $title = _x('Images', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-video')) {
                $title = _x('Videos', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                $title = _x('Quotes', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-link')) {
                $title = _x('Links', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-status')) {
                $title = _x('Statuses', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                $title = _x('Audio', 'post format archive title');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                $title = _x('Chats', 'post format archive title');
            }
        } elseif (is_post_type_archive()) {
            /* translators: Post type archive title. 1: Post type name */

            if (is_post_type_archive('exhibition')) {
                $title = $options['exhibitions_archive']['page_title'];
            } else {
                $title = sprintf(__('Archives: %s'), post_type_archive_title('', false));
            }
        } elseif (is_tax()) {
            $tax = get_taxonomy(get_queried_object()->taxonomy);
            /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf(__('%1$s: %2$s'), $tax->labels->singular_name, single_term_title('', false));
        } else {
            $title = __('Archives');
        }
    } elseif (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tax()) {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $title = $term->name;
    } elseif (is_search()) {
        $title = 'Search';
    } elseif (is_404()) {
        $title = '404 Page not found';
    } else {
        $title = get_bloginfo('name');
    }

    return $title;
}

/**
 * Gets the exceprt and replaces end with elipsis if too long
 * Character limit can also be overriden
 *
 * @param integer $count
 * @return void
 */
function get_excerpt($limit = 200, $excerpt = null) {
    global $post;

    if ($excerpt === null) {
        $permalink = get_permalink($post->ID);
        $excerpt = get_the_content();
    }

    $excerpt = strip_tags($excerpt);
    $excerpt_length = strlen($excerpt);

    if ($excerpt_length >= $limit) {
        $excerpt = substr($excerpt, 0, $limit);
        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
        $excerpt = '<p>' . $excerpt . ' ...</p>';
    }

    return $excerpt;

}

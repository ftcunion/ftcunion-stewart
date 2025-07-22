<?php

/**
 * CSS unload and load
 */
function ftcunion_styles()
{
    // Register theme stylesheet.
    wp_register_style(
        'ftcunion-style',
        get_stylesheet_directory_uri() . '/style.min.css',
        array(),
        wp_get_theme()->get('Version')
    );
    // Enqueue theme stylesheet.
    wp_enqueue_style('ftcunion-style');
}
add_action('wp_enqueue_scripts', 'ftcunion_styles');

function stewart_dequeue_styles()
{
    // Dequeue the default theme stylesheet.
    wp_dequeue_style('stewart-style');
    // Deregister the default theme stylesheet.
    wp_deregister_style('stewart-style');
}
add_action('wp_enqueue_scripts', 'stewart_dequeue_styles', 100);

/**
 * CDN Cache-Control
 */
// Disable Cloudflare Cache on nocache_headers
// (override if already set)
add_filter('nocache_headers', function ($headers) {
    return [
        'CDN-Cache-Control' =>  $headers['Cache-Control'] ?? 'no-cache, must-revalidate, max-age=0'
    ] + $headers;
});

// Set CDN-Cache-Control header same as Cache-Control if defined or default to 1w (+1Y stale-while-revalidate)
// (don't override if already set)
add_filter('wp_headers', function ($headers) {
    return $headers + [
        'CDN-Cache-Control' =>  $headers['Cache-Control'] ?? 'max-age=604800, stale-while-revalidate=31536000'
    ];
});

/**
 * Filter the default theme.json data.
 *
 * Removes default duotone, gradients and color palette values provided by WordPress core.
 * This allows the theme to define its own color settings without also loading core defaults as CSS variables.
 *
 * @param WP_Theme_JSON_Data $theme_json The default theme.json data.
 *
 * @return WP_Theme_JSON_Data The modified theme.json data.
 */
add_filter('wp_theme_json_data_default', function ($theme_json) {
    // Get JSON data as an array.
    $data = $theme_json->get_data();

    // Remove duotone and gradients values.
    $data['settings']['color']['duotone']['default']   = [];
    $data['settings']['color']['gradients']['default'] = [];

    // Update the theme JSON data.
    return $theme_json->update_with($data);
});

/**
 * This function will connect wp_mail to your authenticated
 * SMTP server. This improves reliability of wp_mail, and 
 * avoids many potential problems.
 *
 * For instructions on the use of this script, see:
 * https://butlerblog.com/easy-smtp-email-wordpress-wp_mail/
 * 
 * Values for constants are set in wp-config.php
 */
add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->Username   = SMTP_USER;
    $phpmailer->Password   = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_NAME;
}

/** 
 * Add custom post type for member-only links
 * The point is for posts to not be accessible from any path other than /members/
 */
add_action('init', 'member_only_links_type');
function member_only_links_type()
{
    $args = [
        'label'  => esc_html__('Member Posts', 'text-domain'),
        'labels' => [
            'menu_name'          => esc_html__('Member Posts', 'member-only-links'),
            'name_admin_bar'     => esc_html__('Member Post', 'member-only-links'),
            'add_new'            => esc_html__('Add Member Post', 'member-only-links'),
            'add_new_item'       => esc_html__('Add new Member Post', 'member-only-links'),
            'new_item'           => esc_html__('New Member Post', 'member-only-links'),
            'edit_item'          => esc_html__('Edit Member Post', 'member-only-links'),
            'view_item'          => esc_html__('View Member Post', 'member-only-links'),
            'update_item'        => esc_html__('View Member Post', 'member-only-links'),
            'all_items'          => esc_html__('All Member Posts', 'member-only-links'),
            'search_items'       => esc_html__('Search Member Posts', 'member-only-links'),
            'parent_item_colon'  => esc_html__('Parent Member Post', 'member-only-links'),
            'not_found'          => esc_html__('No Member Posts found', 'member-only-links'),
            'not_found_in_trash' => esc_html__('No Member Posts found in Trash', 'member-only-links'),
            'name'               => esc_html__('Member Posts', 'member-only-links'),
            'singular_name'      => esc_html__('Member Post', 'member-only-links'),
        ],
        'public'              => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'has_archive'         => true,
        'query_var'           => false,
        'can_export'          => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-lock',
        'delete_with_user'    => false,
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'excerpt',
        ],
        'rewrite' => [
            'slug'       => 'members',
            'with_front' => false,
            'feeds'      => false,
        ],
    ];

    register_post_type('member-post', $args);
}
// Fix rewrite rules after theme activation
add_action('after_switch_theme', 'my_rewrite_flush');
function my_rewrite_flush()
{
    member_only_links_type();
    flush_rewrite_rules();
}

/** 
 * Disable categories, tags, authors, and date archives.
 */
add_action('init', function () {
    // Remove categories and tags from posts
    global $wp_taxonomies;
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
    if (taxonomy_exists('category'))
        unset($wp_taxonomies['category']);
    if (taxonomy_exists('post_tag'))
        unset($wp_taxonomies['post_tag']);
    unregister_taxonomy('category');
    unregister_taxonomy('post_tag');

    // Remove author support from posts and pages
    remove_post_type_support('post', 'author');
    remove_post_type_support('page', 'author');
});
// 404 if we get to the pages for categories, tags, dates, or authors
add_action('template_redirect', function () {
    if (is_category() || is_tag() || is_date() || is_author()) {
        global $wp_query;
        $wp_query->set_404();
    }
});

/****************************************
 * The below are snippets from WPCode
 ****************************************/
/**
 * Allow SVG uploads for administrator users.
 *
 * @param array $upload_mimes Allowed mime types.
 *
 * @return mixed
 */
add_filter(
    'upload_mimes',
    function ($upload_mimes) {
        // By default, only administrator users are allowed to add SVGs.
        // To enable more user types edit or comment the lines below but beware of
        // the security risks if you allow any user to upload SVG files.
        if (!current_user_can('administrator')) {
            return $upload_mimes;
        }

        $upload_mimes['svg']  = 'image/svg+xml';
        $upload_mimes['svgz'] = 'image/svg+xml';

        return $upload_mimes;
    }
);

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
    'wp_check_filetype_and_ext',
    function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {

        if (!$wp_check_filetype_and_ext['type']) {

            $check_filetype  = wp_check_filetype($filename, $mimes);
            $ext             = $check_filetype['ext'];
            $type            = $check_filetype['type'];
            $proper_filename = $filename;

            if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
                $ext  = false;
                $type = false;
            }

            $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
        }

        return $wp_check_filetype_and_ext;
    },
    10,
    5
);

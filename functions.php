<?php
/**
 * Nepreneur Theme Functions
 */

/*----------------------------------------------------
 * Enqueue Styles & Scripts
 *---------------------------------------------------*/
add_action( 'wp_enqueue_scripts', function () {
    // theme component stylesheets
    wp_enqueue_style( 'nep-base', get_theme_file_uri( '/css/base.css' ), [], filemtime( get_theme_file_path( '/css/base.css' ) ) );
    wp_enqueue_style( 'nep-header', get_theme_file_uri( '/css/header.css' ), [], filemtime( get_theme_file_path( '/css/header.css' ) ) );
    wp_enqueue_style( 'nep-components', get_theme_file_uri( '/css/components.css' ), [], filemtime( get_theme_file_path( '/css/components.css' ) ) );
    wp_enqueue_style( 'nep-frontpage', get_theme_file_uri( '/css/frontpage.css' ), [], filemtime( get_theme_file_path( '/css/frontpage.css' ) ) );
    wp_enqueue_style( 'nep-footer', get_theme_file_uri( '/css/footer.css' ), [], filemtime( get_theme_file_path( '/css/footer.css' ) ) );
    wp_enqueue_style( 'nep-responsive', get_theme_file_uri( '/css/responsive.css' ), [], filemtime( get_theme_file_path( '/css/responsive.css' ) ) );
    wp_enqueue_style( 'nep-pages', get_theme_file_uri( '/css/pages.css' ), [], filemtime( get_theme_file_path( '/css/pages.css' ) ) );
    wp_enqueue_style( 'nep-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_style( 'nep-product', get_theme_file_uri( '/css/product.css' ), [], filemtime( get_theme_file_path( '/css/product.css' ) ) );
    wp_enqueue_style( 'nep-bbpress', get_theme_file_uri( '/css/bbpress.css' ), [], filemtime( get_theme_file_path( '/css/bbpress.css' ) ) );

    // smooth-scroll for anchor links
    wp_enqueue_script( 'nep-scroll', get_theme_file_uri( '/js/smooth-scroll.js' ), [], '1.0', true );
    wp_enqueue_script( 'np-upvote', get_theme_file_uri( '/js/upvote.js' ), [], '1.0', true );
    wp_localize_script( 'np-upvote', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

    // allow threaded comment replies on singular posts
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );

/*----------------------------------------------------
 * Theme Setup
 *---------------------------------------------------*/
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'post-thumbnails' );
} );

/*----------------------------------------------------
 * Create Default Pages on Theme Activation
 *---------------------------------------------------*/
function nep_create_default_pages() {
    $pages = [
        [
            'slug'    => 'about',
            'title'   => 'About',
            'template' => '',
        ],
        [
            'slug'    => 'contact',
            'title'   => 'Contact',
            'template' => 'page-contact.php',
        ],
        [
            'slug'    => 'advertise',
            'title'   => 'Advertise',
            'template' => 'page-advertise.php',
        ],
    ];

    foreach ( $pages as $page ) {
        if ( ! get_page_by_path( $page['slug'] ) ) {
            $page_id = wp_insert_post( [
                'post_title'  => $page['title'],
                'post_name'   => $page['slug'],
                'post_status' => 'publish',
                'post_type'   => 'page',
            ] );

            if ( ! is_wp_error( $page_id ) && $page_id && ! empty( $page['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page['template'] );
            }
        }
    }
}
add_action( 'after_switch_theme', 'nep_create_default_pages' );

/*----------------------------------------------------
 * Excerpt Length & Search Results
 *---------------------------------------------------*/
add_filter( 'excerpt_length', function ( $length ) {
    if ( is_home() || is_archive() || is_front_page() ) {
        return 20;
    }
    return $length;
}, 999 );

add_filter( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'post_type', [ 'post', 'page' ] );
    }
} );

/*----------------------------------------------------
 * Include Custom Post Types, Roles, and Rewrites
 *---------------------------------------------------*/
require_once get_theme_file_path( '/inc/cpt-product.php' );
require_once get_theme_file_path( '/inc/roles.php' );
require_once get_theme_file_path( '/inc/rewrite-join.php' );

add_action('wp_ajax_np_upvote', 'np_upvote');
add_action('wp_ajax_nopriv_np_upvote', 'np_upvote');
function np_upvote() {
    if ( ! is_user_logged_in() ) {
        wp_send_json_error(['message' => 'You must be logged in to upvote.']);
    }
    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    if ($post_id && get_post_type($post_id) === 'product') {
        $voters = get_post_meta($post_id, 'upvote_users', true);
        $voters = $voters ? (array) $voters : [];
        if (in_array($user_id, $voters)) {
            wp_send_json_error(['message' => 'You have already upvoted.']);
        }
        $count = (int) get_post_meta($post_id, 'upvotes', true);
        $count++;
        update_post_meta($post_id, 'upvotes', $count);
        $voters[] = $user_id;
        update_post_meta($post_id, 'upvote_users', $voters);
        wp_send_json_success(['count' => $count]);
    }
    wp_send_json_error();
}

/*----------------------------------------------------
 * Breadcrumbs Function
 *---------------------------------------------------*/
function nep_breadcrumbs() {
    echo '<nav class="np-breadcrumbs" aria-label="Breadcrumb">';
    echo '<ul>';
    // echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    if (is_singular('product')) {
        echo '<li><a href="' . esc_url(get_post_type_archive_link('product')) . '">Products</a></li>';
        echo '<li>' . get_the_title() . '</li>';
    } elseif (is_post_type_archive('product')) {
        echo '<li>Products</li>';
    } elseif (is_singular('post')) {
        echo '<li><a href="' . esc_url(get_post_type_archive_link('post')) . '">Blog</a></li>';
        echo '<li>' . get_the_title() . '</li>';
    } elseif (is_home()) {
        echo '<li>Blog</li>';
    } elseif (is_page()) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor) {
            echo '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
        }
        echo '<li>' . get_the_title() . '</li>';
    } elseif (is_search()) {
        echo '<li>Search results</li>';
    } elseif (is_404()) {
        echo '<li>Not Found</li>';
    }
    echo '</ul>';
    echo '</nav>';
}


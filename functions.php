<?php
/**
 * Nepreneur functions
 */

add_action( 'wp_enqueue_scripts', function () {
    // main stylesheet (auto-appends version for cache-busting)
    wp_enqueue_style( 'nep-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );

    // smooth-scroll for anchor links
    wp_enqueue_script( 'nep-scroll', get_theme_file_uri( '/js/smooth-scroll.js' ), [], '1.0', true );

    // allow threaded comment replies on singular posts
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );

// let WP know we’re using HTML5 & a custom title tag
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'post-thumbnails' );
} );

/**
 * Create default pages with their templates on theme activation.
 */
function nep_create_default_pages() {
    $pages = [
        [
            'slug'    => 'about',
            'title'   => 'About',
            'template' => '', // will use page-about.php automatically by slug
        ],
        [
            'slug'    => 'contact',
            'title'   => 'Contact',
            'template' => 'page-contact.php',
        ],
        [
            'slug'    => 'services',
            'title'   => 'Services',
            'template' => 'page-services.php',
        ],
        [
            'slug'    => 'get-started',
            'title'   => 'Get Started',
            'template' => 'page-get-started.php',
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

// Shorten excerpt length for blog listings and archives
add_filter( 'excerpt_length', function ( $length ) {
    if ( is_home() || is_archive() || is_front_page() ) {
        return 20; // limit to 20 words
    }
    return $length;
}, 999 );

// Include pages in search results alongside blog posts
add_filter( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'post_type', [ 'post', 'page' ] );
    }
} );


/**
 * Ensure custom community roles exist; create only if missing.
 */
function nepreneur_add_roles() {

	// ── Investor ───────────────────────────────────────────────
	if ( ! get_role( 'investor' ) ) {
		add_role(
			'investor',
			'Investor',
			[
				'read'            => true,
				'bbp_participant' => true,   // can post & reply in bbPress
			]
		);
	}

	// ── Entrepreneur ───────────────────────────────────────────
	if ( ! get_role( 'entrepreneur' ) ) {
		add_role(
			'entrepreneur',
			'Entrepreneur',
			[
				'read'            => true,
				'upload_files'    => true,   // allow pitch-deck uploads
				'bbp_participant' => true,
			]
		);
	}
}
register_activation_hook( 'after_switch_theme', 'nepreneur_add_roles' );

/*----------------------------------------------------
 *  Rewrite slug  /join  →  our signup template
 *---------------------------------------------------*/
function nep_add_join_rewrite() {
	add_rewrite_rule( '^join/?$', 'index.php?nep_join=1', 'top' );
	add_rewrite_tag( '%nep_join%', '1' );
}
add_action( 'init', 'nep_add_join_rewrite' );

/*  Load signup template when query var present  */
function nep_load_join_template( $template ) {
	if ( get_query_var( 'nep_join' ) ) {
		return __DIR__ . '/join-template.php'; // file we make in step 3
	}
	return $template;
}
add_filter( 'template_include', 'nep_load_join_template' );


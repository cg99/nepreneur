<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header">

    <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?> Logo">
        </a>
       <h3>Nepreneur</h3>
    </div>

     <nav class="navbar">
            <ul>
                <li><a href="<?php echo esc_url( site_url( '/about' ) ); ?>">About</a></li>
                <li><a href="<?php echo esc_url( site_url('/advertise') ); ?>">Advertise</a></li>
                <li><a href="<?php echo esc_url( site_url( '/forums' ) ); ?>">Forums</a></li>
                <li><a href="<?php echo esc_url( site_url('/contact') ); ?>">Contact</a></li>
                <li><a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">Products</a></li>
                <li><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url( site_url( '/login' ) ); ?>">Login</a></li>
            </ul>
        </nav>

    <div class="nav-search">
        <?php get_search_form(); ?>
    </div>
</header>

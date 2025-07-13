<?php
function nep_register_product_cpt() {
    register_post_type( 'product', [
        'labels' => [
            'name'          => 'Products',
            'singular_name' => 'Product',
            'add_new_item'  => 'Add New Product',
            'edit_item'     => 'Edit Product',
        ],
        'public'       => true,
        'show_in_rest' => true,
        'has_archive'  => true,  
        'supports'     => [ 'title', 'editor', 'thumbnail', 'author', 'comments' ],
        'menu_icon'    => 'dashicons-products',
    ] );
}
add_action( 'init', 'nep_register_product_cpt' );
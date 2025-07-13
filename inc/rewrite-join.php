<?php
function nep_add_join_rewrite() {
    add_rewrite_rule( '^join/?$', 'index.php?nep_join=1', 'top' );
    add_rewrite_tag( '%nep_join%', '1' );
}
add_action( 'init', 'nep_add_join_rewrite' );

function nep_load_join_template( $template ) {
    if ( get_query_var( 'nep_join' ) ) {
        return __DIR__ . '/../join-template.php';
    }
    return $template;
}
add_filter( 'template_include', 'nep_load_join_template' );
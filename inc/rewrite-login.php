<?php
function nep_add_login_rewrite() {
    add_rewrite_rule( '^login/?$', 'index.php?nep_login=1', 'top' );
    add_rewrite_tag( '%nep_login%', '1' );
}
add_action( 'init', 'nep_add_login_rewrite' );

function nep_load_login_template( $template ) {
    if ( get_query_var( 'nep_login' ) ) {
        return __DIR__ . '/../login-template.php';
    }
    return $template;
}
add_filter( 'template_include', 'nep_load_login_template' );

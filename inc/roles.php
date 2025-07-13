<?php
function nepreneur_add_roles() {
    if ( ! get_role( 'investor' ) ) {
        add_role( 'investor', 'Investor', [
            'read'            => true,
            'bbp_participant' => true,
        ]);
    }
    if ( ! get_role( 'entrepreneur' ) ) {
        add_role( 'entrepreneur', 'Entrepreneur', [
            'read'            => true,
            'upload_files'    => true,
            'bbp_participant' => true,
        ]);
    }
}
add_action( 'after_switch_theme', 'nepreneur_add_roles' );
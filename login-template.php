<?php
/* Template: custom login (no plugins) */

// -------------------------------------------------
// Handle login before any HTML is sent
// -------------------------------------------------
$errors = new WP_Error();

if ( isset( $_POST['nep_login_nonce'] ) && wp_verify_nonce( $_POST['nep_login_nonce'], 'nep_login' ) ) {
    $creds = [
        'user_login'    => sanitize_user( $_POST['username'] ),
        'user_password' => $_POST['password'],
        'remember'      => ! empty( $_POST['remember'] ),
    ];
    $user = wp_signon( $creds, false );
    if ( ! is_wp_error( $user ) ) {
        wp_set_current_user( $user->ID );
        wp_set_auth_cookie( $user->ID );
        wp_safe_redirect( home_url( '/forums/' ) );
        exit;
    } else {
        $errors->add( 'invalid', 'Invalid username or password.' );
    }
}

get_header(); ?>

<section>
<?php nep_breadcrumbs(); ?>
<main id="nep-login" class="signup-page">
<?php
if ( is_user_logged_in() ) {
    echo '<p>You\'re already signed in.</p>';
} else {
    if ( $errors->get_error_messages() ) {
        echo '<div class="nep-errors">';
        foreach ( $errors->get_error_messages() as $e ) {
            echo '<p>' . esc_html( $e ) . '</p>';
        }
        echo '</div>';
    }
    ?>
    <h1>Log In to NEPRENEUR</h1>

    <form method="post" class="signup-form">
        <div class="field">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" required>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div class="field">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <?php wp_nonce_field( 'nep_login', 'nep_login_nonce' ); ?>
        <button type="submit" class="btn">Log In</button>
    </form>
    <?php
}
?>
</main>
</section>

<?php get_footer(); ?>

<?php
/* Template: custom signup (no plugins) */

// -------------------------------------------------
// Handle registration before any HTML is sent
// -------------------------------------------------
$errors = new WP_Error();

if ( isset( $_POST['nep_reg_nonce'] ) && wp_verify_nonce( $_POST['nep_reg_nonce'], 'nep_reg' ) ) {

        $user_login = sanitize_user( $_POST['username'] );
        $user_email = sanitize_email( $_POST['email'] );
        $user_pass  = $_POST['password'];
        $acct_type  = sanitize_text_field( $_POST['acct_type'] );

        if ( username_exists( $user_login ) )    $errors->add( 'user', 'Username is taken.' );
        if ( email_exists( $user_email ) )       $errors->add( 'mail', 'Email already used.' );
        if ( strlen( $user_pass ) < 6 )          $errors->add( 'pass', 'Password ≥ 6 chars.' );
        if ( ! in_array( $acct_type, [ 'investor', 'entrepreneur' ], true ) )
                                                $errors->add( 'type', 'Choose account type.' );

        if ( empty( $errors->errors ) ) {
                $user_id = wp_create_user( $user_login, $user_pass, $user_email );
                if ( ! is_wp_error( $user_id ) ) {
                        wp_update_user( [ 'ID' => $user_id, 'role' => $acct_type ] );
                        wp_new_user_notification( $user_id, null, 'user' );
                        wp_set_current_user( $user_id );
                        wp_set_auth_cookie( $user_id );
                        wp_safe_redirect( home_url( '/forums/' ) );
                        exit;
                }
                $errors->add( 'fail', 'Registration failed, try again.' );
        }
}

get_header(); ?>

<main id="nep-signup" class="signup-page">

<?php
if ( is_user_logged_in() ) {
        echo '<p>You’re already signed in.</p>';
} else {

        if ( $errors->get_error_messages() ) {
                echo '<div class="nep-errors">';
                foreach ( $errors->get_error_messages() as $e ) {
                        echo '<p>' . esc_html( $e ) . '</p>';
                }
                echo '</div>';
        }
        ?>
        <h1>Create your NEPRENEUR account</h1>

        <form method="post" class="signup-form">
                <p>
                        <label>Username<br>
                                <input type="text" name="username" required>
                        </label>
                </p>
                <p>
                        <label>Email Address<br>
                                <input type="email" name="email" required>
                        </label>
                </p>
                <p>
                        <label>Password<br>
                                <input type="password" name="password" required minlength="6">
                        </label>
                </p>
                <p>
                        <strong>I am an:</strong><br>
                        <label><input type="radio" name="acct_type" value="investor" required> Investor</label><br>
                        <label><input type="radio" name="acct_type" value="entrepreneur" required> Entrepreneur</label>
                </p>

                <?php wp_nonce_field( 'nep_reg', 'nep_reg_nonce' ); ?>

                <p><button type="submit" class="btn">Sign Up</button></p>
        </form>
        <?php
}
?>

</main>

<?php get_footer(); ?>

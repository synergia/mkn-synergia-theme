<?php
// http://www.hongkiat.com/blog/wordpress-custom-loginpage/
// Walidacja //
function redirect_login_page() {
    $login_page  = home_url( '/login/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

function login_failed() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?l=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?l=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . "?l=false" );
    exit;
}
add_action('wp_logout','logout_page');

function synergia_login_form( $args = array() ) {
	$defaults = array(
		'echo' => true,
		// Default 'redirect' value takes the user back to the request URI.
		'redirect' => get_option('siteurl') . '/wp-admin/index.php',
		'form_id' => 'loginform',
		'label_username' => __( 'Username' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in' => __( 'Log In' ),
		'id_username' => 'user_login',
		'id_password' => 'user_pass',
		'id_remember' => 'rememberme',
		'id_submit' => 'wp-submit',
		'remember' => true,
		'value_username' => '',
		// Set 'value_remember' to true to default the "Remember me" checkbox to checked.
		'value_remember' => true,
	);
	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

	$form = '
		<form name="' . $args['form_id'] . '"  action="' . esc_url( wp_login_url() ) . '" method="post">
				<input class="loginbox__input loginbox__input--login" type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '"  value="" required placeholder="Login"/>
				<input class="loginbox__input loginbox__input--password" type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" required value="" placeholder="*****"  />
        ' . ( $args['remember'] ? '<input class="loginbox__input loginbox__input--checkbox" name="rememberme" type="checkbox" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' : '' ) . '
        <button type="submit" class="btn btn--synergia btn--full btn--raised" name="wp-submit" >'. esc_attr( $args['label_log_in'] ) . '</button>
        <input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
		</form>';

	if ( $args['echo'] )
		echo $form;
	else
		return $form;
}

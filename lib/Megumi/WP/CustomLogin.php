<?php

namespace Megumi\WP;

class CustomLogin
{
	private $default = array();
	private $config = array();

	public function __construct( $config = array() )
	{
		$this->config = wp_parse_args( $config, $this->get_default() );

		add_shortcode( 'login_form', array( $this, 'login_form' ) );

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_login_failed', array( $this, 'wp_login_failed' ) );

		add_filter( 'login_form_bottom', array( $this, 'login_form_bottom' ) );
		add_filter( 'custom_login_form', array( $this, 'custom_login_form' ) );
	}

	/**
	 * Fires at `init` action hook.
	 *
	 * @since 0.1.0
	 */
	public function init()
	{
		if( "wp-login.php" === basename( $_SERVER['REQUEST_URI'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
			wp_redirect( home_url() );
			exit;
		}
	}

	/**
	 * [login_form] shortcode callback
	 *
	 * @since 0.1.0
	 */
	public function login_form( $atts, $content )
	{
		$atts = shortcode_atts( $this->get_config(), $atts, 'login_form' );

		$login_form_args = array(
			'echo'           => false,
			'form_id'        => 'custom_login_form',
			'redirect'       => admin_url(),
			'label_username' => __( 'Email' ),
			'label_password' => __( 'Password' ),
			'label_remember' => __( 'Remember Me' ),
			'label_log_in'   => __( 'Log In' ),
			'id_username'    => 'user_login',
			'id_password'    => 'user_pass',
			'id_remember'    => 'rememberme',
			'id_submit'      => 'wp-submit',
			'remember'       => true,
			'value_username' => '',
			'value_remember' => false
		);

		$login = wp_login_form( apply_filters( 'custom_login_form_args', $login_form_args ) );
		return apply_filters( 'custom_login_form', $login );
	}

	/**
	 * Fires at `wp_login_failed` action hook.
	 *
	 * @since 0.1.0
	 */
	public function wp_login_failed()
	{
		wp_safe_redirect( esc_url( add_query_arg( array( 'login' => 'failed' ), $_POST['login_url'] ) ) );
		exit;
	}

	/**
	 * Filter the `login_form_bottom` filter hook.
	 *
	 * @since 0.1.0
	 */
	public function login_form_bottom( $content )
	{
		if ( ! is_singular() ) {
			return $content;
		}

		return '<input type="hidden" name="login_url" value="' . esc_url( get_permalink( get_the_ID() ) ) . '" />' . $content;
	}

	/**
	 * Filter the `custom_login_form` filter hook.
	 *
	 * @since 0.1.0
	 */
	public function custom_login_form( $login_form )
	{
		return $this->get_error() . $login_form;
	}

	/**
	 * Get configuration variables.
	 *
	 * @since 0.1.0
	 */
	private function get_config()
	{
		return $this->config;
	}

	/**
	 * Get default variables.
	 *
	 * @since 0.1.0
	 */
	private function get_default()
	{
		return $this->default;
	}

	/**
	 * Get error message when login fail.
	 *
	 * @since 0.1.0
	 */
	private function get_error()
	{
		$error = array(
			'failed' => 'Invalid Email and/or Password.',
			'empty'  => 'Email and/or Password is empty.',
			'false'  => 'You are logged out.',
		);

		$error = apply_filters( 'custom_login_errors', $error );

		if ( ! empty( $_GET['login'] ) && ! empty( $error[ $_GET['login'] ] ) ) {
			$error_template = apply_filters( 'custom_login_error_template', '<div class="login-error login-%1$s">%2$s</div>' );
			return sprintf( $error_template, $_GET['login'], $error[ $_GET['login'] ] );
		}
	}
}

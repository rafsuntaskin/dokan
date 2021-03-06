<?php

/**
*  Ajax handling for Dokan in Admin area
*
*  @since 2.2
*
*  @author weDevs <info@wedevs.com>
*/
class Dokan_Admin_Ajax {

	/**
	 *  Load autometically all actions
	 */
	function __construct() {
        add_action( 'wp_ajax_dokan-dismiss-christmas-offer-notice', array( $this, 'dismiss_christmas_offer' ) );
	}

	/**
     * Initializes the Dokan_Template_Withdraw class
     *
     * Checks for an existing Dokan_Template_Withdraw instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new Dokan_Admin_Ajax();
        }

        return $instance;
    }

    /**
     * Dismiss promotion notice
     *
     * @since  2.5.6
     *
     * @return void
     */
    public function dismiss_christmas_offer() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You have no permission to do that', 'dokan-lite' ) );
        }

        if ( ! wp_verify_nonce( $_POST['nonce'], 'dokan_admin' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'dokan-lite' ) );
        }

        if ( ! empty( $_POST['dokan_christmas_dismissed'] ) ) {
            $offer_key = 'dokan_christmas_notice';
            update_option( $offer_key, 'hide' );
        }
    }

}

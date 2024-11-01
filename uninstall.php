<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  SpEbay
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database stored data
$options = array(
    'sp_ebay_auth_user_id',
    'sp_ebay_auth_dev_id',
    'sp_ebay_auth_app_id',
    'sp_ebay_auth_cert_id',
    'sp_ebay_auth_token',
    'sp_ebay_feedbacks_datetime_format'
);

foreach( $option as $options ) {
	delete_option( $option );
}

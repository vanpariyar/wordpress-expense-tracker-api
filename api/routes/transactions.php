<?php
/**
 * @package Expense Tracker API
 * @desc Register Routes.
 */

require_once( WPETA_PLUGIN_DIR . 'api/controllers/transactions.php');

/**
 * @route 
 */
add_action('rest_api_init', 'WPETA_register_routes');

function WPETA_register_routes( ){
    register_rest_route( 'expenses/api/v1', '/transactions', 
        array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => 'WPETA_get_transactions',
            ),
            array(
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => 'WPETA_add_transactions',
            )
        )
    );
}
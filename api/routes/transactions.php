<?php
/**
 * @package Expense Tracker API
 * @desc Register Routes.
 */

require_once( WPETA_PLUGIN_DIR . 'api/controllers/transactions.php');

/**
 * @route Registerd
 */
add_action('rest_api_init', 'WPETA_register_routes');

function WPETA_register_routes( ){
    register_rest_route( 'expenses/api/v1', '/transactions', 
        array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => 'WPETA_get_transactions',
            ),
            array(
                'methods'  => WP_REST_Server::CREATABLE,
                'callback' => 'WPETA_add_transactions',
            )
        )
    );
    register_rest_route( 'expenses/api/v1', '/transaction/(?P<id>[\d]+)', 
        array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => 'WPETA_get_single_transaction',
            ),
            array(
                'methods'  => WP_REST_Server::DELETABLE,
                'callback' => 'WPETA_delete_single_transaction',
            ),
        )
    );
}

/**
 *  TODO :: Make call For Expanse Category
 * 
 */
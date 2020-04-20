<?php
/**
 * @package Expense Tracker API
 * @desc Route For Expanse Category.
 */

/**
 * Controller For Category.
 */
require_once( WPETA_PLUGIN_DIR . 'api/controllers/transaction_category.php');

add_action('rest_api_init', 'WPETA_register_expense_category_routes');
function WPETA_register_expense_category_routes() {
    register_rest_route( 'expenses/api/v1', '/category', 
        array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => 'WPETA_get_transaction_categories',
            ),
            array(
                'methods'  => WP_REST_Server::CREATABLE,
                'callback' => 'WPETA_add_transaction_category',
            )
        )
    );
    register_rest_route( 'expenses/api/v1', '/category/(?P<id>[\d]+)', 
        array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => 'WPETA_get_transaction_category',
            ),
            array(
                'methods'  => WP_REST_Server::DELETABLE,
                'callback' => 'WPETA_delete_transaction_category',
            ),
        )
    );
}    
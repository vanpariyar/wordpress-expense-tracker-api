<?php
/**
 *  @desc Controllers For the Transactions Route
 */

 /**
  *  @method GET
  *  @desc For Route expenses/api/v1/transactions'
  */
function WPETA_get_transactions( $req ) {
    
    $request_query = get_posts( 
        array(
            'post_type' => 'expenses',
        )
    );
    $json = array(
        'success' => true,
        'data'    => $request_query,
    );
    $error = new WP_REST_Response($json);
    $error->set_status(200);
    return $error;
}